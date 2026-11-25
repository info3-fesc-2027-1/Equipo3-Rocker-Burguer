<?php // Inicia bloque PHP
session_start(); // Inicia o reanuda la sesión en el servidor
if (!isset($_SESSION['usu'])) { // Verifica si no existe sesión de usuario activa
    header("Location: index.php"); // Redirige al inicio de sesión
    exit(); // Detiene la ejecución del script
} // Cierra condicional de sesión
?> <!-- Cierra bloque PHP -->
<!DOCTYPE html> <!-- Declara documento HTML5 -->
<html lang="es"> <!-- Define el idioma español -->
<head> <!-- Inicia cabecera del documento -->
    <meta charset="UTF-8"> <!-- Configura codificación UTF-8 -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> <!-- Configura vista responsiva -->
    <title>Rocker Burger</title> <!-- Título en la pestaña del navegador -->
    <link rel="website icon" href="imagenes/icono.ico">
    <script src="https://cdn.tailwindcss.com"></script> <!-- Carga Tailwind CSS desde CDN -->
</head> <!-- Cierra cabecera -->
<body class="min-h-screen bg-[#09090b] text-white font-sans p-6"> <!-- Estilo base del cuerpo -->
    <div class="max-w-3xl mx-auto bg-[#111114] border border-amber-500/40 rounded-2xl p-6 space-y-6"> <!-- Contenedor principal -->
        <div class="flex items-center justify-between border-b border-amber-500/30 pb-3"> <!-- Encabezado del resumen -->
            <h1 class="text-2xl font-bold text-amber-400">Tu Pedido</h1> <!-- Título de la sección -->
            <a href="principal.php" class="text-sm text-amber-300 underline">Volver al menú</a> <!-- Enlace para regresar al menú -->
        </div> <!-- Cierra encabezado del resumen -->

        <div id="resumen-items" class="space-y-2 text-sm"></div> <!-- Contenedor donde JS pinta los productos -->

        <div class="bg-black/60 border border-amber-500/30 rounded-xl p-4 flex flex-wrap justify-between gap-4"> <!-- Barra de tiempo y total -->
            <div> <!-- Contenedor del tiempo estimado -->
                <span class="text-neutral-300 text-sm">Tiempo aprox. de preparación:</span> <!-- Etiqueta de tiempo -->
                <strong id="tiempo-aprox" class="text-amber-400 text-lg ml-1">0 min</strong> <!-- Muestra minutos máximos -->
            </div> <!-- Cierra contenedor de tiempo -->
            <div> <!-- Contenedor del total -->
                <span class="text-neutral-300 text-sm">Total a pagar:</span> <!-- Etiqueta de total -->
                <strong id="total-pagar" class="text-amber-400 text-xl ml-1">$0</strong> <!-- Muestra total acumulado -->
            </div> <!-- Cierra contenedor de total -->
        </div> <!-- Cierra barra de tiempo y total -->

        <form id="form-pedido" action="procesar_pedido.php" method="POST" class="space-y-4"> <!-- Formulario de confirmación -->
            <input type="hidden" name="carrito_json" id="carrito_json"> <!-- Campo oculto para el carrito serializado -->
            <input type="hidden" name="fecha_dispositivo" id="fecha_dispositivo"> <!-- Campo oculto para fecha local -->
            <input type="hidden" name="hora_dispositivo" id="hora_dispositivo"> <!-- Campo oculto para hora local -->

            <div> <!-- Campo de monto a pagar -->
                <label for="pago_cliente" class="block text-sm font-semibold text-amber-200 mb-1"> <!-- Etiqueta del monto -->
                    Monto a pagar (debe ser exacto al total) <!-- Instrucción de pago exacto -->
                </label> <!-- Cierra etiqueta -->
                <input type="number" step="any" name="pago_cliente" id="pago_cliente" required 
                    placeholder="Escribe el monto exacto" 
                    class="w-full bg-black border border-amber-500/40 rounded-lg px-3 py-2 text-white"> <!-- Clases de estilo -->
            </div> <!-- Cierra campo de monto -->

            <div> <!-- Campo de número de mesa -->
                <label for="mesa" class="block text-sm font-semibold text-amber-200 mb-1"> <!-- Etiqueta de mesa -->
                    Número de mesa <!-- Texto de etiqueta -->
                </label> <!-- Cierra etiqueta -->
                <input type="number" min="1" max="999" name="mesa" id="mesa" required 
                    placeholder="Ej. 4" 
                    class="w-full bg-black border border-amber-500/40 rounded-lg px-3 py-2 text-white"> <!-- Clases de estilo -->
            </div> <!-- Cierra campo de mesa -->

            <div> <!-- Campo de aclaraciones -->
                <label for="aclaraciones" class="block text-sm font-semibold text-amber-200 mb-1"> <!-- Etiqueta de aclaraciones -->
                    Aclaraciones (opcional) <!-- Indica campo opcional -->
                </label> <!-- Cierra etiqueta -->
                <textarea name="aclaraciones" id="aclaraciones" rows="3" maxlength="250" 
                    placeholder="Aclaraciones con respecto a su pedido escriba Aquí por favor" 
                    class="w-full bg-black border border-amber-500/40 rounded-lg px-3 py-2 text-white"></textarea> <!-- Clases de estilo -->
            </div> <!-- Cierra campo de aclaraciones -->

            <!-- Botón para enviar el pedido -->
            <button type="submit" 
                class="w-full bg-gradient-to-r from-amber-400 to-orange-500 hover:from-amber-300 hover:to-orange-400 text-neutral-950 font-bold py-2.5 rounded-full transition"> <!-- Clases del botón -->
                Confirmar y crear pedido <!-- Texto del botón -->
            </button> <!-- Cierra botón -->
        </form> <!-- Cierra formulario -->
    </div> <!-- Cierra contenedor principal -->

