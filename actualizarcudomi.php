<?php
session_start();
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $newcol    = $_POST['col'];
    $newmun    = $_POST['mun'];
    $newcalle  = $_POST['calle'];
    $newint    = $_POST['noint'];
    $newbanco  = $_POST['banco'];
    $newcuenta = $_POST['cuenta'];
    $nocuenta  = $_GET['no_cuenta'];

    include_once("php/consultaUsuarios.php");
    $c = new usuarios();
    $cuedomi = $c->actualizarCuenta($newcol, $newmun, $newcalle, $newint, $newbanco, $nocuenta, $newcuenta);
    $_SESSION['cuentadomi'] = $cuedomi;
    $_SESSION['usu'] = $_SESSION['info'];
    header("Location:cuenta.php");
    exit();
}
?>