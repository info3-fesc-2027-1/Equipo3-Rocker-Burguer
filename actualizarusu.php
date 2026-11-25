<?php
session_start();
if($_SERVER["REQUEST_METHOD"] == "POST"){
    $newpass=$_POST['pass'];
    $newtel=$_POST['tel'];
    $correo=$_GET['correo'];
        include_once("php/consultaUsuarios.php");
        $c=new usuarios();
        $actualizar=$c->actualizarUsuario($newpass, $newtel,$correo);
        $_SESSION['info']=$actualizar;
        $_SESSION['usu']=$actualizar;
        header("Location:cuenta.php");
        exit();
}
?>