<script> // Inicia bloque JavaScript
const STORAGE_KEY = "rocker_burger_carrito"; // Clave usada en localStorage
const carrito = JSON.parse(localStorage.getItem(STORAGE_KEY)) || []; // Lee y parsea el carrito guardado

function calcularTotales() { // Calcula total monetario y tiempo máximo
    let total = 0; // Inicializa acumulador del total
    let tiempoMax = 0; // Inicializa tiempo máximo en minutos

    carrito.forEach(item => { // Recorre cada elemento del carrito
        total += Number(item.precio) || 0; // Suma el subtotal del elemento
        const t = Number(item.tiempo) || 0; // Obtiene tiempo numérico del elemento
        if (t > tiempoMax) tiempoMax = t; // Actualiza si este tiempo es mayor
    }); // Cierra forEach

    return { total, tiempoMax }; // Devuelve total y tiempo máximo
} // Cierra calcularTotales

function cargarResumen() { // Renderiza productos, totales y campo oculto JSON
    const contenedor = document.getElementById("resumen-items"); // Obtiene contenedor de ítems
    if (carrito.length === 0) { // Revisa si el carrito está vacío
        contenedor.innerHTML = `<p class="text-neutral-400">No hay productos en el carrito.</p>`; // Muestra mensaje vacío
        document.getElementById("form-pedido").querySelector("button[type='submit']").disabled = true; // Deshabilita envío
        return; // Sale de la función
    } // Cierra condicional de carrito vacío

    // Genera tarjetas HTML por cada producto
    contenedor.innerHTML = carrito.map(item => ` 
        <div class="flex justify-between items-center bg-black/50 border border-amber-500/20 rounded-lg px-4 py-2"> <!-- Fila del producto -->
            <div> <!-- Datos del producto -->
                <p class="font-bold text-amber-100">${item.nombre} <span class="text-xs text-amber-400">(${item.tipo})</span></p> <!-- Nombre y tipo -->
                <p class="text-xs text-neutral-400">Cantidad: ${item.cantidad} × $${item.precioUnitario} | Tiempo: ${item.tiempo} min</p> <!-- Cantidad, unitario y tiempo -->
            </div> <!-- Cierra datos del producto -->
            <span class="font-bold text-amber-400">$${item.precio}</span> <!-- Subtotal del producto -->
        </div> <!-- Cierra fila del producto -->
    `).join(""); // Une las cadenas HTML en una sola

    const { total, tiempoMax } = calcularTotales(); // Obtiene total y tiempo aproximado
    document.getElementById("total-pagar").textContent = `$${total}`; // Pinta el total en pantalla
    document.getElementById("tiempo-aprox").textContent = `${tiempoMax} min`; // Pinta el tiempo máximo en pantalla
    document.getElementById("carrito_json").value = JSON.stringify(carrito); // Guarda el JSON en el input oculto
} // Cierra cargarResumen

document.getElementById("form-pedido").addEventListener("submit", function(e) { // Intercepta el envío del formulario
    const { total } = calcularTotales(); // Calcula el total esperado
    const montoIngresado = Number(document.getElementById("pago_cliente").value); // Lee el monto escrito por el usuario

    if (montoIngresado !== total) { // Valida que el pago sea exactamente igual al total
        e.preventDefault(); // Cancela el envío del formulario
        alert(`Debes ingresar exactamente el total de la compra: $${total}.`); // Avisa al usuario
        return; // Sale del manejador
    } // Cierra validación de monto

    const ahora = new Date(); // Obtiene fecha y hora actual del dispositivo
    const pad = n => String(n).padStart(2, "0"); // Rellena números de un dígito con cero
    const fecha = `${ahora.getFullYear()}-${pad(ahora.getMonth() + 1)}-${pad(ahora.getDate())}`; // Formatea fecha YYYY-MM-DD
    const hora = `${pad(ahora.getHours())}:${pad(ahora.getMinutes())}:${pad(ahora.getSeconds())}`; // Formatea hora HH:MM:SS

    document.getElementById("fecha_dispositivo").value = fecha; // Asigna fecha al input oculto
    document.getElementById("hora_dispositivo").value = hora; // Asigna hora al input oculto
}); // Cierra listener de submit

document.addEventListener("DOMContentLoaded", cargarResumen); // Ejecuta cargarResumen al cargar el DOM
</script> <!-- Cierra bloque JavaScript -->
</body> <!-- Cierra cuerpo -->
</html> <!-- Cierra documento HTML -->