<?php
session_start();
$correo=$_GET['correo'];
include_once("php/consultaUsuarios.php");
$c=new usuarios();
$cuedomi=$c->cuentaDomi($correo);
$_SESSION['usu']=$_SESSION['info'];
if(!isset($cuedomi)){
    $_SESSION['noCuDomi']=1;
    echo "hola";
    header("Location:cuenta.php");
}
header("Location:cuenta.php");
?>
