<?php
session_start();
$_SESSION['usu']="";
$_SESSION['NoUsu']="";
$_SESSION['jefe']=0;
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $correo = $_POST['correo'];
    $pass = $_POST['pass'];
    include_once("php/consultaUsuarios.php");
    $c=new usuarios();
    $usu=$c->buscarUsuario($correo,$pass);
    if ($usu==1) {
        header("Location:Principal.php");
        exit();
    } else {
        if ($usu==2 or $usu==4) {
            header("Location:admin/menuAdmin.php");
            exit();
        } else {
            $_SESSION['NoUsu']="Usuario no encontrado";
            header("Location:index.php");
            exit();
        }  
    }  
}
?>