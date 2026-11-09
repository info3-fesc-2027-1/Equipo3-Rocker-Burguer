<?php
class conn{
    public function coneccion(){
        $h="localhost";
        $u="root";
        $p="";
        $db="rocker_burguer";
        try{
            $conn= new PDO("mysql:host=".$h.";dbname=".$db,$u,$p);
            $conn->setAttribute(PDO::ERRMODE_EXCEPTION,PDO::ERRMODE_SILENT);
            return $conn;
        }catch(PDOException $e){
            echo "Connection failed".$e->getMessage();
            return 0;
        }
    }
}
?>