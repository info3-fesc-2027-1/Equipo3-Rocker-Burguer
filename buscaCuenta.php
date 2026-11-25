<?php
session_start();
$_SESSION['info']="";
$_SESSION['info']=$_SESSION['usu'];
header("Location:cuenta.php");
?>
