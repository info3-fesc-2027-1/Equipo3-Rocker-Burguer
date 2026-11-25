<?php
session_start();
if(isset($_SESSION['usu'])){
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rocker Burger</title>
    <link rel="website icon" href="imagenes/icono.ico">
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        .glow-card {
            box-shadow: 0 0 18px rgba(245, 158, 11, 0.28), inset 0 0 10px rgba(251, 191, 36, 0.08);
        }
        .sucursales-grad {
            background: linear-gradient(135deg, #fde047 0%, #f59e0b 52%, #ea580c 100%);
            box-shadow: 0 0 24px rgba(245, 158, 11, 0.35);
        }
    </style>
</head>
<body class="min-h-screen flex flex-col bg-[#09090b] text-white font-serif">

    <!-- Encabezado -->
    <header class="bg-black border-b border-amber-500/40 px-4 sm:px-8 py-4">
        <div class="max-w-6xl mx-auto flex flex-col sm:flex-row items-center justify-between gap-3">
            <div class="hidden sm:block w-24"></div>

            <div id="titulo" class="text-center">
                <h1 class="text-xl sm:text-3xl font-bold tracking-wide text-amber-400">
                    Bienvenido a Rocker Burguer
                </h1>
            </div>

            <div id="cuenta" class="flex flex-col items-center justify-center sm:items-end w-24">
                <img src="imagenes/logo.jpg" alt="Cuenta" class="w-11 h-11 rounded-full object-cover border-2 border-amber-400 mb-1">
                <a href="cuenta.php" class="text-xs sm:text-sm font-sans font-semibold text-amber-300 hover:text-amber-200 underline transition">
                    Cuenta
                </a>
            </div>
        </div>
    </header>

    <!-- Navegación -->
    <nav class="bg-[#111114] border-b border-amber-500/30 px-4 py-3 font-sans">
        <div class="max-w-6xl mx-auto flex flex-wrap items-center justify-center gap-4 sm:gap-8 text-sm sm:text-base font-bold">
            <a href="principal.php" class="text-white hover:text-amber-400 transition">Principal</a>
            <a href="platillos.php" class="bg-gradient-to-r from-amber-400 to-orange-500 text-neutral-950 px-4 py-1 rounded-full shadow">Platillos</a>
            <a href="nosotros.php" class="text-white hover:text-amber-400 transition">Nosotros</a>
            <a href="contacto.php" class="text-white hover:text-amber-400 transition">
                Contacto
            </a>
        </div>
    </nav>

    <!-- Contenido principal -->
    <main class="flex-1 max-w-7xl w-full mx-auto px-4 sm:px-6 py-8">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-6 items-start">

            <!-- Izquierda: Platillos -->
            <div class="lg:col-span-7 flex justify-center">
                <div class="w-fit max-w-full bg-[#0e0f14] border border-amber-400/70 hover:border-amber-300 glow-card rounded-xl p-3.5 sm:p-4 flex flex-col items-center transition">
                    <img src="imagenes/PLATILLOS.jpg" alt="Platillos" class="max-w-full w-auto h-auto rounded-lg border border-amber-500/25 mb-3">
                    <span class="text-xl font-bold text-amber-400 tracking-wide">Platillos</span>
                </div>
            </div>

            <!-- Derecha: Bebidas Calientes y Postres en columna -->
            <div class="lg:col-span-5 flex flex-col items-center gap-6">

                <!-- Bebidas Calientes -->
                <div class="w-fit max-w-full bg-[#0e0f14] border border-amber-400/70 hover:border-amber-300 glow-card rounded-xl p-3.5 sm:p-4 flex flex-col items-center transition">
                    <img src="imagenes/BEBIDASCAL.jpg" alt="Bebidas Calientes" class="max-w-full w-auto h-auto rounded-lg border border-amber-500/25 mb-3">
                    <span class="text-lg font-bold text-amber-400 tracking-wide">Bebidas Calientes</span>
                </div>

                <!-- Postres -->
                <div class="w-fit max-w-full bg-[#0e0f14] border border-amber-400/70 hover:border-amber-300 glow-card rounded-xl p-3.5 sm:p-4 flex flex-col items-center transition">
                    <img src="imagenes/POSTRES.jpg" alt="Postres" class="max-w-full w-auto h-auto rounded-lg border border-amber-500/25 mb-3">
                    <span class="text-lg font-bold text-amber-400 tracking-wide">Postres</span>
                </div>

            </div>

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
<?php
}else{
    header("Location: index.php");
}
?>