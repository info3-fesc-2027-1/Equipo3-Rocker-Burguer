<?php
session_start();
if(isset($_SESSION['usu'])){
    include_once("php/consultaProductos.php");
    $_SESSION['pedidos']=null;
    $c=new productos();
    $hamburguesas=$c->Hamburguesas();
    $hot=$c->HotRocks();
    $papas=$c->Papas();
    $compartir=$c->ParaCompartir();
    $bebidas=$c->NuestrasBebidas();
    $postres=$c->buscarPostre();
    $calientes=$c->buscarBebidaCal();
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
            <a href="principal.php" class="bg-gradient-to-r from-amber-400 to-orange-500 text-neutral-950 px-4 py-1 rounded-full shadow">Principal</a>
            <a href="platillos.php" class="text-white hover:text-amber-400 transition">Platillos</a>
            <a href="nosotros.php" class="text-white hover:text-amber-400 transition">Nosotros</a>
            <a href="contacto.php" class="text-white hover:text-amber-400 transition">Contacto</a>
        </div>
    </nav>

    <!-- Contenido principal -->
    <main class="flex-1 max-w-6xl w-full mx-auto px-4 sm:px-6 py-8 space-y-12">

        <!-- Hamburguesas -->
        <section>
            <h3 class="text-xl sm:text-2xl font-bold text-amber-400 border-b border-amber-500/40 pb-1.5 mb-4">
                Hamburguesas
            </h3>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                <?php foreach($hamburguesas as $ham){ ?>
                <div class="bg-[#0e0f14] border border-amber-500/35 hover:border-amber-400 glow-card rounded-xl p-4 flex flex-col justify-between transition">
                    <div>
                        <div class="w-full bg-black rounded-lg overflow-hidden mb-4 border border-amber-500/20 flex items-center justify-center p-1">
                            <img src="imagenes/<?php echo $ham['imagen']?>" alt="<?php echo $ham['comida']?>" class="w-auto max-w-full h-auto max-h-60 object-contain rounded">
                        </div>
                        <h4 class="text-lg font-bold text-amber-100"><?php echo $ham['comida']?></h4>
                        <p class="font-sans text-amber-400 font-bold text-base mt-1">MX$<?php echo $ham['costo']?></p>
                    </div>
                    <div class="mt-4 pt-2 flex flex-col gap-2 font-sans">
                        <button type="button"
                            onclick="agregarAlCarrito(this)"
                            data-origen="platillo"
                            data-id="<?php echo $ham['id_platillo']; ?>"
                            data-tipo="<?php echo htmlspecialchars($ham['tipo']); ?>"
                            data-nombre="<?php echo htmlspecialchars($ham['comida']); ?>"
                            data-costo="<?php echo $ham['costo']; ?>"
                            data-tiempo="<?php echo $ham['tiempo']; ?>"
                            class="w-full text-center font-semibold text-sm bg-neutral-900 hover:bg-neutral-800 text-amber-300 border border-amber-500/50 py-2 rounded-full transition">
                            Agregar al carrito
                        </button>
                    </div>
                </div>
                <?php } ?>
            </div>
        </section>

        <!-- Hot Rocks -->
        <section>
            <h3 class="text-xl sm:text-2xl font-bold text-amber-400 border-b border-amber-500/40 pb-1.5 mb-4">
                Hot Rocks
            </h3>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                <?php foreach($hot as $h){ ?>
                <div class="bg-[#0e0f14] border border-amber-500/35 hover:border-amber-400 glow-card rounded-xl p-4 flex flex-col justify-between transition">
                    <div>
                        <div class="w-full bg-black rounded-lg overflow-hidden mb-4 border border-amber-500/20 flex items-center justify-center p-1">
                            <img src="imagenes/<?php echo $h['imagen']?>" alt="<?php echo $h['comida']?>" class="w-auto max-w-full h-auto max-h-60 object-contain rounded">
                        </div>
                        <h4 class="text-lg font-bold text-amber-100"><?php echo $h['comida']?></h4>
                        <p class="font-sans text-amber-400 font-bold text-base mt-1">MX$<?php echo $h['costo']?></p>
                    </div>
                    <div class="mt-4 pt-2 flex flex-col gap-2 font-sans">
                        <button type="button"
                            onclick="agregarAlCarrito(this)"
                            data-origen="platillo"
                            data-id="<?php echo $h['id_platillo']; ?>"
                            data-tipo="<?php echo htmlspecialchars($h['tipo']); ?>"
                            data-nombre="<?php echo htmlspecialchars($h['comida']); ?>"
                            data-costo="<?php echo $h['costo']; ?>"
                            data-tiempo="<?php echo $h['tiempo']; ?>"
                            class="w-full text-center font-semibold text-sm bg-neutral-900 hover:bg-neutral-800 text-amber-300 border border-amber-500/50 py-2 rounded-full transition">
                            Agregar al carrito
                        </button>
                    </div>
                </div>
                <?php } ?>
            </div>
        </section>

        <!-- Papas -->
        <section>
            <h3 class="text-xl sm:text-2xl font-bold text-amber-400 border-b border-amber-500/40 pb-1.5 mb-4">
                Papas
            </h3>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                <?php foreach($papas as $pa){ ?>
                <div class="bg-[#0e0f14] border border-amber-500/35 hover:border-amber-400 glow-card rounded-xl p-4 flex flex-col justify-between transition">
                    <div>
                        <div class="w-full bg-black rounded-lg overflow-hidden mb-4 border border-amber-500/20 flex items-center justify-center p-1">
                            <img src="imagenes/<?php echo $pa['imagen']?>" alt="<?php echo $pa['comida']?>" class="w-auto max-w-full h-auto max-h-60 object-contain rounded">
                        </div>
                        <h4 class="text-lg font-bold text-amber-100"><?php echo $pa['comida']?></h4>
                        <p class="font-sans text-amber-400 font-bold text-base mt-1">MX$<?php echo $pa['costo']?></p>
                    </div>
                    <div class="mt-4 pt-2 flex flex-col gap-2 font-sans">
                        <button type="button"
                            onclick="agregarAlCarrito(this)"
                            data-origen="platillo"
                            data-id="<?php echo $pa['id_platillo']; ?>"
                            data-tipo="<?php echo htmlspecialchars($pa['tipo']); ?>"
                            data-nombre="<?php echo htmlspecialchars($pa['comida']); ?>"
                            data-costo="<?php echo $pa['costo']; ?>"
                            data-tiempo="<?php echo $pa['tiempo']; ?>"
                            class="w-full text-center font-semibold text-sm bg-neutral-900 hover:bg-neutral-800 text-amber-300 border border-amber-500/50 py-2 rounded-full transition">
                            Agregar al carrito
                        </button>
                    </div>
                </div>
                <?php } ?>
            </div>
        </section>

        <!-- Para Compartir -->
        <section>
            <h3 class="text-xl sm:text-2xl font-bold text-amber-400 border-b border-amber-500/40 pb-1.5 mb-4">
                Para Compartir
            </h3>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                <?php foreach($compartir as $com){ ?>
                <div class="bg-[#0e0f14] border border-amber-500/35 hover:border-amber-400 glow-card rounded-xl p-4 flex flex-col justify-between transition">
                    <div>
                        <div class="w-full bg-black rounded-lg overflow-hidden mb-4 border border-amber-500/20 flex items-center justify-center p-1">
                            <img src="imagenes/<?php echo $com['imagen']?>" alt="<?php echo $com['comida']?>" class="w-auto max-w-full h-auto max-h-60 object-contain rounded">
                        </div>
                        <h4 class="text-lg font-bold text-amber-100"><?php echo $com['comida']?></h4>
                        <p class="font-sans text-amber-400 font-bold text-base mt-1">MX$<?php echo $com['costo']?></p>
                    </div>
                    <div class="mt-4 pt-2 flex flex-col gap-2 font-sans">
                        <button type="button"
                            onclick="agregarAlCarrito(this)"
                            data-origen="platillo"
                            data-id="<?php echo $com['id_platillo']; ?>"
                            data-tipo="<?php echo htmlspecialchars($com['tipo']); ?>"
                            data-nombre="<?php echo htmlspecialchars($com['comida']); ?>"
                            data-costo="<?php echo $com['costo']; ?>"
                            data-tiempo="<?php echo $com['tiempo']; ?>"
                            class="w-full text-center font-semibold text-sm bg-neutral-900 hover:bg-neutral-800 text-amber-300 border border-amber-500/50 py-2 rounded-full transition">
                            Agregar al carrito
                        </button>
                    </div>
                </div>
                <?php } ?>
            </div>
        </section>

        <!-- Nuestras Bebidas -->
        <section>
            <h3 class="text-xl sm:text-2xl font-bold text-amber-400 border-b border-amber-500/40 pb-1.5 mb-4">
                Nuestras Bebidas
            </h3>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                <?php foreach($bebidas as $be){ ?>
                <div class="bg-[#0e0f14] border border-amber-500/35 hover:border-amber-400 glow-card rounded-xl p-4 flex flex-col justify-between transition">
                    <div>
                        <div class="w-full bg-black rounded-lg overflow-hidden mb-4 border border-amber-500/20 flex items-center justify-center p-1">
                            <img src="imagenes/<?php echo $be['imagen']?>" alt="<?php echo $be['comida']?>" class="w-auto max-w-full h-auto max-h-60 object-contain rounded">
                        </div>
                        <h4 class="text-lg font-bold text-amber-100"><?php echo $be['comida']?></h4>
                        <p class="font-sans text-amber-400 font-bold text-base mt-1">MX$<?php echo $be['costo']?></p>
                    </div>
                    <div class="mt-4 pt-2 flex flex-col gap-2 font-sans">
                        <button type="button"
                            onclick="agregarAlCarrito(this)"
                            data-origen="platillo"
                            data-id="<?php echo $be['id_platillo']; ?>"
                            data-tipo="<?php echo htmlspecialchars($be['tipo']); ?>"
                            data-nombre="<?php echo htmlspecialchars($be['comida']); ?>"
                            data-costo="<?php echo $be['costo']; ?>"
                            data-tiempo="<?php echo $be['tiempo']; ?>"
                            class="w-full text-center font-semibold text-sm bg-neutral-900 hover:bg-neutral-800 text-amber-300 border border-amber-500/50 py-2 rounded-full transition">
                            Agregar al carrito
                        </button>
                    </div>
                </div>
                <?php } ?>
            </div>
        </section>

        <!-- Postres -->
        <section>
            <h3 class="text-xl sm:text-2xl font-bold text-amber-400 border-b border-amber-500/40 pb-1.5 mb-4">
                Postres
            </h3>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                <?php foreach($postres as $pos){ ?>
                <div class="bg-[#0e0f14] border border-amber-500/35 hover:border-amber-400 glow-card rounded-xl p-4 flex flex-col justify-between transition">
                    <div>
                        <div class="w-full bg-black rounded-lg overflow-hidden mb-4 border border-amber-500/20 flex items-center justify-center p-1">
                            <img src="imagenes/<?php echo $pos['imagen']?>" alt="<?php echo $pos['postre']?>" class="w-auto max-w-full h-auto max-h-60 object-contain rounded">
                        </div>
                        <h4 class="text-lg font-bold text-amber-100"><?php echo $pos['postre']?></h4>
                        <p class="font-sans text-amber-400 font-bold text-base mt-1">MX$<?php echo $pos['costo']?></p>
                    </div>
                    <div class="mt-4 pt-2 flex flex-col gap-2 font-sans">
                        <button type="button"
                            onclick="agregarAlCarrito(this)"
                            data-origen="postre"
                            data-id="<?php echo $pos['id_postre']; ?>"
                            data-tipo="Postre"
                            data-nombre="<?php echo htmlspecialchars($pos['postre']); ?>"
                            data-costo="<?php echo $pos['costo']; ?>"
                            data-tiempo="<?php echo $pos['tiempo']; ?>"
                            class="w-full text-center font-semibold text-sm bg-neutral-900 hover:bg-neutral-800 text-amber-300 border border-amber-500/50 py-2 rounded-full transition">
                            Agregar al carrito
                        </button>
                    </div>
                </div>
                <?php } ?>
            </div>
        </section>

        <!-- Bebidas Calientes -->
        <section>
            <h3 class="text-xl sm:text-2xl font-bold text-amber-400 border-b border-amber-500/40 pb-1.5 mb-4">
                Bebidas Calientes
            </h3>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                <?php foreach($calientes as $cal){ ?>
                <div class="bg-[#0e0f14] border border-amber-500/35 hover:border-amber-400 glow-card rounded-xl p-4 flex flex-col justify-between transition">
                    <div>
                        <div class="w-full bg-black rounded-lg overflow-hidden mb-4 border border-amber-500/20 flex items-center justify-center p-1">
                            <img src="imagenes/<?php echo $cal['imagen']?>" alt="<?php echo $cal['bebida']?>" class="w-auto max-w-full h-auto max-h-60 object-contain rounded">
                        </div>
                        <h4 class="text-lg font-bold text-amber-100"><?php echo $cal['bebida']?></h4>
                        <p class="font-sans text-amber-400 font-bold text-base mt-1">MX$<?php echo $cal['costo']?></p>
                    </div>
                    <div class="mt-4 pt-2 flex flex-col gap-2 font-sans">
                        <button type="button"
                            onclick="agregarAlCarrito(this)"
                            data-origen="bebidaCal"
                            data-id="<?php echo $cal['id_bebidaCal']; ?>"
                            data-tipo="Bebida Caliente"
                            data-nombre="<?php echo htmlspecialchars($cal['bebida']); ?>"
                            data-costo="<?php echo $cal['costo']; ?>"
                            data-tiempo="<?php echo $cal['tiempo']; ?>"
                            class="w-full text-center font-semibold text-sm bg-neutral-900 hover:bg-neutral-800 text-amber-300 border border-amber-500/50 py-2 rounded-full transition">
                            Agregar al carrito
                        </button>
                    </div>
                </div>
                <?php } ?>
            </div>
        </section>

    </main>

    <footer class="bg-black border-t border-amber-500/40 px-4 py-4 text-center">
        <h5 class="text-sm sm:text-base text-amber-200/90 font-medium">
            Gracias por visitar nuestra página, esperamos que nos visites pronto
        </h5>
    </footer>
    <!-- CARRITO -->
<div id="widget-carrito" class="fixed bottom-5 right-5 z-50 bg-[#111114] border border-amber-400/70 glow-card rounded-2xl p-4 w-72 sm:w-80 font-sans shadow-2xl">
    <div class="flex items-center justify-between border-b border-amber-500/30 pb-2 mb-2">
        <span class="font-bold text-amber-400 text-sm">🛒 Tu Carrito (<span id="carrito-count">0</span>)</span>
        <span class="font-bold text-white text-sm">Total: $<span id="carrito-total">0</span></span>
    </div>

    <div id="carrito-lista" class="max-h-40 overflow-y-auto space-y-1.5 text-xs text-amber-100 mb-3">
        <p class="text-neutral-400">Aún no agregas elementos.</p>
    </div>

    <div class="flex gap-2">
        <button type="button" onclick="vaciarCarrito()"
            class="flex-1 bg-neutral-800 hover:bg-neutral-700 text-amber-200 border border-amber-500/40 py-1.5 rounded-full text-xs font-semibold transition">
            Vaciar
        </button>
        <button type="button" onclick="irAPagar()"
            class="flex-1 bg-gradient-to-r from-amber-400 to-orange-500 hover:from-amber-300 hover:to-orange-400 text-neutral-950 py-1.5 rounded-full text-xs font-bold transition">
            Pagar
        </button>
    </div>
</div>

<script>
const STORAGE_KEY = "rocker_burger_carrito";

function obtenerCarrito() {
    return JSON.parse(localStorage.getItem(STORAGE_KEY)) || [];
}

function guardarCarrito(carrito) {
    localStorage.setItem(STORAGE_KEY, JSON.stringify(carrito));
    renderizarWidgetCarrito();
}

function agregarAlCarrito(btn) {
    const origen = btn.dataset.origen;
    const id = parseInt(btn.dataset.id, 10);
    const tipo = btn.dataset.tipo;
    const nombre = btn.dataset.nombre;
    const costo = parseFloat(btn.dataset.costo);
    const tiempo = parseInt(btn.dataset.tiempo || 0, 10);
    const clave = `${origen}-${id}`;

    const carrito = obtenerCarrito();
    const existente = carrito.find(item => item.clave === clave);

    if (existente) {
        existente.cantidad += 1;
        existente.precio = existente.cantidad * existente.precioUnitario;
    } else {
        carrito.push({
            clave,
            id,
            origen,
            tipo,
            nombre,
            cantidad: 1,
            precioUnitario: costo,
            precio: costo,
            tiempo
        });
    }

    guardarCarrito(carrito);
}

function vaciarCarrito() {
    localStorage.removeItem(STORAGE_KEY);
    renderizarWidgetCarrito();
}

function irAPagar() {
    const carrito = obtenerCarrito();
    if (carrito.length === 0) {
        alert("Tu carrito está vacío.");
        return;
    }
    window.location.href = "carrito.php";
}

function renderizarWidgetCarrito() {
    const carrito = obtenerCarrito();
    const listaEl = document.getElementById("carrito-lista");
    const totalEl = document.getElementById("carrito-total");
    const countEl = document.getElementById("carrito-count");

    let total = 0;
    let totalArticulos = 0;

    if (carrito.length === 0) {
        listaEl.innerHTML = `<p class="text-neutral-400">Aún no agregas elementos.</p>`;
        totalEl.textContent = "0";
        countEl.textContent = "0";
        return;
    }

    listaEl.innerHTML = carrito.map(item => {
        total += item.precio;
        totalArticulos += item.cantidad;
        return `
            <div class="flex justify-between items-center bg-black/60 px-2 py-1 rounded border border-amber-500/20">
                <span class="truncate pr-2">${item.nombre} <b>x${item.cantidad}</b></span>
                <span class="text-amber-400 font-semibold">$${item.precio}</span>
            </div>
        `;
    }).join("");

    totalEl.textContent = total;
    countEl.textContent = totalArticulos;
}

document.addEventListener("DOMContentLoaded", renderizarWidgetCarrito);
</script>

</body>
</html>
<?php
}else{
    header("Location: index.php");
}
?>