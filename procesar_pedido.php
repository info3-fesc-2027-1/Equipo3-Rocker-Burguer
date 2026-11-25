<?php // Inicia bloque PHP
session_start(); // Inicia o reanuda la sesión
if ($_SERVER["REQUEST_METHOD"] !== "POST" || !isset($_SESSION['usu'])) { // Valida método POST y sesión activa
    header("Location: principal.php"); // Redirige a principal si no cumple
    exit(); // Detiene la ejecución
} // Cierra validación inicial

include_once("php/conn.php"); // Incluye clase de conexión a la BD
$c = new conn(); // Instancia la clase conn
$pdo = $c->coneccion(); // Obtiene el objeto PDO de conexión

$carrito = json_decode($_POST['carrito_json'] ?? '[]', true); // Decodifica el carrito JSON en arreglo asociativo
$pagoCliente = floatval($_POST['pago_cliente'] ?? 0); // Convierte monto pagado a flotante
$mesa = intval($_POST['mesa'] ?? 0); // Convierte número de mesa a entero
$aclaraciones = trim($_POST['aclaraciones'] ?? ''); // Limpia espacios de aclaraciones
$fecha = $_POST['fecha_dispositivo'] ?? date('Y-m-d'); // Toma fecha del dispositivo o del servidor
$hora = $_POST['hora_dispositivo'] ?? date('H:i:s'); // Toma hora del dispositivo o del servidor

if (empty($carrito) || $mesa <= 0) { // Verifica que haya productos y mesa válida
    echo "<script>alert('Datos de pedido incompletos.'); window.location='carrito.php';</script>"; // Alerta y regresa
    exit(); // Detiene la ejecución
} // Cierra validación de datos básicos

$totalCalculado = 0; // Inicializa total calculado en servidor
$tiempoAprox = 0; // Inicializa tiempo máximo de preparación
foreach ($carrito as $item) { // Recorre cada ítem del carrito
    $cant = intval($item['cantidad'] ?? 0); // Obtiene cantidad como entero
    $unit = floatval($item['precioUnitario'] ?? 0); // Obtiene precio unitario como flotante
    $t = intval($item['tiempo'] ?? 0); // Obtiene tiempo de preparación como entero
    if ($cant <= 0 || $unit < 0) continue; // Ignora elementos inválidos
    $totalCalculado += ($cant * $unit); // Acumula subtotal al total
    if ($t > $tiempoAprox) { // Compara contra el tiempo máximo actual
        $tiempoAprox = $t; // Guarda el mayor tiempo encontrado
    } // Cierra comparación de tiempo
} // Cierra recorrido del carrito

if (round($pagoCliente, 2) !== round($totalCalculado, 2)) { // Verifica pago exacto en servidor
    echo "<script>alert('El monto ingresado debe ser exactamente igual al total (\$$totalCalculado).'); window.location='carrito.php';</script>"; // Alerta y regresa
    exit(); // Detiene la ejecución
} // Cierra validación de pago exacto

$datosSesion = $_SESSION['usu'][0] ?? []; // Toma el arreglo del usuario en el índice 0
$correoSesion = $datosSesion['correo'] ?? ''; // Extrae el correo del usuario en sesión

if (!empty($datosSesion['id_cliente'])) { // Si id_cliente ya viene dentro de la sesión
    $idCliente = intval($datosSesion['id_cliente']); // Lo usa directo como entero
} else { // Si no viene en sesión, consulta la tabla clientes por correo[cite: 12]
    $stmtCli = $pdo->prepare("SELECT id_cliente FROM clientes WHERE id_correo = ? LIMIT 1"); // Prepara consulta en clientes[cite: 12]
    $stmtCli->execute([$correoSesion]); // Ejecuta consulta con el correo[cite: 12]
    $cliente = $stmtCli->fetch(PDO::FETCH_ASSOC); // Obtiene la fila encontrada[cite: 12]

    if (!$cliente) { // Si no existe el cliente en la base de datos[cite: 12]
        echo "<script>alert('No se encontró el cliente asociado al usuario.'); window.location='carrito.php';</script>"; // Alerta y regresa
        exit(); // Detiene la ejecución
    } // Cierra validación de cliente
    $idCliente = intval($cliente['id_cliente']); // Guarda id_cliente como entero[cite: 12]
} // Cierra obtención de id_cliente

do { // Bucle para generar un folio único de 8 dígitos
    $folio = random_int(10000000, 99999999); // Genera número aleatorio de 8 cifras
    $stmtFolio = $pdo->prepare("SELECT folio FROM pedidos WHERE folio = ? LIMIT 1"); // Prepara consulta para revisar folio[cite: 9]
    $stmtFolio->execute([$folio]); // Ejecuta consulta del folio[cite: 9]
} while ($stmtFolio->rowCount() > 0); // Repite si el folio ya existe en pedidos[cite: 9]

$modo = "En el restaurante"; // Modo fijo del pedido
$idEstado = 1; // Estado inicial indicado (2)
$aclaracionesDb = ($aclaraciones === '') ? null : $aclaraciones; // Guarda NULL si no hubo aclaraciones

