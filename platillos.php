<?php
session_start();
if(isset($_SESSION['usu'])){
include_once("php2/consultaProductos.php");
$c=new productos();
$todos=$c->buscarProductos();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/productosstyle.css">
    <title>Rocker Burger</title>
    <link rel="website icon" href="imagenes/logo.jpg">
</head>
<body>
    <header>
        <div id="logo"><img src="imagenes/logo bienvenido.jpg" alt="imagen"  height="80px"></div>
        <div id="titulo"><h1>Bienvenido a Rocker Burger</h1></div>
        <div id="cuenta">
            <img src="imagenes/logo.jpg" alt="imagen"><br>
            <a href="cuenta.php">Cuenta</a>
        </div>
    </header>
    <nav><b>
        <a href="principal.php">Principal</a>
        <a href="platillos.php" style="color: lightblue">Platillos</a>
        <a href="nosotros.php">Nosotros</a>
        <a href="contacto.php">Contacto</a>
    </b></nav>
    <br>
    <main>
    <div id=mater>
    </div>
    </main>
    <br>
    <footer>
        <h5>Gracias por visitar nuestra página, esperamos que nos visites pronto</h5>
    </footer>
</body>
</html>
<?php
}else{
    header("Location: index.php");
}
?>
