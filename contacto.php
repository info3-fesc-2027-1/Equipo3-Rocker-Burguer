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
            <div class="hidden sm:block w-20"></div>

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
            <a href="platillos.php" class="text-white hover:text-amber-400 transition">Platillos</a>
            <a href="nosotros.php" class="text-white hover:text-amber-400 transition">Nosotros</a>
            <a href="contacto.php" class="bg-gradient-to-r from-amber-400 to-orange-500 text-neutral-950 px-4 py-1 rounded-full shadow">
                Contacto
            </a>
        </div>
    </nav>

    <!-- Contenido principal -->
    <main class="flex-1 max-w-6xl w-full mx-auto px-4 sm:px-6 py-8">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-6 items-stretch">

            <!-- Sección Sucursales -->
            <section class="lg:col-span-5 flex">
                <article id="informacion"
                    class="w-full sucursales-grad text-neutral-950 rounded-xl p-6 sm:p-8 border border-amber-300/70 flex flex-col justify-center items-center text-center">
                    <h2 class="text-2xl sm:text-3xl font-extrabold tracking-wide mb-6">
                        SUCURSALES:
                    </h2>
                    <a href="https://maps.app.goo.gl/owxWhhgwgUi9T2WWA?g_st=aw" target="_blank" rel="noopener noreferrer"
                        class="inline-block bg-[#11131a] text-amber-400 hover:bg-black hover:text-amber-300 font-sans font-semibold text-base sm:text-lg px-6 py-2.5 rounded-full shadow-lg transition">
                        Rocker Burguer
                    </a>
                </article>
            </section>

            <!-- Columna Derecha: Contacto y Redes Sociales -->
            <aside class="lg:col-span-7 flex flex-col gap-6">
                <article id="contacto"
                    class="bg-[#0e0f14] border border-amber-400/70 glow-card rounded-xl p-6 font-sans space-y-2">
                    <p class="text-base sm:text-lg text-amber-100">
                        <span class="font-bold text-amber-300">Telefono:</span> 5520648975
                    </p>
                    <p class="text-base sm:text-lg text-amber-100 break-all">
                        <span class="font-bold text-amber-300">Correo:</span> VibeShop2024@gmail.com
                    </p>
                </article>

                <div class="bg-[#0e0f14] border border-amber-400/70 glow-card rounded-xl p-6 flex-1 flex flex-col justify-center">
                    <h2 class="text-xl sm:text-2xl font-bold text-amber-100 mb-5">
                        Redes sociales:
                    </h2>

                    <article id="redes" class="grid grid-cols-1 sm:grid-cols-2 gap-4 font-sans">
                        <div id="wi" class="contents">
                            <div class="bg-black/75 border border-amber-500/35 rounded-lg p-3.5 hover:border-amber-400 transition">
                                <p id="wi2" class="text-sm sm:text-base text-amber-200 font-semibold">
                                    WhatsApp: 5526184703
                                </p>
                            </div>

                            <div class="bg-black/75 border border-amber-500/35 rounded-lg p-3.5 hover:border-amber-400 transition">
                                <a href="https://www.instagram.com/rocker_burgers?cplk=ZjJ5c3V0OGRxdWJi" target="_blank" rel="noopener noreferrer"
                                    class="text-sm sm:text-base text-amber-300 hover:text-amber-200 font-semibold underline">
                                    Instagram:
                                </a>
                            </div>
                        </div>

                        <div id="ft" class="contents">
                            <div class="bg-black/75 border border-amber-500/35 rounded-lg p-3.5 hover:border-amber-400 transition">
                                <a href="https://www.facebook.com/share/19bCe5hpbB/" target="_blank" rel="noopener noreferrer"
                                    class="text-sm sm:text-base text-amber-300 hover:text-amber-200 font-semibold underline">
                                    Facebook:
                                </a>
                            </div>

                            <div class="bg-black/75 border border-amber-500/35 rounded-lg p-3.5 hover:border-amber-400 transition">
                                <a href="" class="text-sm sm:text-base text-amber-300 hover:text-amber-200 font-semibold underline">
                                    Twitter:
                                </a>
                            </div>
                        </div>
                    </article>
                </div>
            </aside>

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