<?php
session_start();
if(isset($_SESSION['usu'])){
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/nosotrosstyle.css">
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
        <a href="platillos.php">Platillos</a>
        <a href="nosotros.php" style="color: lightblue">Nosotros</a>
        <a href="contacto.php">Contacto</a>
    </b></nav>
    <br>
    <main>
        <section>
            <article>
                <img src="imagenes/logo.jpg" alt="imagen" width="180px" id="img">
            </article>
            <article id="informacion">
                <p>
                ¿Por qué se llama Rocker Burguer? <br>
Si bien sabemos que vibe son vibras, la fundadora de la empresa queria transmitir sus emociones a las demás personas con su ropa y diseños, es asi como surge Vibe Shop.<br>
Fundadora: Michelle Hernández Salazar <br>
¿Año en que surgió? 28 de agosto del 2024 <br>
¿Historia de como comenzó?
Todo inicio cuando Michelle empezo a dibujar de pequeña disñeos de vestidos para su amuñecas, desde niña ya sabia que era a lo que se queria dedicar, conforme paso el tiempo su meta fue totalmente clara, por ello estudio Diseño de moda y fue cuando empezo a crear sus diseños para después hacerse de su propia empresa.
               </p>
            </article>
        </section>
        <aside>
            <article id="objetivo">
                <p>Objetivo: El principal objetivo de Vibe Shop es ofrecer una experiencia de compra de ropa en línea, asegurándonos de que cada cliente se sienta satisfecho. Buscamos optimizar cada paso del recorrido del cliente, desde el momento en que entra en nuestra tienda en línea hasta que recibe su pedido en casa, con el fin de eliminar cualquier fricción o dificultad que pueda experimentar.</p>
            </article>
            <article id="misivisi">
                <div id="mision">Misión: nuestra misión se centra en brindar a nuestros clientes la oportunidad de acceder a una amplia gama de productos de alta calidad para todas las edades garantizando que cada prenda sea duradera, cómoda y atractiva, todo mientras mantenemos precios accesibles que permitan que la moda esté al alcance de todos.</div>
                <div id="vision">Visión: Nuestra visión es convertirnos en la tienda de ropa en línea más influyente y confiable en México y, eventualmente, expandirnos a otros mercados a nivel internacional. Imaginamos un futuro en el que Vibe Shop no solo sea una tienda de ropa, sino una plataforma completa que revolucione el comercio electrónico de moda.</div>
            </article>
        </aside>
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
