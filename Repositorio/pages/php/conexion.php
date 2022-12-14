<?php
    $server="localhost";
	$user="root";
	$password="";
	$bd="repositorio";
	$conn=new mysqli($server,$user,$password,$bd) or
		die ("Error al conectarse on la base de datos");
?>