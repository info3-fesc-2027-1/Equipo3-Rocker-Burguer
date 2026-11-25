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
            <a href="platillos.php" class="text-white hover:text-amber-400 transition">Platillos</a>
            <a href="nosotros.php" class="bg-gradient-to-r from-amber-400 to-orange-500 text-neutral-950 px-4 py-1 rounded-full shadow">Nosotros</a>
            <a href="contacto.php" class="text-white hover:text-amber-400 transition">
                Contacto
            </a>
        </div>
    </nav>

    <!-- Contenido principal -->
    <main class="flex-1 max-w-6xl w-full mx-auto px-4 sm:px-6 py-8">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-6 items-start">

            <!-- Columna Izquierda: Logo e Historia -->
            <section class="lg:col-span-5 flex flex-col items-center gap-6">
                <article class="flex justify-center">
                    <img src="imagenes/logo.jpg" alt="Logo Rocker Burguer" id="img"
                        class="w-40 sm:w-44 h-40 sm:h-44 object-cover rounded-2xl border-2 border-amber-400/80 glow-card">
                </article>

                <article id="informacion"
                    class="w-full bg-[#0e0f14] border border-amber-400/70 glow-card rounded-xl p-6 font-sans text-sm sm:text-base text-amber-100/90 leading-relaxed space-y-3 text-justify">
                    <p>
                        <strong class="block text-amber-400 font-serif text-base sm:text-lg text-center mb-1">
                            ¿Por qué se llama Rocker Burguer?
                        </strong>
                        El nombre nace de unir la energía, actitud y buena vibra de la música rock con el sabor contundente de unas hamburguesas bien hechas. La idea es que cada visita o pedido se sienta como entrar a un espacio con personalidad propia, buen ritmo y comida que deja huella desde el primer bocado.
                    </p>
                    <p>
                        <strong class="text-amber-300">Fundadora:</strong> Michelle Hernández Salazar
                    </p>
                    <p>
                        <strong class="text-amber-300">¿Año en que surgió?</strong> 28 de agosto del 2024
                    </p>
                    <p>
                        <strong class="block text-amber-400 font-serif text-base sm:text-lg text-center mt-2 mb-1">
                            ¿Historia de como comenzó?
                        </strong>
                        Todo comenzó como una pasión por reunir recetas caseras, combinaciones llenas de sabor y un ambiente con mucha personalidad. Con el tiempo, esa idea de crear un lugar donde disfrutar buenas hamburguesas, hot rocks, papas, bebidas y postres sin complicaciones tomó forma hasta convertirse en Rocker Burguer, un proyecto pensado para compartir buenos momentos en familia, con amigos o en pareja.
                    </p>
                </article>
            </section>

            <!-- Columna Derecha: Objetivo, Misión y Visión -->
            <aside class="lg:col-span-7 flex flex-col gap-6">
                
                <!-- Objetivo -->
                <article id="objetivo"
                    class="sucursales-grad text-neutral-950 rounded-xl p-6 sm:p-7 border border-amber-300/70 font-sans text-sm sm:text-base leading-relaxed text-justify">
                    <h2 class="font-serif text-xl sm:text-2xl font-extrabold mb-2">
                        Objetivo:
                    </h2>
                    <p class="font-medium">
                        El principal objetivo de Rocker Burguer es ofrecer una experiencia gastronómica rápida, sabrosa y confiable, cuidando tanto la calidad de cada platillo como la comodidad al ordenar en línea. Buscamos que desde que el cliente explora el menú hasta que recibe su pedido, todo el proceso sea ágil, claro y disfrutable.
                    </p>
                </article>

                <!-- Misión y Visión -->
                <article id="misivisi" class="grid grid-cols-1 sm:grid-cols-2 gap-6 font-sans text-sm sm:text-base leading-relaxed text-justify">
                    <div id="mision"
                        class="bg-[#0e0f14] border border-amber-400/70 glow-card rounded-xl p-6 text-amber-100/90">
                        <h3 class="font-serif text-lg sm:text-xl font-bold text-amber-400 mb-2">
                            Misión:
                        </h3>
                        <p>
                            Nuestra misión es preparar y acercar a nuestros clientes hamburguesas, hot rocks, botanas, bebidas y postres con ingredientes bien seleccionados, porciones generosas y precios accesibles, brindando una atención cercana y un servicio constante que haga que siempre quieran volver.
                        </p>
                    </div>

                    <div id="vision"
                        class="bg-[#0e0f14] border border-amber-400/70 glow-card rounded-xl p-6 text-amber-100/90">
                        <h3 class="font-serif text-lg sm:text-xl font-bold text-amber-400 mb-2">
                            Visión:
                        </h3>
                        <p>
                            Nuestra visión es consolidar a Rocker Burguer como uno de los restaurantes temáticos favoritos y más recomendados por su sabor y estilo, creciendo poco a poco con nuevas sucursales y mejorando cada día nuestra plataforma de pedidos en línea para llegar a más personas.
                        </p>
                    </div>
                </article>

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