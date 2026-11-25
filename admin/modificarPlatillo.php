<?php
session_start();
if (!isset($_SESSION['usu'])) {
    header("Location: ../index.php");
    exit();
}

include_once("../php/consultaUsuarios.php");
$c = new usuarios();

// Cambio de estado (1 = Activo, 0 = Inactivo)
if (isset($_GET['tipo'], $_GET['id'], $_GET['estado'])) {
    $tipo = $_GET['tipo'];
    $id = intval($_GET['id']);
    $nuevoEstado = (intval($_GET['estado']) === 1) ? 1 : 0;

    $ok = $c->cambiarEstadoCatalogo($tipo, $id, $nuevoEstado);
    $accionTexto = ($nuevoEstado === 1) ? "activado" : "desactivado";
    $msg = $ok
        ? "Elemento $accionTexto correctamente."
        : "No se pudo actualizar el estado del elemento.";

    echo "<script>alert(" . json_encode($msg) . "); window.location='modificarPlatillo.php';</script>";
    exit();
}

$catalogo = $c->obtenerCatalogoAdmin();
$platillos = $catalogo['platillos'];
$postres   = $catalogo['postres'];
$bebidas   = $catalogo['bebidas'];
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Menú - Rocker Burger</title>
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
                Administración de Platillos, Postres y Bebidas Calientes
            </h1>
        </div>
    </header>

    <!-- Contenido principal -->
    <main class="flex-1 max-w-7xl w-full mx-auto px-4 sm:px-6 py-8 space-y-8">

        <!-- Barra superior con regresar -->
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 bg-[#0e0f14] border border-amber-400/70 glow-card rounded-xl p-5">
            <div>
                <h2 class="text-xl sm:text-2xl font-bold text-amber-400">
                    Disponibilidad del Menú
                </h2>
                <p class="text-xs sm:text-sm text-amber-200/80 font-sans mt-1">
                    Estado 1: Activo (visible para clientes) | Estado 0: Inactivo (oculto para clientes).
                </p>
            </div>
            <a href="menuAdmin.php"
                class="inline-block text-center bg-neutral-900 hover:bg-neutral-800 text-amber-300 border border-amber-500/50 font-sans font-semibold text-sm px-5 py-2.5 rounded-full transition">
                Regresar
            </a>
        </div>

        <!-- 1. PLATILLOS -->
        <section class="bg-[#0e0f14] border border-amber-400/70 glow-card rounded-xl p-6">
            <h3 class="text-xl sm:text-2xl font-bold text-amber-400 mb-4 border-b border-amber-500/30 pb-2">
                Platillos
            </h3>
            <div class="overflow-x-auto font-sans">
                <table class="w-full text-left border-collapse text-sm">
                    <thead>
                        <tr class="bg-black border-b border-amber-500/50 text-amber-300">
                            <th class="py-3 px-3">ID</th>
                            <th class="py-3 px-3">Imagen</th>
                            <th class="py-3 px-3">Nombre y tipo</th>
                            <th class="py-3 px-3">Descripción</th>
                            <th class="py-3 px-3">Costo y tiempo</th>
                            <th class="py-3 px-3">Estado y acción</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-amber-500/20">
                        <?php foreach ($platillos as $pl) {
                            $activo = (intval($pl['estado']) === 1);
                        ?>
                        <tr class="hover:bg-black/50 transition align-top">
                            <td class="py-3 px-3 font-semibold text-white"><?php echo htmlspecialchars($pl['id_platillo']); ?></td>
                            <td class="py-3 px-3">
                                <img src="../imagenes/<?php echo htmlspecialchars($pl['imagen']); ?>" alt="<?php echo htmlspecialchars($pl['comida']); ?>"
                                    class="w-14 h-14 rounded-lg object-cover border border-amber-500/40 bg-black">
                            </td>
                            <td class="py-3 px-3">
                                <p class="font-bold text-white"><?php echo htmlspecialchars($pl['comida']); ?></p>
                                <p class="text-xs text-amber-300">Tipo: <?php echo htmlspecialchars($pl['tipo']); ?></p>
                            </td>
                            <td class="py-3 px-3 text-amber-100/90 max-w-xs">
                                <?php echo htmlspecialchars($pl['descripcion']); ?>
                            </td>
                            <td class="py-3 px-3 text-amber-100">
                                <p class="font-bold text-amber-400">MX$<?php echo htmlspecialchars($pl['costo']); ?></p>
                                <p class="text-xs text-amber-200/80">Tiempo: <?php echo htmlspecialchars($pl['tiempo']); ?> min</p>
                            </td>
                            <td class="py-3 px-3">
                                <p class="text-xs font-semibold mb-2 <?php echo $activo ? 'text-emerald-300' : 'text-red-300'; ?>">
                                    Estado: <?php echo htmlspecialchars($pl['estado']); ?> (<?php echo $activo ? 'Activo' : 'Inactivo'; ?>)
                                </p>
                                <?php if ($activo) { ?>
                                    <a href="modificarPlatillo.php?tipo=platillo&id=<?php echo urlencode($pl['id_platillo']); ?>&estado=0"
                                        onclick="return confirm('¿Desactivar este platillo?');"
                                        class="inline-block px-3.5 py-1.5 rounded-full bg-red-950/80 hover:bg-red-800/80 text-red-200 border border-red-500/60 text-xs font-semibold transition">
                                        Desactivar
                                    </a>
                                <?php } else { ?>
                                    <a href="modificarPlatillo.php?tipo=platillo&id=<?php echo urlencode($pl['id_platillo']); ?>&estado=1"
                                        onclick="return confirm('¿Activar este platillo?');"
                                        class="inline-block px-3.5 py-1.5 rounded-full bg-emerald-900/80 hover:bg-emerald-800 text-emerald-200 border border-emerald-500/60 text-xs font-semibold transition">
                                        Activar
                                    </a>
                                <?php } ?>
                            </td>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </section>

        <!-- 2. POSTRES -->
        <section class="bg-[#0e0f14] border border-amber-400/70 glow-card rounded-xl p-6">
            <h3 class="text-xl sm:text-2xl font-bold text-amber-400 mb-4 border-b border-amber-500/30 pb-2">
                Postres
            </h3>
            <div class="overflow-x-auto font-sans">
                <table class="w-full text-left border-collapse text-sm">
                    <thead>
                        <tr class="bg-black border-b border-amber-500/50 text-amber-300">
                            <th class="py-3 px-3">ID</th>
                            <th class="py-3 px-3">Imagen</th>
                            <th class="py-3 px-3">Postre</th>
                            <th class="py-3 px-3">Costo y tiempo</th>
                            <th class="py-3 px-3">Estado y acción</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-amber-500/20">
                        <?php foreach ($postres as $po) {
                            $activo = (intval($po['estado']) === 1);
                        ?>
                        <tr class="hover:bg-black/50 transition align-top">
                            <td class="py-3 px-3 font-semibold text-white"><?php echo htmlspecialchars($po['id_postre']); ?></td>
                            <td class="py-3 px-3">
                                <img src="../imagenes/<?php echo htmlspecialchars($po['imagen']); ?>" alt="<?php echo htmlspecialchars($po['postre']); ?>"
                                    class="w-14 h-14 rounded-lg object-cover border border-amber-500/40 bg-black">
                            </td>
                            <td class="py-3 px-3 font-bold text-white">
                                <?php echo htmlspecialchars($po['postre']); ?>
                            </td>
                            <td class="py-3 px-3 text-amber-100">
                                <p class="font-bold text-amber-400">MX$<?php echo htmlspecialchars($po['costo']); ?></p>
                                <p class="text-xs text-amber-200/80">Tiempo: <?php echo htmlspecialchars($po['tiempo']); ?> min</p>
                            </td>
                            <td class="py-3 px-3">
                                <p class="text-xs font-semibold mb-2 <?php echo $activo ? 'text-emerald-300' : 'text-red-300'; ?>">
                                    Estado: <?php echo htmlspecialchars($po['estado']); ?> (<?php echo $activo ? 'Activo' : 'Inactivo'; ?>)
                                </p>
                                <?php if ($activo) { ?>
                                    <a href="modificarPlatillo.php?tipo=postre&id=<?php echo urlencode($po['id_postre']); ?>&estado=0"
                                        onclick="return confirm('¿Desactivar este postre?');"
                                        class="inline-block px-3.5 py-1.5 rounded-full bg-red-950/80 hover:bg-red-800/80 text-red-200 border border-red-500/60 text-xs font-semibold transition">
                                        Desactivar
                                    </a>
                                <?php } else { ?>
                                    <a href="modificarPlatillo.php?tipo=postre&id=<?php echo urlencode($po['id_postre']); ?>&estado=1"
                                        onclick="return confirm('¿Activar este postre?');"
                                        class="inline-block px-3.5 py-1.5 rounded-full bg-emerald-900/80 hover:bg-emerald-800 text-emerald-200 border border-emerald-500/60 text-xs font-semibold transition">
                                        Activar
                                    </a>
                                <?php } ?>
                            </td>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </section>

        <!-- 3. BEBIDAS CALIENTES -->
        <section class="bg-[#0e0f14] border border-amber-400/70 glow-card rounded-xl p-6">
            <h3 class="text-xl sm:text-2xl font-bold text-amber-400 mb-4 border-b border-amber-500/30 pb-2">
                Bebidas Calientes
            </h3>
            <div class="overflow-x-auto font-sans">
                <table class="w-full text-left border-collapse text-sm">
                    <thead>
                        <tr class="bg-black border-b border-amber-500/50 text-amber-300">
                            <th class="py-3 px-3">ID</th>
                            <th class="py-3 px-3">Imagen</th>
                            <th class="py-3 px-3">Bebida</th>
                            <th class="py-3 px-3">Costo y tiempo</th>
                            <th class="py-3 px-3">Estado y acción</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-amber-500/20">
                        <?php foreach ($bebidas as $be) {
                            $activo = (intval($be['estado']) === 1);
                        ?>
                        <tr class="hover:bg-black/50 transition align-top">
                            <td class="py-3 px-3 font-semibold text-white"><?php echo htmlspecialchars($be['id_bebidaCal']); ?></td>
                            <td class="py-3 px-3">
                                <img src="../imagenes/<?php echo htmlspecialchars($be['imagen']); ?>" alt="<?php echo htmlspecialchars($be['bebida']); ?>"
                                    class="w-14 h-14 rounded-lg object-cover border border-amber-500/40 bg-black">
                            </td>
                            <td class="py-3 px-3 font-bold text-white">
                                <?php echo htmlspecialchars($be['bebida']); ?>
                            </td>
                            <td class="py-3 px-3 text-amber-100">
                                <p class="font-bold text-amber-400">MX$<?php echo htmlspecialchars($be['costo']); ?></p>
                                <p class="text-xs text-amber-200/80">Tiempo: <?php echo htmlspecialchars($be['tiempo']); ?> min</p>
                            </td>
                            <td class="py-3 px-3">
                                <p class="text-xs font-semibold mb-2 <?php echo $activo ? 'text-emerald-300' : 'text-red-300'; ?>">
                                    Estado: <?php echo htmlspecialchars($be['estado']); ?> (<?php echo $activo ? 'Activo' : 'Inactivo'; ?>)
                                </p>
                                <?php if ($activo) { ?>
                                    <a href="modificarPlatillo.php?tipo=bebida&id=<?php echo urlencode($be['id_bebidaCal']); ?>&estado=0"
                                        onclick="return confirm('¿Desactivar esta bebida caliente?');"
                                        class="inline-block px-3.5 py-1.5 rounded-full bg-red-950/80 hover:bg-red-800/80 text-red-200 border border-red-500/60 text-xs font-semibold transition">
                                        Desactivar
                                    </a>
                                <?php } else { ?>
                                    <a href="modificarPlatillo.php?tipo=bebida&id=<?php echo urlencode($be['id_bebidaCal']); ?>&estado=1"
                                        onclick="return confirm('¿Activar esta bebida caliente?');"
                                        class="inline-block px-3.5 py-1.5 rounded-full bg-emerald-900/80 hover:bg-emerald-800 text-emerald-200 border border-emerald-500/60 text-xs font-semibold transition">
                                        Activar
                                    </a>
                                <?php } ?>
                            </td>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </section>

    </main>

    <!-- Pie de página -->
    <footer class="bg-black border-t border-amber-500/40 px-4 py-4 text-center">
        <h5 class="text-sm sm:text-base text-amber-200/90 font-medium">
            Gracias por visitar nuestra página, esperamos que nos visites pronto
        </h5>
    </footer>
</body>
</html>