<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
if (!isset($_SESSION['usu'])) {
    $_SESSION['usu'] = "";
}
include_once("conn.php");
class usuarios{
    public function obtenerCatalogoAdmin() {
    $c = new conn();
    $pdo = $c->coneccion();

    $stmtPlat = $pdo->prepare("SELECT id_platillo, comida, tipo, descripcion, costo, estado, tiempo, imagen
                               FROM platillos
                               ORDER BY id_platillo ASC");
    $stmtPlat->execute();
    $platillos = $stmtPlat->fetchAll(PDO::FETCH_ASSOC);

    $stmtPost = $pdo->prepare("SELECT id_postre, postre, costo, estado, tiempo, imagen
                               FROM postres
                               ORDER BY id_postre ASC");
    $stmtPost->execute();
    $postres = $stmtPost->fetchAll(PDO::FETCH_ASSOC);

    $stmtBeb = $pdo->prepare("SELECT id_bebidaCal, bebida, costo, estado, tiempo, imagen
                              FROM bebidascal
                              ORDER BY id_bebidaCal ASC");
    $stmtBeb->execute();
    $bebidas = $stmtBeb->fetchAll(PDO::FETCH_ASSOC);

    return [
        'platillos' => $platillos,
        'postres'   => $postres,
        'bebidas'   => $bebidas
    ];
}

public function cambiarEstadoCatalogo($tipo, $id, $nuevoEstado) {
    $c = new conn();
    $pdo = $c->coneccion();

    $id = intval($id);
    $nuevoEstado = (intval($nuevoEstado) === 1) ? 1 : 0;

    if ($id <= 0) {
        return false;
    }

    switch ($tipo) {
        case 'platillo':
            $sql = "UPDATE platillos SET estado = ? WHERE id_platillo = ?";
            break;
        case 'postre':
            $sql = "UPDATE postres SET estado = ? WHERE id_postre = ?";
            break;
        case 'bebida':
            $sql = "UPDATE bebidascal SET estado = ? WHERE id_bebidaCal = ?";
            break;
        default:
            return false;
    }

    $stmt = $pdo->prepare($sql);
    $stmt->execute([$nuevoEstado, $id]);

    return $stmt->rowCount() > 0;
}
    public function obtenerPedidosAdmin() {
    $c = new conn();
    $pdo = $c->coneccion();
    // 1 Pendientes / en preparación (y en camino si aplica), ordenados de más antiguo a más reciente por hora
    $sqlPendientes = "SELECT p.folio, p.modo, p.mesa, p.fecha, p.hora, p.total, p.id_estado, p.aclaraciones, p.tiempoAprox, e.estado, cl.nom, cl.ap, cl.am, cl.tel, cl.id_correo AS correo
                      FROM pedidos p
                      LEFT JOIN estados e ON p.id_estado = e.id_estado
                      LEFT JOIN clientes cl ON p.id_cliente = cl.id_cliente
                      WHERE p.id_estado = 1
                      ORDER BY p.fecha ASC, p.hora ASC";
    // 2 Cancelados (id_estado = 4) SOLO del día actual
    $sqlCanceladosHoy = "SELECT p.folio, p.modo, p.mesa, p.fecha, p.hora, p.total, p.id_estado, p.aclaraciones, p.tiempoAprox, e.estado, cl.nom, cl.ap, cl.am, cl.tel, cl.id_correo AS correo
                         FROM pedidos p
                         LEFT JOIN estados e ON p.id_estado = e.id_estado
                         LEFT JOIN clientes cl ON p.id_cliente = cl.id_cliente
                         WHERE p.id_estado = 4 AND p.fecha = CURDATE()
                         ORDER BY p.hora ASC";
    // 3 Entregados (id_estado = 3) SOLO del día actual
    $sqlEntregadosHoy = "SELECT p.folio, p.modo, p.mesa, p.fecha, p.hora, p.total, p.id_estado, p.aclaraciones, p.tiempoAprox, e.estado, cl.nom, cl.ap, cl.am, cl.tel, cl.id_correo AS correo
                         FROM pedidos p
                         LEFT JOIN estados e ON p.id_estado = e.id_estado
                         LEFT JOIN clientes cl ON p.id_cliente = cl.id_cliente
                         WHERE p.id_estado = 3 AND p.fecha = CURDATE()
                         ORDER BY p.hora ASC";
    $stmt1 = $pdo->prepare($sqlPendientes);
    $stmt1->execute();
    $pendientes = $stmt1->fetchAll(PDO::FETCH_ASSOC);
    $stmt2 = $pdo->prepare($sqlCanceladosHoy);
    $stmt2->execute();
    $canceladosHoy = $stmt2->fetchAll(PDO::FETCH_ASSOC);
    $stmt3 = $pdo->prepare($sqlEntregadosHoy);
    $stmt3->execute();
    $entregadosHoy = $stmt3->fetchAll(PDO::FETCH_ASSOC);
    $todos = array_merge($pendientes, $canceladosHoy, $entregadosHoy);
    $stmtPlat = $pdo->prepare("SELECT pl.comida AS nombre, 'Platillo' AS categoria, pp.cantidad
                              FROM pedido_platillo pp
                              INNER JOIN platillos pl ON pp.id_platillo = pl.id_platillo
                              WHERE pp.id_pedido = ?");
    $stmtPost = $pdo->prepare("SELECT po.postre AS nombre, 'Postre' AS categoria, ppo.cantidad
                              FROM pedido_postre ppo
                              INNER JOIN postres po ON ppo.id_postre = po.id_postre
                              WHERE ppo.id_pedido = ?");
    $stmtBeb  = $pdo->prepare("SELECT bc.bebida AS nombre, 'Bebida caliente' AS categoria, pb.cantidad
                              FROM pedido_bebidascal pb
                              INNER JOIN bebidascal bc ON pb.id_bebidaCal = bc.id_bebidaCal
                              WHERE pb.id_pedido = ?");
    foreach ($todos as &$ped) {
        $folio = $ped['folio'];
        $stmtPlat->execute([$folio]);
        $platillos = $stmtPlat->fetchAll(PDO::FETCH_ASSOC);
        $stmtPost->execute([$folio]);
        $postres = $stmtPost->fetchAll(PDO::FETCH_ASSOC);
        $stmtBeb->execute([$folio]);
        $bebidas = $stmtBeb->fetchAll(PDO::FETCH_ASSOC);
        $ped['detalles'] = array_merge($platillos, $postres, $bebidas);
    }
    unset($ped);
    return $todos;
}

    public function marcarPedidoEntregado($folio) {
        $c = new conn();
        $pdo = $c->coneccion();
        // Cambia de 1 (En preparación) a 3 (Entregado)
        $sql = "UPDATE pedidos SET id_estado = 3 WHERE folio = ? AND id_estado = 1";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$folio]);
        return $stmt->rowCount() > 0;
    }
    public function obtenerPedidosCliente($correo) {
    $c = new conn();
    $pdo = $c->coneccion();
    $sqlCli = "SELECT id_cliente FROM clientes WHERE id_correo = ? LIMIT 1";
    $stmtCli = $pdo->prepare($sqlCli);
    $stmtCli->execute([$correo]);
    $cliente = $stmtCli->fetch(PDO::FETCH_ASSOC);
    if (!$cliente) {
        return [];
    }
    $idCliente = intval($cliente['id_cliente']);
    $sqlPedidos = "SELECT p.folio, p.modo, p.mesa, p.fecha, p.hora, p.total, p.id_estado, p.aclaraciones, p.tiempoAprox, e.estado
                   FROM pedidos p
                   LEFT JOIN estados e ON p.id_estado = e.id_estado
                   WHERE p.id_cliente = ?
                   ORDER BY p.fecha DESC, p.hora DESC"; // Consulta pedidos del cliente con su estado
    $stmtPed = $pdo->prepare($sqlPedidos);
    $stmtPed->execute([$idCliente]);
    $pedidos = $stmtPed->fetchAll(PDO::FETCH_ASSOC);
    $stmtPlat = $pdo->prepare("SELECT pl.comida AS nombre, 'Platillo' AS categoria, pp.cantidad
                              FROM pedido_platillo pp
                              INNER JOIN platillos pl ON pp.id_platillo = pl.id_platillo
                              WHERE pp.id_pedido = ?"); // Platillos del pedido
    $stmtPost = $pdo->prepare("SELECT po.postre AS nombre, 'Postre' AS categoria, ppo.cantidad
                              FROM pedido_postre ppo
                              INNER JOIN postres po ON ppo.id_postre = po.id_postre
                              WHERE ppo.id_pedido = ?"); // Postres del pedido
    $stmtBeb  = $pdo->prepare("SELECT bc.bebida AS nombre, 'Bebida caliente' AS categoria, pb.cantidad
                              FROM pedido_bebidascal pb
                              INNER JOIN bebidascal bc ON pb.id_bebidaCal = bc.id_bebidaCal
                              WHERE pb.id_pedido = ?"); // Bebidas calientes del pedido
    foreach ($pedidos as &$ped) {
        $folio = $ped['folio']; // Folio del pedido
        $stmtPlat->execute([$folio]);
        $platillos = $stmtPlat->fetchAll(PDO::FETCH_ASSOC);
        $stmtPost->execute([$folio]);
        $postres = $stmtPost->fetchAll(PDO::FETCH_ASSOC);
        $stmtBeb->execute([$folio]);
        $bebidas = $stmtBeb->fetchAll(PDO::FETCH_ASSOC);
        $ped['detalles'] = array_merge($platillos, $postres, $bebidas);
    }
    unset($ped);
    return $pedidos;
}

    public function cancelarPedido($folio, $correo) {
    $c = new conn();
    $pdo = $c->coneccion();

    $sqlCli = "SELECT id_cliente FROM clientes WHERE id_correo = ? LIMIT 1"; // Busca id_cliente por correo
    $stmtCli = $pdo->prepare($sqlCli);
    $stmtCli->execute([$correo]);
    $cliente = $stmtCli->fetch(PDO::FETCH_ASSOC);

    if (!$cliente) {
        return false;
    }

    $idCliente = intval($cliente['id_cliente']);

    // Cambia id_estado de 1 (En preparación) a 4 (Cancelado) solo si el pedido es del cliente
    $sqlUpd = "UPDATE pedidos
               SET id_estado = 4
               WHERE folio = ?
                 AND id_cliente = ?
                 AND id_estado = 1";
    $stmtUpd = $pdo->prepare($sqlUpd);
    $stmtUpd->execute([$folio, $idCliente]);

    return $stmtUpd->rowCount() > 0;
    }
    public function buscaCuenta($correo){/* regresar arreglo con los registros encontrados*/
        $c= new conn();
        $pdo=$c->coneccion();/* obtene conexion de archivo conn.php */
        $query= "select usuarios.correo, usuarios.pass, cliente.id_cliente, cliente.nombre, cliente.ap, cliente.am from usuarios INNER JOIN cliente ON cliente.id_correo=usuarios.correo where cliente.id_correo='$correo'";
        $stmt=$pdo->prepare($query);
        $stmt->execute();
        $res=$stmt->fetchAll(PDO::FETCH_ASSOC);
        return $res;
    }
    public function cuentaDomi($correo){/* regresar arreglo con los registros encontrados CUENTA Y DOMICILIO*/
        $c= new conn();
        $pdo=$c->coneccion();/* obtene conexion de archivo conn.php */
        $query= "select cuenta.no_cuenta, cuenta.col, cuenta.mun, cuenta.calle, cuenta.no_int, cuenta.banco from usuarios inner join clientes on clientes.id_correo=usuarios.correo inner join cuenta on cuenta.id_cliente=clientes.id_cliente where usuarios.correo=?";
        $stmt=$pdo->prepare($query);
        $stmt->execute([$correo]);
        $res=$stmt->fetchAll(PDO::FETCH_ASSOC);
        $_SESSION['cuentadomi']=$res;
        return $res;
    }
    public function buscarUsuario($correo,$pass){/* regresar arreglo con los registros encontrados, es para el login LOGIN*/
        $c= new conn();
        $pdo=$c->coneccion();/* obtene conexion de archivo conn.php */
        $query= "select usuarios.correo, usuarios.pass, usuarios.tipo_usuario, usuarios.estado, clientes.tel, clientes.id_cliente, clientes.nom, clientes.ap, clientes.am from usuarios INNER JOIN clientes ON clientes.id_correo=usuarios.correo where clientes.id_correo='$correo' AND usuarios.pass='$pass'";/* cadena de consulta */
        $stmt=$pdo->prepare($query); /* prepara consulta */
        $stmt->execute();/* envia usuario y password a la ejecucion */
        $res=$stmt->fetchAll(PDO::FETCH_ASSOC);/* crear arreglo solo en los casos de select */
        if(count($res)<=0){
            $c1= new conn();
            $pdo1=$c1->coneccion();/* obtene conexion de archivo conn.php */
            $query1= "select usuarios.correo, usuarios.pass, usuarios.tipo_usuario, empleados.id_empleado, empleados.nom, empleados.ap, empleados.am, empleados.tel from usuarios INNER JOIN empleados ON empleados.id_correo=usuarios.correo where empleados.id_correo='$correo' AND usuarios.pass='$pass'";
            $stmt1=$pdo1->prepare($query1); /* prepara consulta */
            $stmt1->execute();/* envia usuario y password a la ejecucion */
            $res1=$stmt1->fetchAll(PDO::FETCH_ASSOC);/* crear arreglo solo en los casos de select */
            if(count($res1)<=0){
                $c2= new conn();
                $pdo2=$c2->coneccion();/* obtene conexion de archivo conn.php */
                $query2= "select usuarios.correo, usuarios.pass, usuarios.tipo_usuario, jefes.id_jefe, jefes.nom, jefes.ap, jefes.am, jefes.tel from usuarios INNER JOIN jefes ON jefes.id_correo=usuarios.correo where jefes.id_correo='$correo' AND usuarios.pass='$pass'";
                $stmt2=$pdo2->prepare($query2); /* prepara consulta */
                $stmt2->execute();/* envia usuario y password a la ejecucion */
                $res2=$stmt2->fetchAll(PDO::FETCH_ASSOC);/* crear arreglo solo en los casos de select */
                if(count($res2)<=0){
                    $_SESSION['usu'] = "";
                    $valor=3; //Indica que no se encontro ningun usuario
                    return $valor;
                }else{
                    $c= new conn();
                    $pdo=$c->coneccion();
                    $sql0 = "UPDATE usuarios SET estado='1' WHERE correo='$correo'";
                    $stmt0 = $pdo->prepare($sql0);
                    $stmt0->execute();
                    $_SESSION['jefe']=$res2;
                    $_SESSION['usu'] = $res2;
                    $_SESSION['empleado']=null;
                    $valor=4; // Indica que es un jefe
                    return $valor;
                }
            }else{
                $c= new conn();
                $pdo=$c->coneccion();
                $sql0 = "UPDATE usuarios SET estado='1' WHERE correo='$correo'";
                $stmt0 = $pdo->prepare($sql0);
                $stmt0->execute();
                $_SESSION['empleado']=$res1;
                $_SESSION['usu'] = $res1;
                $_SESSION['jefe']=null;
                $valor=2; //Indica que es un empleado
                return $valor;
            }
        }else{
            $c= new conn();
            $pdo=$c->coneccion();
            $sql0 = "UPDATE usuarios SET estado='1' WHERE correo='$correo'";
            $stmt0 = $pdo->prepare($sql0);
            $stmt0->execute();
            $_SESSION['usu']=$res;
            $valor=1; //Indica que es un cliente
            return $valor;
        }
        return $res;
    }
    public function crearUsuario($correo,$pass,$nombre,$ap,$am,$tel){
        $c= new conn();
        $pdo=$c->coneccion();/* obtene conexion de archivo conn.php */
        $query= "select * from usuarios where correo='$correo'";
        $stmt=$pdo->prepare($query);
        $stmt->execute();
        $res=$stmt->fetchAll(PDO::FETCH_ASSOC);
        if(count($res)<=0){
            $c= new conn();
            $pdo=$c->coneccion();
            $query= "insert into usuarios(correo,pass,tipo_usuario,estado) values(?,?,?,?)";
            $stmt=$pdo->prepare($query);
            $stmt->execute([$correo,$pass,"cliente","0"]);
            $res=$stmt->rowCount();
            if($res>0){
                $c1= new conn();
                $pdo1=$c1->coneccion();
                $query1= "insert into clientes(nom,ap,am,tel,id_correo) values(?,?,?,?,?)";
                $stmt1=$pdo1->prepare($query1);
                $stmt1->execute([$nombre,$ap,$am,$tel,$correo]);
                $res=$stmt1->rowCount();
                $valor=2;
                return $valor;
            }else{
                echo "ERROR EN USUARIOS";
            }
        }else{
            $valor=1; //Indica que el usuario ya existe
            return $valor;
        }
        
    }
    public function destruirCliente($correo){
        $c= new conn();
        $pdo=$c->coneccion();
        $sql = "UPDATE usuarios SET estado=0 WHERE correo='$correo'";
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        $destruir=1;
        return $destruir;
    }
    public function actualizarUsuario($newpass, $newtel,$correo){ //Para Cuenta
        $c= new conn();
        $pdo=$c->coneccion();
        if($newpass != null){
            $sql = "UPDATE usuarios SET pass='$newpass' WHERE correo='$correo'";
            $stmt = $pdo->prepare($sql);
            $stmt->execute();
        }else{}
        if($newtel != null){
            $sql = "UPDATE clientes SET tel='$newtel' WHERE id_correo='$correo'";
            $stmt = $pdo->prepare($sql);
            $stmt->execute();
        }else{}
        $query= "select usuarios.correo, usuarios.pass, clientes.tel, clientes.id_cliente, clientes.nom, clientes.ap, clientes.am from usuarios INNER JOIN clientes ON clientes.id_correo=usuarios.correo where clientes.id_correo='$correo'";
        $stmt=$pdo->prepare($query);
        $stmt->execute();
        $res=$stmt->fetchAll(PDO::FETCH_ASSOC);
        return $res;
    }
    public function actualizarCuenta($newcol, $newmun, $newcalle, $newint, $newbanco, $nocuenta, $newcuenta){
        $c= new conn();
        $pdo=$c->coneccion();
        if($newcol != null){
            $sql = "UPDATE cuenta SET col='$newcol' WHERE no_cuenta='$nocuenta'";
            $stmt = $pdo->prepare($sql);
            $stmt->execute();
        }else{}
        if($newmun != null){
            $sql = "UPDATE cuenta SET mun='$newmun' WHERE no_cuenta='$nocuenta'";
            $stmt = $pdo->prepare($sql);
            $stmt->execute();
        }else{}
        if($newcalle != null){
            $sql = "UPDATE cuenta SET calle='$newcalle' WHERE no_cuenta='$nocuenta'";
            $stmt = $pdo->prepare($sql);
            $stmt->execute();
        }else{}
        if($newint != null){
            $sql = "UPDATE cuenta SET no_int='$newint' WHERE no_cuenta='$nocuenta'";
            $stmt = $pdo->prepare($sql);
            $stmt->execute();
        }else{}
        if($newbanco != null){
            $sql = "UPDATE cuenta SET banco='$newbanco' WHERE no_cuenta='$nocuenta'";
            $stmt = $pdo->prepare($sql);
            $stmt->execute();
        }else{}
        if($newcuenta != null){
            $sql = "UPDATE cuenta SET no_cuenta='$newcuenta' WHERE no_cuenta='$nocuenta'";
            $stmt = $pdo->prepare($sql);
            $stmt->execute();
        }else{}
        $query= "select cuenta.no_cuenta, cuenta.col, cuenta.mun, cuenta.calle, cuenta.no_int, cuenta.banco from cuenta where no_cuenta='$nocuenta'";
        $stmt=$pdo->prepare($query);
        $stmt->execute();
        $res=$stmt->fetchAll(PDO::FETCH_ASSOC);
        return $res;
    }
}
?>