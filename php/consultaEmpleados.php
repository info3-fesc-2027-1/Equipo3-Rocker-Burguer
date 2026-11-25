<?php
session_start();
$_SESSION['usu']="";
include_once("conn.php");
class usuarios{
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
            if(isset($_SESSION['jefe'])){
                $query= "select usuarios.correo, usuarios.pass, usuarios.tipo_usuario, jefes.tel, jefes.id_jefe, jefes.nom, jefes.ap, jefes.am from usuarios INNER JOIN jefes ON jefes.id_correo=usuarios.correo where jefes.id_correo='$correo'";
                $stmt1=$pdo->prepare($query);
                $stmt1->execute();
                $res=$stmt1->fetchAll(PDO::FETCH_ASSOC);
            }else{
                $query= "select usuarios.correo, usuarios.pass, usuarios.tipo_usuario, empleados.tel, empleados.id_empleado, empleados.nom, empleados.ap, empleados.am from usuarios INNER JOIN empleados ON empleados.id_correo=usuarios.correo where empleados.id_correo='$correo'";
                $stmt1=$pdo->prepare($query);
                $stmt1->execute();
                $res=$stmt1->fetchAll(PDO::FETCH_ASSOC);
            }
        }
        if(isset($_SESSION['jefe'])){
            if($newtel != null){
                $sql = "UPDATE jefes SET tel='$newtel' WHERE id_correo='$correo'";
                $stmt = $pdo->prepare($sql);
                $stmt->execute();
                $query= "select usuarios.correo, usuarios.pass, usuarios.tipo_usuario, jefes.tel, jefes.id_jefe, jefes.nom, jefes.ap, jefes.am from usuarios INNER JOIN jefes ON jefes.id_correo=usuarios.correo where jefes.id_correo='$correo'";
                $stmt1=$pdo->prepare($query);
                $stmt1->execute();
                $res=$stmt1->fetchAll(PDO::FETCH_ASSOC);
            }
        }
        if(isset($_SESSION['empleado'])){
            if($newtel != null){
                $sql = "UPDATE empleados SET tel='$newtel' WHERE id_correo='$correo'";
                $stmt = $pdo->prepare($sql);
                $stmt->execute();
                $query= "select usuarios.correo, usuarios.pass, usuarios.tipo_usuario, empleados.tel, empleados.id_empleado, empleados.nom, empleados.ap, empleados.am from usuarios INNER JOIN empleados ON empleados.id_correo=usuarios.correo where empleados.id_correo='$correo'";
                $stmt1=$pdo->prepare($query);
                $stmt1->execute();
                $res=$stmt1->fetchAll(PDO::FETCH_ASSOC);
            }
        }
        return $res;
    }
}
?>