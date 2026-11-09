<?php
session_start();
if(isset($_SESSION['usu'])){
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/contactostyle.css">
    <title>Rocker Burger</title>
    <link rel="website icon" href="imagenes/logo.jpg">
</head>
<body>
    <header>
        <div id="logo"><img src="imagenes/logo bienvenido.jpg" alt="imagen"  height="80px"></div>
        <div id="titulo"><h1>Bienvenido a Rocker Burguer</h1></div>
        <div id="cuenta">
            <img src="imagenes/logo.jpg" alt="imagen"><br>
            <a href="cuenta.php">Cuenta</a>
        </div>
    </header>
    <nav><b>
        <a href="principal.php">Principal</a>
        <a href="platillos.php">Platillos</a>
        <a href="nosotros.php">Nosotros</a>
        <a href="contacto.php" style="color: lightblue">Contacto</a>
    </b></nav>
    <br>
    <main>
        <section>
            <article id="informacion">
                <p>
                    SUCURSALES: <br> <br>
                    <a href="https://maps.app.goo.gl/owxWhhgwgUi9T2WWA?g_st=aw">Rocker Burguer</a> <br><br>
               </p>
            </article>
        </section>
        <aside>
            <article id="contacto">
                <p>Telefono: 5520648975<br>Correo:VibeShop2024@gmail.com</p>
            </article><br>
            <h2>Redes sociales:</h2>
            <article id="redes">
                <div id="wi"><div><img src="imagenes/whatss.jpg" alt="imagen"><p id="wi2">WhatsApp: 5526184703</p></div><div><img src="imagenes/instagram.jpg" alt="imagen"><a href="https://www.instagram.com/rocker_burgers?cplk=ZjJ5c3V0OGRxdWJi">Instagram:</a></div></div>
                <div id="ft"><div><img src="imagenes/facebook.jpg" alt="imagen"><a href="https://www.facebook.com/share/19bCe5hpbB/">Facebook: </a></div><div><img src="imagenes/twitter.jpg" alt="imagen"><a href="">Twitter:</a></div></div>
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