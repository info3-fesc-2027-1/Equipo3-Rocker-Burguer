<?php
session_start();
if (!isset($_SESSION['usu'])) {
    header("Location: ../index.php");
    exit();
}

include_once("../php/consultaUsuarios.php");
$c = new usuarios();

if (!empty($_GET['entregar_folio'])) {
    $folioEntregar = $_GET['entregar_folio'];
    $ok = $c->marcarPedidoEntregado($folioEntregar);
    $msg = $ok
        ? "El pedido #" . $folioEntregar . " se marcó como Entregado."
        : "No se pudo actualizar el pedido (verifique que esté en preparación).";
    echo "<script>alert(" . json_encode($msg) . "); window.location='pedidos.php';</script>";
    exit();
}

$pedidos = $c->obtenerPedidosAdmin();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pedidos - Administración Rocker Burger</title>
    <link rel="website icon" href="../imagenes/icono.ico">
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
        <div class="max-w-7xl mx-auto flex items-center justify-center">
            <h1 class="text-xl sm:text-3xl font-bold tracking-wide text-amber-400 text-center">
                Administración de Pedidos - Rocker Burger
            </h1>
        </div>
    </header>

    <!-- Contenido principal -->
    <main class="flex-1 max-w-7xl w-full mx-auto px-4 sm:px-6 py-8">
        <div class="bg-[#0e0f14] border border-amber-400/70 glow-card rounded-xl p-6 sm:p-8">
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-6 border-b border-amber-500/30 pb-4">
                <div>
                    <h2 class="text-2xl sm:text-3xl font-bold text-amber-400">
                        Control de Pedidos
                    </h2>
                    <p class="text-xs sm:text-sm text-amber-200/80 font-sans mt-1">
                        Primero pendientes por hora (más antiguos arriba), luego cancelados de hoy y al final entregados de hoy.
                    </p>
                </div>
                <a href="menuAdmin.php"
                    class="inline-block text-center bg-neutral-900 hover:bg-neutral-800 text-amber-300 border border-amber-500/50 font-sans font-semibold text-sm px-5 py-2.5 rounded-full transition">
                    Regresar
                </a>
            </div>

            <?php if (empty($pedidos)) { ?>
                <p class="text-center text-amber-200/80 font-sans py-8">No hay pedidos pendientes ni movimientos del día de hoy.</p>
            <?php } else { ?>
                <div class="overflow-x-auto font-sans">
                    <table id="pedidosAdmin" class="w-full text-left border-collapse">
                        <thead>
                            <tr class="bg-black border-b border-amber-500/50 text-amber-300 text-sm sm:text-base">
                                <th class="py-3 px-4">Folio y estatus</th>
                                <th class="py-3 px-4">Cliente</th>
                                <th class="py-3 px-4">Fecha, hora y entrega</th>
                                <th class="py-3 px-4">Detalle y especificaciones</th>
                                <th class="py-3 px-4">Total y acción</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-amber-500/20 text-sm">
                            <?php foreach ($pedidos as $p) {
                                $idEst = intval($p['id_estado']);
                                $enPreparacion = ($idEst === 1);

                                if ($idEst === 1) {
                                    $estatusTexto = 'En preparación';
                                    $filaClase = 'hover:bg-black/50';
                                    $estatusColor = 'text-amber-300';
                                } elseif ($idEst === 3) {
                                    $estatusTexto = 'Entregado';
                                    $filaClase = 'bg-emerald-950/35 hover:bg-emerald-950/50';
                                    $estatusColor = 'text-emerald-300';
                                } elseif ($idEst === 4) {
                                    $estatusTexto = 'Cancelado';
                                    $filaClase = 'bg-red-950/45 hover:bg-red-950/60';
                                    $estatusColor = 'text-red-300';
                                } else {
                                    $estatusTexto = $p['estado'] ?? $p['id_estado'];
                                    $filaClase = 'hover:bg-black/50';
                                    $estatusColor = 'text-amber-300';
                                }

                                $nombreCliente = trim(($p['nom'] ?? '') . ' ' . ($p['ap'] ?? '') . ' ' . ($p['am'] ?? ''));
                            ?>
                            <tr class="<?php echo $filaClase; ?> transition align-top">
                                <td class="py-3 px-4">
                                    <p class="font-semibold text-white">Folio: <?php echo htmlspecialchars($p['folio']); ?></p>
                                    <p class="text-xs sm:text-sm <?php echo $estatusColor; ?> font-semibold">
                                        Estatus: <?php echo htmlspecialchars($estatusTexto); ?>
                                    </p>
                                    <p class="text-xs text-amber-200/80 mt-1">
                                        Tiempo aprox.: <?php echo htmlspecialchars($p['tiempoAprox']); ?> min
                                    </p>
                                </td>
                                <td class="py-3 px-4 text-amber-100">
                                    <p class="font-semibold text-white">
                                        <?php echo htmlspecialchars($nombreCliente !== '' ? $nombreCliente : 'Cliente'); ?>
                                    </p>
                                    <?php if (!empty($p['correo'])) { ?>
                                        <p class="text-xs text-amber-200/80 break-all"><?php echo htmlspecialchars($p['correo']); ?></p>
                                    <?php } ?>
                                    <?php if (!empty($p['tel'])) { ?>
                                        <p class="text-xs text-amber-200/80 mt-0.5">Tel: <?php echo htmlspecialchars($p['tel']); ?></p>
                                    <?php } ?>
                                </td>
                                <td class="py-3 px-4 text-amber-100">
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
                                            <span class="font-semibold text-amber-300">Especificaciones / Aclaraciones:</span>
                                            <?php echo htmlspecialchars($p['aclaraciones']); ?>
                                        </p>
                                    <?php } ?>
                                </td>
                                <td class="py-3 px-4">
                                    <p class="font-bold text-amber-400 text-base">
                                        MX$<?php echo htmlspecialchars($p['total']); ?>
                                    </p>
                                    <?php if ($enPreparacion) { ?>
                                        <a href="pedidos.php?entregar_folio=<?php echo urlencode($p['folio']); ?>"
                                            onclick="return confirm('¿Marcar este pedido como Entregado?');"
                                            class="mt-2 inline-block px-3.5 py-1.5 rounded-full bg-emerald-900/80 hover:bg-emerald-800 text-emerald-200 border border-emerald-500/60 text-xs font-semibold transition">
                                            Entregado
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