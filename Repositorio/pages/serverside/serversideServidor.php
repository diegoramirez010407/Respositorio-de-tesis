<?php
include_once 'conexionDatos.php';
$objeto = new Conexion();
$conexion = $objeto->Conectar();

// variable global
$opcion = (isset($_POST['opcion'])) ? $_POST['opcion'] : '';

// variables de configuración
$cuestionario_estado = (isset($_POST['cuestionario_estado'])) ? $_POST['cuestionario_estado'] : '';
$cuestionario = (isset($_POST['cuestionario'])) ? $_POST['cuestionario'] : '';
$referencia = (isset($_POST['referencia'])) ? $_POST['referencia'] : '';

//  variables de Profesores
$clv_profesor = (isset($_POST['clv_profesor'])) ? $_POST['clv_profesor'] : '';
$nom_profesor = (isset($_POST['nom_profesor'])) ? $_POST['nom_profesor'] : '';
$clv_depto = (isset($_POST['clv_depto'])) ? $_POST['clv_depto'] : '';
$clave_especialidad = (isset($_POST['clave_especialidad'])) ? $_POST['clave_especialidad'] : '';

//  variables de alumno
$no_control = (isset($_POST['no_control'])) ? $_POST['no_control'] : '';
$nom_alumno = (isset($_POST['nom_alumno'])) ? $_POST['nom_alumno'] : '';
$clv_especialidad = (isset($_POST['clv_especialidad'])) ? $_POST['clv_especialidad'] : '';

//  variables de grupo
$id_grupo = (isset($_POST['id_grupo'])) ? $_POST['id_grupo'] : '';
$id_materia = (isset($_POST['id_materia'])) ? $_POST['id_materia'] : '';
$clave_grupo = (isset($_POST['clave_grupo'])) ? $_POST['clave_grupo'] : '';
$clave_profesor = (isset($_POST['clave_profesor'])) ? $_POST['clave_profesor'] : '';
$total_alumnos = (isset($_POST['total_alumnos'])) ? $_POST['total_alumnos'] : '';

// variables de administrador
$clv_administrador = (isset($_POST['clv_administrador'])) ? $_POST['clv_administrador'] : '';
$nom_administrador = (isset($_POST['nom_administrador'])) ? $_POST['nom_administrador'] : '';
$rol_administrador = (isset($_POST['rol_administrador'])) ? $_POST['rol_administrador'] : '';


