<?php
session_start();
$_SESSION['existente']="";
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rocker Burger</title>
    <link rel="website icon" href="imagenes/icono.ico">
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="min-h-screen flex items-center justify-center bg-cover bg-center bg-no-repeat p-4 font-serif"
      style="background-image: url('imagenes/fondoLogin.jfif');">

    <!-- Contenedor negro del formulario -->
    <div class="w-full max-w-lg bg-black text-white rounded-sm shadow-2xl border border-amber-500/40 px-6 py-8 sm:px-10 sm:py-9">
        
        <h1 class="text-xl sm:text-2xl font-bold text-center tracking-wide mb-6">
            Formulario de Registro
        </h1>

        <form action="Registrophp.php" method="post" onsubmit="return validar()" class="space-y-3.5 font-sans">
            
            <!-- Nombre -->
            <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-1 sm:gap-4">
                <label for="nom" class="font-bold text-sm sm:text-base whitespace-nowrap font-serif">
                    Nombre:
                </label>
                <input type="text" name="nombre" id="nom" placeholder="Ingrese su nombre/s" required
                    class="w-full sm:w-64 bg-white text-gray-800 placeholder-gray-400 text-sm px-3.5 py-1.5 rounded-full border border-gray-400 focus:outline-none focus:ring-2 focus:ring-amber-400">
            </div>

            <!-- Apellido Paterno -->
            <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-1 sm:gap-4">
                <label for="ap" class="font-bold text-sm sm:text-base whitespace-nowrap font-serif">
                    Apellido Paterno:
                </label>
                <input type="text" name="ap" id="ap" placeholder="Ingrese su apellido paterno" required
                    class="w-full sm:w-64 bg-white text-gray-800 placeholder-gray-400 text-sm px-3.5 py-1.5 rounded-full border border-gray-400 focus:outline-none focus:ring-2 focus:ring-amber-400">
            </div>

            <!-- Apellido Materno -->
            <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-1 sm:gap-4">
                <label for="am" class="font-bold text-sm sm:text-base whitespace-nowrap font-serif">
                    Apellido Materno:
                </label>
                <input type="text" name="am" id="am" placeholder="Ingrese su apellido materno" required
                    class="w-full sm:w-64 bg-white text-gray-800 placeholder-gray-400 text-sm px-3.5 py-1.5 rounded-full border border-gray-400 focus:outline-none focus:ring-2 focus:ring-amber-400">
            </div>

            <!-- Teléfono -->
            <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-1 sm:gap-4">
                <label for="tel" class="font-bold text-sm sm:text-base whitespace-nowrap font-serif">
                    Telefono:
                </label>
                <input type="tel" name="tel" id="tel" placeholder="Ingrese su numero telefónico" maxlength="10"
                    oninput="this.value = this.value.replace(/[^0-9]/g, '').slice(0, 10);" required
                    class="w-full sm:w-64 bg-white text-gray-800 placeholder-gray-400 text-sm px-3.5 py-1.5 rounded-full border border-gray-400 focus:outline-none focus:ring-2 focus:ring-amber-400">
            </div>

            <!-- Correo -->
            <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-1 sm:gap-4">
                <label for="correo" class="font-bold text-sm sm:text-base whitespace-nowrap font-serif">
                    Correo:
                </label>
                <input type="email" name="correo" id="correo" placeholder="Ingrese su correo" required
                    class="w-full sm:w-64 bg-white text-gray-800 placeholder-gray-400 text-sm px-3.5 py-1.5 rounded-full border border-gray-400 focus:outline-none focus:ring-2 focus:ring-amber-400">
            </div>

            <!-- Contraseña -->
            <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-1 sm:gap-4">
                <label for="pass" class="font-bold text-sm sm:text-base whitespace-nowrap font-serif">
                    Contraseña:
                </label>
                <input type="password" name="pass" id="pass" placeholder="Ingrese una contraseña para su correo" required
                    class="w-full sm:w-64 bg-white text-gray-800 placeholder-gray-400 text-sm px-3.5 py-1.5 rounded-full border border-gray-400 focus:outline-none focus:ring-2 focus:ring-amber-400">
            </div>

            <!-- Confirmar Contraseña -->
            <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-1 sm:gap-4">
                <label for="pass" class="font-bold text-sm sm:text-base whitespace-nowrap font-serif">
                    Contraseña:
                </label>
                <input type="password" name="pass1" id="pass1" placeholder="Confirmar contraseña para su correo" required
                    class="w-full sm:w-64 bg-white text-gray-800 placeholder-gray-400 text-sm px-3.5 py-1.5 rounded-full border border-gray-400 focus:outline-none focus:ring-2 focus:ring-amber-400">
            </div>

            <!-- Mensaje de usuario existente -->
            <?php if(isset($_SESSION['existente'])){ ?>
                <p class="text-red-500 text-sm text-center font-medium pt-1">
                    Usuario existente
                </p>
            <?php } ?>

            <!-- Botones -->
            <div class="pt-4 flex flex-col items-center gap-2.5">
                <button type="submit" name="regis"
                    class="w-36 bg-white hover:bg-amber-400 text-gray-900 font-semibold text-sm py-1.5 px-5 rounded-full border border-gray-400 transition duration-200 cursor-pointer shadow">
                    Registrarse
                </button>

                <a href="index.php"
                    class="w-36 text-center bg-white hover:bg-amber-400 text-gray-900 font-semibold text-sm py-1.5 px-5 rounded-full border border-gray-400 transition duration-200 shadow">
                    Regresar
                </a>
            </div>
        </form>
    </div>

    <script>
        function validar() {
            var nombre = document.getElementById("nom").value;
            var ap = document.getElementById("ap").value;
            var am = document.getElementById("am").value;
            var telefono = document.getElementById("tel").value;
            var correo = document.getElementById('correo').value;
            var pass = document.getElementById('pass').value;
            var confirmar = document.getElementById('pass1').value;

            var regex = /\d/;

            if (confirmar!=pass) {
                alert("Error al confirmar contraseña.");
                return false;
            }
            if (regex.test(nombre)) {
                alert("El nombre no debe contener números.");
                return false;
            }
            if (regex.test(ap)) {
                alert("El apellido paterno no debe contener números.");
                return false;
            }
            if (regex.test(am)) {
                alert("El apellido materno no debe contener números.");
                return false;
            }
            if (telefono.length !== 10) {
                alert("El número de teléfono debe tener 10 dígitos.");
                return false;
            }
            if (!validaremail(correo)) {
                alert("El correo debe tener mayusculas y minusculas/verificar el correo.");
                return false;
            }
            if (!validarpass(pass)) {
                alert("La contraseña debe tener mayusculas, minusculas, al menos un numero, alguno de los siguientes caracteres especiales: -_/*#$ y de 6 a 12 caracteres.");
                return false;
            }
            return true;
        }
        function validaremail(correo) {
            const va = /^[a-zA-Z]+@[A-Za-z]+\.([a-zA-Z]{2,4})+\.([a-zA-Z]{2,4})$/.test(correo);
            const va2 = /^[a-zA-Z]+@[A-Za-z]+\.([a-zA-Z]{2,4})$/.test(correo);
            return va || va2;
        }
        function validarpass(pass) {
            const va = /^(?=.*[a-z])(?=.*[A-Z])(?=.*[-_/*#$])(?=.*[0-9])[a-zA-Z-_/*#$0-9]{6,12}$/;
            return va.test(pass);
        }
    </script>
</body>
</html>