try { // Inicia bloque de transacción segura
    $pdo->beginTransaction(); // Comienza transacción PDO

    $sqlPedido = "INSERT INTO pedidos (folio, modo, mesa, fecha, hora, total, id_cliente, id_estado, aclaraciones, tiempoAprox)
                  VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)"; // Query de inserción en pedidos
    $stmtPedido = $pdo->prepare($sqlPedido); // Prepara inserción de pedido
    $stmtPedido->execute([ // Ejecuta inserción en pedidos
        $folio, // Folio único generado
        $modo, // Modo del pedido
        $mesa, // Número de mesa
        $fecha, // Fecha del pedido
        $hora, // Hora del pedido
        intval(round($totalCalculado)), // Total entero redondeado
        $idCliente, // ID del cliente
        $idEstado, // Estado del pedido
        $aclaracionesDb, // Aclaraciones o NULL
        $tiempoAprox // Tiempo aproximado en minutos
    ]); // Cierra execute de pedido

    $stmtPlat = $pdo->prepare("INSERT INTO pedido_platillo (id_pedido, id_platillo, cantidad) VALUES (?, ?, ?)"); // Prepara inserción en pedido_platillo
    $stmtPost = $pdo->prepare("INSERT INTO pedido_postre (id_pedido, id_postre, cantidad) VALUES (?, ?, ?)"); // Prepara inserción en pedido_postre
    $stmtBeb  = $pdo->prepare("INSERT INTO pedido_bebidascal (id_pedido, id_bebidaCal, cantidad) VALUES (?, ?, ?)"); // Prepara inserción en pedido_bebidascal

    foreach ($carrito as $item) { // Recorre productos para guardar detalle
        $origen = $item['origen'] ?? ''; // Obtiene tabla/origen del producto
        $idProd = intval($item['id'] ?? 0); // Obtiene ID del producto
        $cant   = intval($item['cantidad'] ?? 0); // Obtiene cantidad pedida
        if ($idProd <= 0 || $cant <= 0) continue; // Omite registros sin ID o cantidad válida

        if ($origen === 'platillo') { // Si es platillo
            $stmtPlat->execute([$folio, $idProd, $cant]); // Inserta en pedido_platillo
        } elseif ($origen === 'postre') { // Si es postre
            $stmtPost->execute([$folio, $idProd, $cant]); // Inserta en pedido_postre
        } elseif ($origen === 'bebidaCal') { // Si es bebida caliente
            $stmtBeb->execute([$folio, $idProd, $cant]); // Inserta en pedido_bebidascal
        } // Cierra selección de tabla detalle
    } // Cierra bucle de detalle

    $pdo->commit(); // Confirma todos los cambios en la BD
    ?> <!-- Cierra bloque PHP para mostrar vista de confirmación -->
    <!DOCTYPE html> <!-- Declara HTML5 -->
    <html lang="es"> <!-- Idioma español -->
    <head> <!-- Inicia cabecera -->
        <meta charset="UTF-8"> <!-- Codificación UTF-8 -->
        <title>Rocker Burger</title> <!-- Título de página -->
        <link rel="website icon" href="imagenes/icono.ico">
        <script src="https://cdn.tailwindcss.com"></script> <!-- Carga Tailwind CSS -->
    </head> <!-- Cierra cabecera -->
    <body class="min-h-screen bg-[#09090b] text-white flex items-center justify-center p-6 font-sans"> <!-- Estilo de pantalla centrada -->
        <div class="bg-[#111114] border border-amber-400 rounded-2xl p-6 max-w-md w-full text-center space-y-4"> <!-- Tarjeta de confirmación -->
            <h2 class="text-2xl font-bold text-amber-400">¡Pedido registrado!</h2> <!-- Título de éxito -->
            <p class="text-sm text-amber-100">Folio de pedido: <strong class="text-amber-400"><?php echo $folio; ?></strong></p> <!-- Muestra folio generado -->
            <p class="text-sm text-amber-100">Tiempo aproximado: <strong><?php echo $tiempoAprox; ?> min</strong></p> <!-- Muestra tiempo estimado -->
            <!-- Limpia localStorage y redirige -->
            <button onclick="localStorage.removeItem('rocker_burger_carrito'); window.location='principal.php';" 
                class="w-full bg-gradient-to-r from-amber-400 to-orange-500 text-neutral-950 font-bold py-2 rounded-full"> <!-- Estilo del botón -->
                Volver a Principal <!-- Texto del botón -->
            </button> <!-- Cierra botón -->
        </div> <!-- Cierra tarjeta -->
    </body> <!-- Cierra cuerpo -->
    </html> <!-- Cierra HTML -->
    <?php // Reabre PHP para el catch
} catch (Exception $e) { // Captura cualquier error durante la transacción
    if ($pdo->inTransaction()) { // Revisa si hay transacción abierta
        $pdo->rollBack(); // Revierte cambios para evitar datos incompletos
    } // Cierra verificación de transacción
    echo "<script>alert('Error al guardar el pedido.'); window.location='carrito.php';</script>"; // Notifica error y regresa
} // Cierra bloque catch
?> <!-- Cierra archivo PHP -->