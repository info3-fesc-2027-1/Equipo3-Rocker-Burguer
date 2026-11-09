<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $correo = $_POST['correo'];
    $pass = $_POST['pass'];
    $nombre = $_POST['nombre']; 
    $ap = $_POST['ap'];
    $am = $_POST['am'];
    $tel = $_POST['tel'];
    include_once("php2/consultaUsuarios.php");
    $c=new usuarios();
    $usu=$c->crearUsuario($correo,$pass,$nombre,$ap,$am,$tel);
    if($usu==1){
        $_SESSION['existente']="Usuario existente";
        header("Location: registro.php");
    }else{
        header("Location:index.php");
    }
}
?>