<?php
include_once 'serversideConexion.php';
class Conexion{	  
    public static function Conectar() {              
        $opciones = array(
            PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8',
            PDO::MYSQL_ATTR_DIRECT_QUERY => false,
            PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION
        );			
        try{
            $conexion = new PDO("mysql:host=".HOST_SS.";dbname=".DATABASE_SS,USER_SS,PASSWORD_SS,$opciones);
            return $conexion;			           
        }catch (Exception $e){
            die("El error de Conexi��n es: ". $e->getMessage());
        }
    }
}
?>