<?php
    session_start(); 
    include 'conexion.php';

    if (isset($_POST['carrera']) && isset($_POST['no_control'])) {
        function validacion($datos){
            $datos = trim($datos);
            $datos = stripslashes($datos);
            $datos = htmlspecialchars($datos);
            return $datos;
        }

        $carrera = validacion($_POST['carrera']);
        $password = validacion($_POST['no_control']);

        if (empty($carrera)) {
            header("Location: ../../index.html?error=ingrese la clave correspondiente");
            exit();
        } else if (empty($password)){
            header("Location: ../../index.html?error=la password es requerida");
            exit();
        } else {
            $sql = "select * from usuarios where no_control='$password' and clv_especialidad='$carrera'";
            $loginSQL=$conn->query($sql) or die ("Usuario no encontrado");
            if (mysqli_num_rows($loginSQL) === 1) {
                $row = mysqli_fetch_assoc($loginSQL);
                if ($row['no_control'] === $password && $row['clv_especialidad'] === $carrera) {
                    $_SESSION['no_control'] = $row['no_control'];
                    $_SESSION['nom_usuario'] = $row['nom_usuario'];
                    $_SESSION['clv_especialidad'] = $row['clv_especialidad'];
                    $_SESSION['usuario_rol'] = $row['usuario_rol'];
                    header("Location: ../administracion.php");
                    exit();
                }else{
                    header("Location: ../../index.html?error=usuario o password incorrecto");
                    exit();
                }
            }else{
                header("Location: ../../index.html?error=usuario o password incorrecto");
                exit();
            }
        }

    } else {
        header("Location: ../../index.html");
        exit();
    } 
    
?>