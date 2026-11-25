<?php
include_once("conn.php");
class productos{
    public function Hamburguesas(){/* regresar arreglo con los registros encontrados */
        $c= new conn();
        $pdo=$c->coneccion();/* obtene conexion de archivo conn.php */
        $query= "select * from platillos where tipo='Hamburguesas' and estado=1";/* cadena de consulta */
        $stmt=$pdo->prepare($query); /* prepara consulta */
        $stmt->execute();/* ejecuta consulta */
        $res=$stmt->fetchAll(PDO::FETCH_ASSOC);/* crear arreglo solo en los casos de select */
        return $res; /* regresa los datos obtenidos de la consulta en forma de arreglo */
    }
    public function HotRocks(){/* regresar arreglo con los registros encontrados */
        $c= new conn();
        $pdo=$c->coneccion();/* obtene conexion de archivo conn.php */
        $query= "select * from platillos where tipo='Hot Rock\'s' and estado=1";/* cadena de consulta */
        $stmt=$pdo->prepare($query); /* prepara consulta */
        $stmt->execute();/* ejecuta consulta */
        $res=$stmt->fetchAll(PDO::FETCH_ASSOC);/* crear arreglo solo en los casos de select */
        return $res; /* regresa los datos obtenidos de la consulta en forma de arreglo */
    }
    public function Papas(){/* regresar arreglo con los registros encontrados */
        $c= new conn();
        $pdo=$c->coneccion();/* obtene conexion de archivo conn.php */
        $query= "select * from platillos where tipo='Papas' and estado=1";/* cadena de consulta */
        $stmt=$pdo->prepare($query); /* prepara consulta */
        $stmt->execute();/* ejecuta consulta */
        $res=$stmt->fetchAll(PDO::FETCH_ASSOC);/* crear arreglo solo en los casos de select */
        return $res; /* regresa los datos obtenidos de la consulta en forma de arreglo */
    }
    public function ParaCompartir(){/* regresar arreglo con los registros encontrados */
        $c= new conn();
        $pdo=$c->coneccion();/* obtene conexion de archivo conn.php */
        $query= "select * from platillos where tipo='Para Compartir' and estado=1";/* cadena de consulta */
        $stmt=$pdo->prepare($query); /* prepara consulta */
        $stmt->execute();/* ejecuta consulta */
        $res=$stmt->fetchAll(PDO::FETCH_ASSOC);/* crear arreglo solo en los casos de select */
        return $res; /* regresa los datos obtenidos de la consulta en forma de arreglo */
    }
    public function NuestrasBebidas(){/* regresar arreglo con los registros encontrados */
        $c= new conn();
        $pdo=$c->coneccion();/* obtene conexion de archivo conn.php */
        $query= "select * from platillos where tipo='Nuestras Bebidas' and estado=1";/* cadena de consulta */
        $stmt=$pdo->prepare($query); /* prepara consulta */
        $stmt->execute();/* ejecuta consulta */
        $res=$stmt->fetchAll(PDO::FETCH_ASSOC);/* crear arreglo solo en los casos de select */
        return $res; /* regresa los datos obtenidos de la consulta en forma de arreglo */
    }
    public function buscarPostre(){/* regresar arreglo con los registros encontrados */
        $c= new conn();
        $pdo=$c->coneccion();/* obtene conexion de archivo conn.php */
        $query= "select * from postres where estado=1";/* cadena de consulta */
        $stmt=$pdo->prepare($query); /* prepara consulta */
        $stmt->execute();/* envia id a la ejecucion */
        $res=$stmt->fetchAll(PDO::FETCH_ASSOC);/* crear arreglo solo en los casos de select */
        return $res; /* regresa los datos obtenidos de la consulta en forma de arreglo */
    }
    public function buscarBebidaCal(){/* regresar arreglo con los registros encontrados */
        $c= new conn();
        $pdo=$c->coneccion();/* obtene conexion de archivo conn.php */
        $query= "select * from bebidascal where estado=1";/* cadena de consulta */
        $stmt=$pdo->prepare($query); /* prepara consulta */
        $stmt->execute();/* envia id a la ejecucion */
        $res=$stmt->fetchAll(PDO::FETCH_ASSOC);/* crear arreglo solo en los casos de select */
        return $res; /* regresa los datos obtenidos de la consulta en forma de arreglo */
    }
}
?>
