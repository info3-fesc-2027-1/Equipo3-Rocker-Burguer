<?php
session_start();
if(isset($_SESSION['usu'])){
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rocker Burger - Administración</title>
    <link rel="website icon" href="../imagenes/icono.ico">
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
        <div class="max-w-5xl mx-auto flex flex-col items-center justify-center gap-1">
            <h1 class="text-2xl sm:text-3xl font-bold tracking-wide text-amber-400 text-center">
                Administración de Rocker Burger
            </h1>
        </div>
    </header>

    <!-- Contenido principal -->
    <main class="flex-1 max-w-4xl w-full mx-auto px-4 sm:px-6 py-8 flex flex-col items-center justify-center">
        <div class="w-full bg-[#0e0f14] border border-amber-400/70 glow-card rounded-2xl p-6 sm:p-8 flex flex-col items-center gap-7">

            <!-- Botones principales -->
            <div class="w-full grid grid-cols-1 sm:grid-cols-2 gap-4 font-sans">
                <button type="button" onclick="location.href='modificarPlatillo.php'"
                    class="w-full py-3 px-5 rounded-xl bg-gradient-to-r from-amber-400 to-orange-500 hover:from-amber-300 hover:to-orange-400 text-neutral-950 font-bold text-sm sm:text-base shadow transition cursor-pointer">
                    Platillos
                </button>

                <button type="button" onclick="location.href='cuenta.php'"
                    class="w-full py-3 px-5 rounded-xl bg-neutral-900 hover:bg-neutral-800 text-amber-300 border border-amber-500/50 font-semibold text-sm sm:text-base transition cursor-pointer">
                    Cuenta personal
                </button>

                <button type="button" onclick="location.href='pedidos.php'"
                    class="w-full py-3 px-5 rounded-xl bg-neutral-900 hover:bg-neutral-800 text-amber-300 border border-amber-500/50 font-semibold text-sm sm:text-base transition cursor-pointer">
                    Pedidos
                </button>
            </div>

            <!-- Imagen de bienvenida -->
            <div class="w-fit max-w-full bg-black rounded-xl p-2 border border-amber-500/30 flex items-center justify-center">
                <img src="../imagenes/logo.jpg" alt="Bienvenido a Rocker Burger"
                    class="w-auto max-w-full h-auto max-h-72 object-contain rounded-lg">
            </div>

            <!-- Cerrar sesión -->
            <div class="w-full max-w-xs pt-2 border-t border-amber-500/25 font-sans flex justify-center">
                <?php foreach($_SESSION['usu'] as $usu){ ?>
                <button type="button" onclick="location.href='destruir.php?correo=<?php echo $usu['correo']?>'"
                    class="w-full py-2.5 px-5 rounded-full bg-red-950/60 hover:bg-red-900/70 text-red-300 border border-red-500/50 font-semibold text-sm transition cursor-pointer">
                    Cerrar sesion
                </button>
                <?php }?>
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