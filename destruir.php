<?php
session_start();
unset($_SESSION['usu']);
if(!isset($_SESSION['usu'])){
    $_SESSION['usu']=null;
    echo "Sesión cerrada.";
    $correo = $_GET['correo'];
    include_once("php/consultaUsuarios.php");
    $c=new usuarios();
    $usu=$c->destruirCliente($correo);
    header("Location: index.php");
}else{
    echo "Error de sierre de sesión.";
    header("Location: cuenta.php");
}
?>
