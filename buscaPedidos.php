<?php

session_start();
if (!isset($_SESSION['usu'])) {
    header("Location: index.php");
    exit();
}

include_once("php/consultaUsuarios.php");
$c = new usuarios();

$correo = $_GET['correo'] ?? '';
if ($correo === '' && is_array($_SESSION['usu']) && isset($_SESSION['usu'][0]['correo'])) {
    $correo = $_SESSION['usu'][0]['correo'];
}

// Si se solicitó cancelar un pedido desde esta misma vista
if (!empty($_GET['cancelar_folio']) && $correo !== '') {
    $folioCancelar = $_GET['cancelar_folio'];
    $ok = $c->cancelarPedido($folioCancelar, $correo);
    $msg = $ok
        ? "El pedido #" . htmlspecialchars($folioCancelar) . " ha sido cancelado."
        : "No se pudo cancelar el pedido (solo se pueden cancelar pedidos en preparación).";
    echo "<script>alert(" . json_encode($msg) . "); window.location='buscaPedidos.php?correo=" . urlencode($correo) . "';</script>";
    exit();
}

$pedidos = $c->obtenerPedidosCliente($correo);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mis Pedidos - Rocker Burger</title>
    <link rel="website icon" href="imagenes/icono.ico">
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        .glow-card {
            box-shadow: 0 0 18px rgba(245, 158, 11, 0.28), inset 0 0 10px rgba(251, 191, 36, 0.08);
        }
    </style>
</head>
<body class="min-h-screen flex flex-col bg-[#09090b] text-white font-serif">

    <!-- Encabezado -->
    <header class="bg-black border-b border-amber-500/40 px-4 sm:px-8 py-4">
        <div class="max-w-6xl mx-auto flex items-center justify-center">
            <h1 class="text-xl sm:text-3xl font-bold tracking-wide text-amber-400 text-center">
                Bienvenido a Rocker Burguer
            </h1>
        </div>
    </header>

    <!-- Contenido principal -->
    <main class="flex-1 max-w-6xl w-full mx-auto px-4 sm:px-6 py-8">
        <div class="bg-[#0e0f14] border border-amber-400/70 glow-card rounded-xl p-6 sm:p-8">
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-6 border-b border-amber-500/30 pb-4">
                <h2 class="text-2xl sm:text-3xl font-bold text-amber-400">
                    Información de tus pedidos
                </h2>
                <a href="cuenta.php"
                    class="inline-block text-center bg-neutral-900 hover:bg-neutral-800 text-amber-300 border border-amber-500/50 font-sans font-semibold text-sm px-5 py-2.5 rounded-full transition">
                    Regresar
                </a>
            </div>

            <?php if (empty($pedidos)) { ?>
                <p class="text-center text-amber-200/80 font-sans py-6">Aún no tienes pedidos registrados.</p>
            <?php } else { ?>
                <div class="overflow-x-auto font-sans">
                    <table id="pedidos" class="w-full text-left border-collapse">
                        <thead>
                            <tr class="bg-black border-b border-amber-500/50 text-amber-300 text-sm sm:text-base">
                                <th class="py-3 px-4">Folio y estatus</th>
                                <th class="py-3 px-4">Fecha, hora y mesa</th>
                                <th class="py-3 px-4">Detalle del pedido</th>
                                <th class="py-3 px-4">Total y acción</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-amber-500/20 text-sm sm:text-base">
                            <?php foreach ($pedidos as $p) {
                                $enPreparacion = (intval($p['id_estado']) === 1); // 1 = En preparación[cite: 6]
                                $estatusTexto = (intval($p['id_estado']) === 1)
                                    ? 'En preparación'
                                    : ($p['estado'] ?? $p['id_estado']);
                            ?>
                            <tr class="hover:bg-black/50 transition align-top">
                                <td class="ti py-3 px-4">
                                    <p class="font-semibold text-white">Folio: <?php echo htmlspecialchars($p['folio']); ?></p>
                                    <p class="text-xs sm:text-sm text-amber-300">
                                        Estatus: <?php echo htmlspecialchars($estatusTexto); ?>
                                    </p>
                                    <p class="text-xs text-amber-200/80 mt-1">
                                        Tiempo aprox.: <?php echo htmlspecialchars($p['tiempoAprox']); ?> min
                                    </p>
                                </td>
                                <td class="fe py-3 px-4 text-amber-100">
                                    <p>Fecha: <?php echo htmlspecialchars($p['fecha']); ?></p>
                                    <p class="text-xs sm:text-sm text-amber-200/80">Hora: <?php echo htmlspecialchars($p['hora']); ?></p>
                                    <p class="text-xs sm:text-sm text-amber-200/80 mt-1">
                                        <?php echo htmlspecialchars($p['modo']); ?> — Mesa <?php echo htmlspecialchars($p['mesa']); ?>
                                    </p>
                                </td>
                                <td class="py-3 px-4 text-amber-100">
                                    <?php if (!empty($p['detalles'])) { ?>
                                        <ul class="list-disc list-inside space-y-1 text-xs sm:text-sm">
                                            <?php foreach ($p['detalles'] as $d) { ?>
                                                <li>
                                                    <span class="font-semibold text-white"><?php echo htmlspecialchars($d['nombre']); ?></span>
                                                    <span class="text-amber-300">(<?php echo htmlspecialchars($d['categoria']); ?>)</span>
                                                    — Cant.: <span class="font-bold text-amber-400"><?php echo htmlspecialchars($d['cantidad']); ?></span>
                                                </li>
                                            <?php } ?>
                                        </ul>
                                    <?php } else { ?>
                                        <span class="text-xs text-neutral-400">Sin detalles registrados</span>
                                    <?php } ?>

                                    <?php if (!empty($p['aclaraciones'])) { ?>
                                        <p class="text-xs text-amber-200/80 mt-2">
                                            <span class="font-semibold text-amber-300">Aclaraciones:</span> <?php echo htmlspecialchars($p['aclaraciones']); ?>
                                        </p>
                                    <?php } ?>
                                </td>
                                <td class="to py-3 px-4">
                                    <p class="font-bold text-amber-400">
                                        MX$<?php echo htmlspecialchars($p['total']); ?>
                                    </p>
                                    <?php if ($enPreparacion) { ?>
                                        <a href="buscaPedidos.php?correo=<?php echo urlencode($correo); ?>&cancelar_folio=<?php echo urlencode($p['folio']); ?>"
                                            onclick="return confirm('¿Seguro que deseas cancelar este pedido?');"
                                            class="mt-2 inline-block px-3 py-1.5 rounded-full bg-red-950/80 hover:bg-red-800/80 text-red-200 border border-red-500/60 text-xs font-semibold transition">
                                            Cancelar pedido
                                        </a>
                                    <?php } ?>
                                </td>
                            </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            <?php } ?>
        </div>
    </main>

    <!-- Pie de página -->
    <footer class="bg-black border-t border-amber-500/40 px-4 py-4 text-center">
        <h5 class="text-sm sm:text-base text-amber-200/90 font-medium">
            Gracias por visitar nuestra página, esperamos que nos visites pronto
        </h5>
    </footer>
</body>
</html>