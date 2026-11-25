<?php
session_start();

$folio  = $_GET['folio'] ?? '';
$correo = $_GET['correo'] ?? '';

include_once("php/consultaUsuarios.php");
$c = new usuarios();

if (!empty($folio) && !empty($correo)) {
    $cancelado = $c->cancelarPedido($folio, $correo);
    $_SESSION['pedidos'] = $c->obtenerPedidosCliente($correo);

    if ($cancelado) {
        echo "<script>alert('El pedido #$folio ha sido cancelado.'); window.location='cuenta.php';</script>";
        exit();
    } else {
        echo "<script>alert('No se pudo cancelar el pedido (verifique que esté en preparación).'); window.location='cuenta.php';</script>";
        exit();
    }
}

header("Location: cuenta.php");
exit();
?>