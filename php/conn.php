<?php
class conn{
    public function coneccion(){
        $h="sql310.infinityfree.com";
        $u="if0_43511530";
        $p="vkkk8qwZbmgzw3";
        $db="if0_43511530_rocker_burguer";
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