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
        <div class="max-w-6xl mx-auto flex items-center justify-center">
            <h1 class="text-xl sm:text-3xl font-bold tracking-wide text-amber-400 text-center">
                Bienvenido a Rocker Burguer
            </h1>
        </div>
    </header>

    <!-- Contenido principal -->
    <main class="flex-1 max-w-6xl w-full mx-auto px-4 sm:px-6 py-8">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-6 items-start">

            <!-- Columna Izquierda: Perfil y Opciones -->
            <section class="lg:col-span-4 bg-[#0e0f14] border border-amber-400/70 glow-card rounded-xl p-6 flex flex-col items-center text-center">
                <div class="mb-4">
                    <img src="imagenes/logo.jpg" alt="imagen" id="logo"
                        class="w-32 h-32 sm:w-36 sm:h-36 rounded-full object-cover border-2 border-amber-400 glow-card">
                </div>

                <?php foreach($_SESSION['usu'] as $usu){ ?>
                <div class="font-sans space-y-1.5 mb-5 w-full">
                    <p class="text-sm sm:text-base font-bold text-amber-200">
                        Nombre: <span class="font-normal text-white"><?php echo $usu['nom']?> <?php echo $usu['ap']?> <?php echo $usu['am']?></span>
                    </p>
                    <p class="text-sm sm:text-base font-bold text-amber-200 break-all">
                        Correo: <span class="font-normal text-amber-100/90"><?php echo $usu['correo']?></span>
                    </p>
                </div>

                <div class="w-full border-t border-amber-500/30 py-3 font-sans">
                    <a href="buscaCuenta.php?correo=<?php echo $usu['correo']?>"
                        class="block w-full py-2.5 px-4 rounded-full bg-gradient-to-r from-amber-400 to-orange-500 hover:from-amber-300 hover:to-orange-400 text-neutral-950 font-bold text-sm transition shadow">
                        Sesión y cuenta
                    </a>
                </div>

                <div class="w-full border-t border-amber-500/30 py-3 font-sans">
                    <a href="principal.php"
                        class="block w-full py-2.5 px-4 rounded-full bg-neutral-900 hover:bg-neutral-800 text-amber-300 border border-amber-500/50 font-semibold text-sm transition">
                        Regresar
                    </a>
                </div>

                <div class="w-full border-t border-amber-500/30 pt-3 font-sans">
                    <a href="destruir.php?correo=<?php echo $usu['correo']?>"
                        class="block w-full py-2.5 px-4 rounded-full bg-red-950/60 hover:bg-red-900/70 text-red-300 border border-red-500/50 font-semibold text-sm transition">
                        Cerrar Sesión
                    </a>
                </div>
                <?php } ?>
            </section>

            <!-- Columna Derecha: Información de Cuenta, Domicilio o Actualización -->
            <aside class="lg:col-span-8 flex flex-col gap-6">
                <?php
                if(isset($_SESSION['info'])){
                    foreach($_SESSION['info'] as $in){
                ?>
                <div id="info" class="flex flex-col gap-6">

                    <!-- Datos del usuario -->
                    <div class="bg-[#0e0f14] border border-amber-400/70 glow-card rounded-xl p-6 sm:p-8">
                        <h1 class="text-2xl sm:text-3xl font-bold text-amber-400 text-center mb-6 border-b border-amber-500/30 pb-3">
                            Datos del usuario
                        </h1>

                        <div class="max-w-md mx-auto space-y-3 font-sans text-sm sm:text-base">
                            <div class="flex justify-between items-center border-b border-amber-500/15 pb-2">
                                <span class="font-bold text-amber-300">Nombre:</span>
                                <span class="text-white"><?php echo $in['nom']?></span>
                            </div>
                            <div class="flex justify-between items-center border-b border-amber-500/15 pb-2">
                                <span class="font-bold text-amber-300">Apellido paterno:</span>
                                <span class="text-white"><?php echo $in['ap']?></span>
                            </div>
                            <div class="flex justify-between items-center border-b border-amber-500/15 pb-2">
                                <span class="font-bold text-amber-300">Apellido materno:</span>
                                <span class="text-white"><?php echo $in['am']?></span>
                            </div>
                            <div class="flex justify-between items-center border-b border-amber-500/15 pb-2 gap-2">
                                <span class="font-bold text-amber-300">Correo:</span>
                                <span class="text-white break-all text-right"><?php echo $in['correo']?></span>
                            </div>
                            <div class="flex justify-between items-center border-b border-amber-500/15 pb-2">
                                <span class="font-bold text-amber-300">Password:</span>
                                <span class="text-white"><?php echo $in['pass']?></span>
                            </div>
                            <div class="flex justify-between items-center pb-2">
                                <span class="font-bold text-amber-300">Telefono:</span>
                                <span class="text-white"><?php echo $in['tel']?></span>
                            </div>
                        </div>

                        <div class="mt-6 text-center font-sans space-y-3">
                            <div>
                                <a href="buscaCueDomi.php?correo=<?php echo $in['correo']?>"
                                    class="inline-block bg-gradient-to-r from-amber-400 to-orange-500 hover:from-amber-300 hover:to-orange-400 text-neutral-950 font-bold text-sm sm:text-base px-6 py-2.5 rounded-full shadow transition">
                                    Mostrar datos de Cuenta y Domicilio
                                </a>
                            </div>
                            <div>
                                <a href="buscaPedidos.php?correo=<?php echo $in['correo']?>"
                                    class="inline-block bg-gradient-to-r from-amber-400 to-orange-500 hover:from-amber-300 hover:to-orange-400 text-neutral-950 font-bold text-sm sm:text-base px-6 py-2.5 rounded-full shadow transition">
                                    Mostrar Pedidos
                                </a>
                            </div>
                        </div>
                    </div>

                    <!-- Datos de Cuenta y Domicilio (si existen) -->
                    <?php
                    if(isset($_SESSION['cuentadomi'])){
                        foreach($_SESSION['cuentadomi'] as $x){
                    ?>
                    <div class="bg-[#0e0f14] border border-amber-400/70 glow-card rounded-xl p-6 sm:p-8 space-y-6">
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 font-sans text-sm sm:text-base">
                            <div class="bg-black/70 border border-amber-500/35 rounded-lg p-4">
                                <h2 class="font-serif text-lg font-bold text-amber-400 mb-1">Datos de cuenta:</h2>
                                <p class="text-amber-100">
                                    No. de Cuenta: <span class="font-semibold text-white"><?php echo $x['no_cuenta']?></span><br>
                                    Banco: <span class="font-semibold text-white"><?php echo $x['banco']?></span>
                                </p>
                            </div>
                            <div class="bg-black/70 border border-amber-500/35 rounded-lg p-4">
                                <h2 class="font-serif text-lg font-bold text-amber-400 mb-1">Domicilio:</h2>
                                <p class="text-amber-100">
                                    Estado: de México, Colonia <span class="font-semibold text-white"><?php echo $x['col']?></span>, Municipio <span class="font-semibold text-white"><?php echo $x['mun']?></span><br>
                                    Calle <span class="font-semibold text-white"><?php echo $x['calle']?></span>, No. Interior <span class="font-semibold text-white"><?php echo $x['no_int']?></span>
                                </p>
                            </div>
                        </div>

                        <!-- Formulario actualizar cuenta y domicilio -->
                        <form action="actualizarcudomi.php?no_cuenta=<?php echo $x['no_cuenta']?>" method="post" class="font-sans space-y-4 border-t border-amber-500/30 pt-5">
                            <div class="text-center">
                                <h3 class="font-serif text-xl font-bold text-amber-400">
                                    Actualizar Información de la Cuenta o Domicilio:
                                </h3>
                                <p class="text-xs sm:text-sm text-amber-200/80 mt-1">
                                    Llenar el formulario para actualizar la información, en caso de que algun dato no se desee cambiar, favor de dejarlo en blanco
                                </p>
                            </div>

                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                <div>
                                    <label for="cuenta" class="block text-sm font-semibold text-amber-300 mb-1">No. Cuenta:</label>
                                    <input type="number" name="cuenta" id="cuenta" placeholder="Ingrese nuevo numero de cuenta"
                                        class="w-full bg-black border border-amber-500/40 focus:border-amber-400 rounded-lg px-3 py-2 text-sm text-white placeholder-neutral-500 focus:outline-none">
                                </div>
                                <div>
                                    <label for="col" class="block text-sm font-semibold text-amber-300 mb-1">Colonia:</label>
                                    <input type="text" name="col" id="col" placeholder="Ingrese su nueva colonia"
                                        class="w-full bg-black border border-amber-500/40 focus:border-amber-400 rounded-lg px-3 py-2 text-sm text-white placeholder-neutral-500 focus:outline-none">
                                </div>
                                <div>
                                    <label for="mun" class="block text-sm font-semibold text-amber-300 mb-1">Municipio:</label>
                                    <input type="text" name="mun" id="mun" placeholder="Ingrese su nuevo municipio"
                                        class="w-full bg-black border border-amber-500/40 focus:border-amber-400 rounded-lg px-3 py-2 text-sm text-white placeholder-neutral-500 focus:outline-none">
                                </div>
                                <div>
                                    <label for="calle" class="block text-sm font-semibold text-amber-300 mb-1">Calle:</label>
                                    <input type="text" name="calle" id="calle" placeholder="Ingrese su nueva calle"
                                        class="w-full bg-black border border-amber-500/40 focus:border-amber-400 rounded-lg px-3 py-2 text-sm text-white placeholder-neutral-500 focus:outline-none">
                                </div>
                                <div>
                                    <label for="noint" class="block text-sm font-semibold text-amber-300 mb-1">No. Interior:</label>
                                    <input type="number" name="noint" id="noint" placeholder="Ingrese su nuevo no. interior"
                                        class="w-full bg-black border border-amber-500/40 focus:border-amber-400 rounded-lg px-3 py-2 text-sm text-white placeholder-neutral-500 focus:outline-none">
                                </div>
                                <div>
                                    <label for="banco" class="block text-sm font-semibold text-amber-300 mb-1">Banco:</label>
                                    <input type="text" name="banco" id="banco" placeholder="Ingrese el nombre de su banco"
                                        class="w-full bg-black border border-amber-500/40 focus:border-amber-400 rounded-lg px-3 py-2 text-sm text-white placeholder-neutral-500 focus:outline-none">
                                </div>
                            </div>

                            <div class="text-center pt-2">
                                <input type="submit" value="Actualizar"
                                    class="bg-gradient-to-r from-amber-400 to-orange-500 hover:from-amber-300 hover:to-orange-400 text-neutral-950 font-bold text-sm px-8 py-2.5 rounded-full shadow cursor-pointer transition">
                            </div>
                        </form>
                    </div>
                    <?php
                        }
                    }else{
                        if(isset($_SESSION['noCuDomi'])){
                    ?>
                    <div class="bg-[#0e0f14] border border-amber-500/40 rounded-xl p-4 text-center font-sans">
                        <h3 class="text-base sm:text-lg font-semibold text-amber-300">
                            No se encontraron tus datos/no han sido ingresados.
                        </h3>
                    </div>
                    <?php
                        }
                    }
                    ?>

                    <!-- Formulario Actualizar Información del Usuario -->
                    <form action="actualizarusu.php?correo=<?php echo $in['correo']?>" method="post" onsubmit="return validar()"
                        class="bg-[#0e0f14] border border-amber-400/70 glow-card rounded-xl p-6 sm:p-8 font-sans space-y-4">
                        <div class="text-center">
                            <h3 class="font-serif text-xl sm:text-2xl font-bold text-amber-400">
                                Actualizar Información del Usuario
                            </h3>
                            <p class="text-xs sm:text-sm text-amber-200/80 mt-1">
                                Si se desea actualizar la información deberá llenar el formulario, en caso de que algún dato no se desee cambiar, favor de dejar en blanco.
                            </p>
                        </div>

                        <div class="max-w-md mx-auto space-y-4">
                            <div>
                                <label for="tel" class="block text-sm font-semibold text-amber-300 mb-1">Telefono:</label>
                                <input type="number" name="tel" id="tel" placeholder="Ingresar nuevo número telefónico" maxlength="10" oninput="this.value = this.value.replace(/[^0-9]/g, '').slice(0, 10);"
                                    class="w-full bg-black border border-amber-500/40 focus:border-amber-400 rounded-lg px-3 py-2 text-sm text-white placeholder-neutral-500 focus:outline-none">
                            </div>
                            <div>
                                <label for="pass" class="block text-sm font-semibold text-amber-300 mb-1">Password:</label>
                                <input type="password" name="pass" id="pass" placeholder="Ingrese nueva contraseña"
                                    class="w-full bg-black border border-amber-500/40 focus:border-amber-400 rounded-lg px-3 py-2 text-sm text-white placeholder-neutral-500 focus:outline-none">
                            </div>
                            <div>
                                <label for="pass" class="block text-sm font-semibold text-amber-300 mb-1">Confirma Password:</label>
                                <input type="password" name="pass1" id="pass1" placeholder="Confirma nueva contraseña"
                                    class="w-full bg-black border border-amber-500/40 focus:border-amber-400 rounded-lg px-3 py-2 text-sm text-white placeholder-neutral-500 focus:outline-none">
                            </div>
                        </div>

                        <div class="text-center pt-2">
                            <input type="submit" value="Actualizar"
                                class="bg-gradient-to-r from-amber-400 to-orange-500 hover:from-amber-300 hover:to-orange-400 text-neutral-950 font-bold text-sm px-8 py-2.5 rounded-full shadow cursor-pointer transition">
                        </div>
                    </form>

                </div>
                <?php
                    }
                }
                ?>
            </aside>

        </div>
    </main>

    <!-- Pie de página -->
    <footer class="bg-black border-t border-amber-500/40 px-4 py-4 text-center">
        <h5 class="text-sm sm:text-base text-amber-200/90 font-medium">
            Gracias por visitar nuestra página, esperamos que nos visites pronto
        </h5>
    </footer>
    <!-- Script ´para validar la nueva contraseña y el nuevo teléfono -->
    <script>
        function validar() {
            var telefono = document.getElementById("tel").value;
            var pass = document.getElementById('pass').value;
            var confirmar = document.getElementById('pass1').value;
            var regex = /\d/;
            if(telefono != ""){
                if (telefono.length !== 10) {
                    alert("El número de teléfono debe tener 10 dígitos.");
                    return false;
                }
            }
            if(pass != ""){
                if (!validarpass(pass)) {
                    alert("La contraseña debe tener mayusculas, minusculas, al menos un numero, alguno de los siguientes caracteres especiales: -_/*#$ y de 6 a 12 caracteres.");
                    return false;
                }
            }
            if(pass != "" && confirmar == ""){
                alert("Debe confirmar su contraseña para la actualización.");
                return false;
            }
            if(confirmar != "" && pass == ""){
                alert("Para actualizar la contraseña debe primero escribir la contraseña en el campo anterior.");
                return false;
            }
            if(pass != "" && confirmar != ""){
                if (!validarpass(pass)) {
                    alert("La contraseña debe tener mayusculas, minusculas, al menos un numero, alguno de los siguientes caracteres especiales: -_/*#$ y de 6 a 12 caracteres.");
                    return false;
                }
                if (confirmar!=pass) {
                    alert("Error al confirmar contraseña.");
                    return false;
                }
            }
            return true;
        }
        function validarpass(pass) {
            const va = /^(?=.*[a-z])(?=.*[A-Z])(?=.*[-_/*#$])(?=.*[0-9])[a-zA-Z-_/*#$0-9]{6,12}$/;
            return va.test(pass);
        }
    </script>
</body>
</html>
<?php
}else{
    header("Location: index.php");
}
?>