<?php
session_start();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rocker Burger</title>
    <link rel="website icon" href="imagenes/icono.ico">
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="min-h-screen flex items-center justify-center bg-cover bg-center bg-no-repeat p-4 font-serif" 
      style="background-image: url('imagenes/fondoLogin.jfif');">

    <!-- Tarjeta Principal Negra -->
    <div class="w-full max-w-md bg-black text-white rounded-sm shadow-2xl border border-amber-500/40 px-6 py-8 sm:px-10 sm:py-10 flex flex-col items-center">
        
        <!-- Título -->
        <h1 class="text-xl sm:text-2xl font-bold tracking-wide mb-3 text-center">
            Bienvenido a
        </h1>

        <!-- Imagen del Logo Rocker Burger's -->
        <div class="w-56 sm:w-64 mb-6 flex justify-center">
            <img src="imagenes/logo.jpg" alt="Rocker Burger's" class="w-full h-auto object-contain">
        </div>
        <!-- Formulario -->
        <form action="validar.php" method="post" onsubmit="return validar()" class="w-full space-y-4 font-sans">
            <!-- Campo Correo -->
            <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-1 sm:gap-3">
                <label for="correo" class="font-bold text-sm sm:text-base whitespace-nowrap font-serif">
                    Correo:
                </label>
                <input type="email" id="correo" name="correo" placeholder="Ingrese su correo" required
                    class="w-full sm:w-60 bg-white text-gray-800 text-sm px-3 py-1 rounded-full border border-gray-400 focus:outline-none focus:ring-2 focus:ring-amber-400">
            </div>

            <!-- Campo Contraseña -->
            <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-1 sm:gap-3">
                <label for="pass" class="font-bold text-sm sm:text-base whitespace-nowrap font-serif">
                    Contraseña:
                </label>
                <input type="password" id="pass" name="pass" placeholder="Ingrese su contraseña" required
                    class="w-full sm:w-60 bg-white text-gray-800 text-sm px-3 py-1 rounded-full border border-gray-400 focus:outline-none focus:ring-2 focus:ring-amber-400">
            </div>

            <!-- Botón Iniciar Sesión -->
            <div class="pt-4 flex justify-center">
                <button type="submit" 
                    class="bg-white hover:bg-amber-400 text-gray-900 font-semibold text-sm px-6 py-1.5 rounded-full border border-gray-400 transition duration-200 cursor-pointer shadow">
                    Iniciar Sesión
                </button>
            </div>
        </form>

        <!-- Mensaje de Error de Sesión -->
        <?php if(isset($_SESSION['NoUsu'])){ ?>
            <p id="Error" class="text-red-500 text-sm font-sans mt-4 text-center font-medium">
                <?php echo $_SESSION['NoUsu']; ?>
            </p>
        <?php } ?>

        <!-- Enlace de Registro -->
        <p class="mt-6 text-sm sm:text-base text-center">
            Si aún no tiene una cuenta 
            <a href="registro.php" class="text-amber-400 hover:text-amber-300 underline font-medium transition">
                Registrate
            </a>
        </p>

    </div>

    <script>
        function validar(){
            let correo = document.getElementById('correo').value;
            let pass = document.getElementById('pass').value;
            if(correo == "" || pass == ""){
                alert("Llena todos los datos");
                return false;
            }
            if(!validaremail(correo)){
                alert("El correo debe tener mayusculas y minusculas/verificar el correo.");
                return false;
            }
            if(!validarpass(pass)){
                alert("La contraseña debe tener mayusculas, minusculas, al menos un numero, alguno de los siguientes caracteres especiales: -_/*#$ y de 6 a 12 caracteres.");
                return false;
            }
        }
        function validaremail(correo){
            const va = /^[a-zA-Z]+@[A-Za-z]+\.([a-zA-Z]{2,4})+\.([a-zA-Z]{2,4})$/.test(correo);
            const va2 = /^[a-zA-Z]+@[A-Za-z]+\.([a-zA-Z]{2,4})$/.test(correo);
            return va || va2;
        }
        function validarusuario(usuario){
            const va = /[a-z]/.test(usuario);
            const va2 = /[A-Z]/.test(usuario);
            const va3 = /[\d]/.test(usuario);
            const va4 = /[$@!%*?&]/.test(usuario);
            const va5 = usuario.length <= 9;
            return va && va2 && va3 && va4 && va5;
        }
        function validarpass(pass){
            const va = /^(?=.*[a-z])(?=.*[A-Z])(?=.*[-_/*#$])(?=.*[0-9])[a-zA-Z-_/*#$0-9]{6,12}$/;
            return va.test(pass);
        }
    </script>
</body>
</html>