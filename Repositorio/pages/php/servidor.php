<?php
include "conexion.php";
$accion = $_GET["accion"];
switch ($accion) {
		case 'agregarRespuestas':
			$control = $_GET["con"]; $idMateria = $_GET["materia"]; $idProfesor = $_GET["profesor"]; $grupo = $_GET["grupo"]; $alu_carrera = $_GET["alu_carrera"];
			$res1 = $_GET["res1"]; $res2 = $_GET["res2"]; $res3 = $_GET["res3"];
			$res4 = $_GET["res4"]; $res5 = $_GET["res5"]; $res6 = $_GET["res6"];
			$res7 = $_GET["res7"]; $res8 = $_GET["res8"]; $res9 = $_GET["res9"];
			$res10 = $_GET["res10"]; $res11 = $_GET["res11"]; $res12 = $_GET["res12"];
			$res13 = $_GET["res13"]; $res14 = $_GET["res14"]; $res15 = $_GET["res15"];
			$res16 = $_GET["res16"]; $res17 = $_GET["res17"]; $res18 = $_GET["res18"];
			$res19 = $_GET["res19"]; $res20 = $_GET["res20"]; $res21 = $_GET["res21"];
			$res22 = $_GET["res22"]; $res23 = $_GET["res23"]; $res24 = $_GET["res24"];
			$res25 = $_GET["res25"]; $res26 = $_GET["res26"]; $res27 = $_GET["res27"];
			$res28 = $_GET["res28"]; $res29 = $_GET["res29"]; $res30 = $_GET["res30"];
			$res31 = $_GET["res31"]; $res32 = $_GET["res32"]; $res33 = $_GET["res33"];
			$res34 = $_GET["res34"]; $res35 = $_GET["res35"]; $res36 = $_GET["res36"];
			$res37 = $_GET["res37"]; $res38 = $_GET["res38"]; $res39 = $_GET["res39"];
			$res40 = $_GET["res40"]; $res41 = $_GET["res41"]; $res42 = $_GET["res42"];
			$res43 = $_GET["res43"]; $res44 = $_GET["res44"]; $res45 = $_GET["res45"];
			$res46 = $_GET["res46"]; $res47 = $_GET["res47"]; $res48 = $_GET["res48"];
			$sql = "insert into respuestas values (0,'$control','$idMateria','$idProfesor','$grupo','$alu_carrera','$res1','$res2',
					'$res3','$res4','$res5','$res6','$res7','$res8','$res9','$res10','$res11','$res12','$res13',
					'$res14','$res15','$res16','$res17','$res18','$res19','$res20','$res21','$res22','$res23','$res24',
					'$res25','$res26','$res27','$res28','$res29','$res30','$res31','$res32','$res33','$res34','$res35',
					'$res36','$res37','$res38','$res39','$res40','$res41','$res42','$res43','$res44','$res45','$res46',
					'$res47','$res48',curdate())";
			$ejecutarSQL = $conn->query($sql) or die("Error al agregar la pregunta");
			if ($ejecutarSQL) {
				echo "1";
			} else {
				echo "0";
				echo "Falló la ejecución: (" . $sentencia->errno . ") " . $sentencia->error;
			}
			break;
			
			case 'verificar':
				$no_control = $_GET["control"]; $materia = $_GET["_materia"];
				$sqlverificar = "SELECT  no_control, clv_materia FROM respuestas WHERE no_control = '$no_control' AND clv_materia='$materia'";
				$ejecutarVerificar = $conn->query($sqlverificar) or die("Error");

				while($row = $ejecutarVerificar->fetch_assoc()) {
					$verifica_control = $row['no_control'];
					$verifica_materia = $row['clv_materia'];

				}

				if ($verifica_control == $no_control && $verifica_materia == $materia) {
					echo "1";
				} else {
					echo "0";
				}
			break;
	}
?>
