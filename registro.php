<?php
session_start();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rocker Burger</title>
    <link rel="website icon" href="imagenes/logo.jpg">
    <link rel="stylesheet" href="css/regis.css">
</head>
<body>
    <center>
    <div class="regist">
        <form action="Registrophp.php" method="post" onsubmit="return validar()">
            <table>
                <tr>
                    <td colspan="2" class="butoncentro"><h1>Formulario de Registro</h1></td>
                </tr>
                <tr>
                    <td><label for="">Nombre: </label></td>
                    <td><input type="text" name="nombre" id="nom" placeholder="Ingrese su nombre/s" required></td>
                </tr>
                <tr>
                    <td><label for="">Apellido Paterno: </label></td>
                    <td><input type="text" name="ap" id="ap" placeholder="Ingrese su apellido paterno" required></td>
                </tr>
                <tr>
                    <td><label for="">Apellido Materno: </label></td>
                    <td><input type="text" name="am" id="am" placeholder="Ingrese su apellido materno" required></td>
                </tr>
                <tr>
                    <td><label for="">Telefono: </label></td>
                    <td><input type="number" name="tel" id="tel" placeholder="Ingrese su numero telefónico" maxlength="10" oninput="this.value = this.value.replace(/[^0-9]/g, '').slice(0, 10);" required></td>
                </tr>
                <tr>
                    <td><label for="">Correo: </label></td>
                    <td><input type="email" name="correo" id="correo" placeholder="Ingrese su correo" required></td>
                </tr>
                <tr>
                    <td><label for="">Contraseña: </label></td>
                    <td><input type="password" name="pass" id="pass" placeholder="Ingrese una contraseña para su correo" required></td>
                </tr>
                <?php if(isset($_SESSION['existente'])){ ?>
                    <tr class="mensaje">
                        <td colspan="2"><p>Usuario existente</p></td>
                    </tr>
                <?php } ?>
                <tr>
                    <td colspan="2" class="butoncentro"><br><button  name="regis">Registrarse</button></td>
                </tr>
                <tr>
                    <td colspan="2" class="butoncentro"><button><a href="index.php">Regresar</a></button></td>
                </tr>
            </table>
        </form>
        <br>
    </div>
    </center>
    <script>
        function validar() {
            // Obtener los valores de los campos
            var nombre = document.getElementById("nom").value;
            var ap = document.getElementById("ap").value;
            var am = document.getElementById("am").value;
            var telefono = document.getElementById("tel").value;
            var correo=document.getElementById('correo').value;
            var pass=document.getElementById('pass').value;


            // Expresión regular para verificar que no haya números
            var regex = /\d/;


            // Validación del campo "Nombre"
            if (regex.test(nombre)) {
                alert("El nombre no debe contener números.");
                return false; // Evita que se envíe el formulario
            }


            // Validación del campo "Apellido Paterno"
            if (regex.test(ap)) {
                alert("El apellido paterno no debe contener números.");
                return false; // Evita que se envíe el formulario
            }


            // Validación del campo "Apellido Materno"
            if (regex.test(am)) {
                alert("El apellido materno no debe contener números.");
                return false; // Evita que se envíe el formulario
            }


            // Validación del campo "Teléfono" (debe tener 10 dígitos)
            if (telefono.length !== 10) {
                alert("El número de teléfono debe tener 10 dígitos.");
                return false; // Evita que se envíe el formulario
            }
            if(!validaremail(correo)){
                alert("El correo debe tener mayusculas y minusculas/verificar el correo.");
                return false;
            }
            if(!validarpass(pass)){
                alert("La contraseña debe tener mayusculas, minusculas, al menos un numero, alguno de los siguientes caracteres especiales: -_/*#$ y de 6 a 12 caracteres.");
                return false;
            }
            // Si todo es correcto, se envía el formulario
            return true;
        }
        function validaremail(correo){
            const va=/^[a-zA-Z]+@[A-Za-z]+\.([a-zA-Z]{2,4})+\.([a-zA-Z]{2,4})$/.test(correo);
            const va2=/^[a-zA-Z]+@[A-Za-z]+\.([a-zA-Z]{2,4})$/.test(correo);
            return va || va2;
        }
        function validarpass(pass){
            const va=/^(?=.*[a-z])(?=.*[A-Z])(?=.*[-_/*#$])(?=.*[0-9])[a-zA-Z-_/*#$0-9]{6,12}$/;
            return va.test(pass);
        }
    </script>
</body>
</html>