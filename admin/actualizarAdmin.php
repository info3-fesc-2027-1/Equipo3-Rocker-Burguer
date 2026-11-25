<?php
session_start();
if($_SERVER["REQUEST_METHOD"] == "POST"){
    $newpass=$_POST['pass'];
    $newtel=$_POST['tel'];
    $correo=$_GET['correo'];
        include_once("../php/consultaEmpleados.php");
        $c=new usuarios();
        $actualizar=$c->actualizarUsuario($newpass, $newtel,$correo);
        $_SESSION['usu']=$actualizar;
        if(isset($_SESSION['jefe'])){
            $_SESSION['jefe']=$actualizar;
        }
        if(isset($_SESSION['empleado'])){
            $_SESSION['empleado']=$actualizar;
        }
        header("Location:cuenta.php");
        exit();
}
?>
