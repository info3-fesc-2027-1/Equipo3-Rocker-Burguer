<?php
session_start();
unset($_SESSION['usu']);
if(!isset($_SESSION['usu'])){
    $_SESSION['usu']=null;
    echo "Sesión cerrada.";
    $correo = $_GET['correo'];
    include_once("../php/consultaEmpleados.php");
    $c=new usuarios();
    $usu=$c->destruirCliente($correo);
    if(isset($_SESSION['jefe'])){
        unset($_SESSION['jefe']);
    }
    if(isset($_SESSION['empleado'])){
        unset($_SESSION['empleado']);
    }
    header("Location: ../index.php");
}else{
    echo "Error de sierre de sesión.";
    header("Location: cuenta.php");
}
?>