switch ($opcion) {
    
    # Acciones de configuración
    case "actualizar_estado_cuestionario":
        $consulta = "UPDATE configuracion SET estado ='$cuestionario_estado', referencia = '$referencia' WHERE configuracion='$cuestionario'";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();

        $consulta = "SELECT * FROM configuracion WHERE configuracion='$cuestionario'";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        $data = $resultado->fetchAll(PDO::FETCH_ASSOC);
        break;
    case "eliminarRespuestas":
        $consulta = "DELETE FROM respuestas";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();

        $consulta = "ALTER TABLE respuestas AUTO_INCREMENT = 1";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        break;
    case "obtenerDatosProfesores":
        $consulta = "INSERT INTO rptprofesores (clv_grupo, clv_materia, nom_materia, clv_profesor, nom_profesor, totalumnos) 
                            SELECT grupos.clv_grupo, grupos.clv_materia, materias.nom_materia, profesores.clv_profesor, profesores.nom_profesor, grupos.totalumnos 
                            FROM grupos JOIN materias JOIN profesores 
                            ON grupos.clv_materia = materias.clv_materia AND grupos.clv_profesor = profesores.clv_profesor";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();

        $consulta = "SELECT * FROM rptprofesores ORDER BY id DESC LIMIT 1";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
        break;
    case "eliminarDatosProfesores":
        $consulta = "DELETE FROM rptprofesores";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();

        $consulta = "ALTER TABLE rptprofesores AUTO_INCREMENT = 1";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        break;
    
    # Acciones sobre los administradores de la aplicaci��n web
    case "agregarAdministrador":
        $consulta = "INSERT INTO usuarios (no_control, nom_usuario, clv_especialidad, usuario_rol) VALUES('$clv_administrador', '$nom_administrador', '$rol_administrador', 'ADMINISTRADOR')";			
        $resultado = $conexion->prepare($consulta);
        $resultado->execute(); 
        
        $consulta = "SELECT * FROM usuarios ORDER BY no_control DESC LIMIT 1";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);       
        break;
    case "actualizarAdministrador":
        $consulta = "UPDATE usuarios SET nom_usuario = '$nom_administrador', clv_especialidad = '$rol_administrador' WHERE no_control = '$clv_administrador' AND usuario_rol = 'ADMINISTRADOR'";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();

        $consulta = "SELECT * FROM usuarios WHERE usuario_rol ='ADMINISTRADOR'";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        $data = $resultado->fetchAll(PDO::FETCH_ASSOC);
        break;
    case "eliminarAdministrador":
        $consulta = "DELETE FROM usuarios WHERE no_control = '$clv_administrador' AND usuario_rol = 'ADMINISTRADOR'";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        break;

    # Acciones sobre los profesores
    case "agregarProfesor":
        $consulta = "INSERT INTO profesores (clv_profesor, nom_profesor, clv_depto, clv_especialidad) VALUES('$clv_profesor', '$nom_profesor', '$clv_depto', '$clave_especialidad')";			
        $resultado = $conexion->prepare($consulta);
        $resultado->execute(); 
        
        $consulta = "SELECT * FROM profesores ORDER BY clv_profesor DESC LIMIT 1";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);       
        break; 
    case "actualizarProfesor":
        $consulta = "UPDATE profesores SET nom_profesor='$nom_profesor', clv_depto='$clv_depto', clv_especialidad='$clave_especialidad' WHERE clv_profesor='$clv_profesor'";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();

        $consulta = "SELECT * FROM profesores WHERE clv_profesor='$clv_profesor'";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        $data = $resultado->fetchAll(PDO::FETCH_ASSOC);
        break;
    case "eliminarProfesor":
        $consulta = "DELETE FROM profesores WHERE clv_profesor='$clv_profesor'";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        break;
    case "eliminarProfesores":
        $consulta = "DELETE FROM profesores";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();

        $consulta = "ALTER TABLE profesores AUTO_INCREMENT = 1";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        break;

    # Acciones sobre los alumnos
    case "agregarAlumno":
        $consulta = "INSERT INTO usuarios (no_control, nom_usuario, clv_especialidad, usuario_rol) VALUES('$no_control', '$nom_alumno', '$clv_especialidad', 'ALUMNO')";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();

        $consulta = "SELECT * FROM usuarios ORDER BY clv_usuario DESC LIMIT 1";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        $data = $resultado->fetchAll(PDO::FETCH_ASSOC);
        break;
    case "actualizarAlumno":
        $consulta = "UPDATE usuarios SET nom_usuario='$nom_alumno', clv_especialidad='$clv_especialidad' WHERE no_control='$no_control'";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();

        $consulta = "SELECT * FROM usuarios WHERE no_control='$no_control'";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        $data = $resultado->fetchAll(PDO::FETCH_ASSOC);
        break;
    case "eliminarAlumno":
        $consulta = "DELETE FROM usuarios WHERE no_control='$no_control'";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        break;
    case "eliminarAlumnos":
        $consulta = "DELETE FROM usuarios";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        break;
    
    # Acciones sobre los Grupos
    case "agregarGrupo":
        $consulta = "INSERT INTO grupos (clv_grupo, clv_materia, clv_profesor, totalumnos) VALUES('$clave_grupo', '$id_materia', '$clave_profesor', '$total_alumnos')";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();

        $consulta = "SELECT * FROM grupos ORDER BY id_grupo DESC LIMIT 1";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        $data = $resultado->fetchAll(PDO::FETCH_ASSOC);
        break;
    case "actualizarGrupo":
        $consulta = "UPDATE grupos SET clv_grupo='$clave_grupo', clv_materia='$id_materia', clv_profesor='$clave_profesor', totalumnos='$total_alumnos' WHERE id_grupo='$id_grupo'";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();

        $consulta = "SELECT * FROM grupos WHERE id_grupo='$id_grupo'";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        $data = $resultado->fetchAll(PDO::FETCH_ASSOC);
        break;
    case "eliminarGrupo":
        $consulta = "DELETE FROM grupos WHERE id_grupo='$id_grupo'";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        break;
    case "eliminarGrupos":
        $consulta = "DELETE FROM grupos";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();

        $consulta = "ALTER TABLE grupos AUTO_INCREMENT = 1";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        break;
    
}

print json_encode($data, JSON_UNESCAPED_UNICODE); //se envia el array final de formato json a AJAX
$conexion = null;
