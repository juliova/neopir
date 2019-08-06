<?php
	session_start();
	include 'Base.php';
	//Coneccion a la base de datos
	$con = conectar();
	if(isset($_SESSION['totalPreguntas'])){
		if(isset($_GET['pregunta'])){
			if($_GET['pregunta']==$_SESSION['totalPreguntas']){
				$sql = "CALL EliminarPregunta(".$_GET['pregunta'].");";
				if($respuesta = $con->query($sql)){
					$_SESSION['mensaje'] = "Pregunta eliminada";
					$_SESSION['tipoerror'] = 0;
				} else {
					$_SESSION['mensaje'] = "Error de conexión. Favor intentarlo de nuevo";
					$_SESSION['tipoerror'] = 1;
				}
			} else {
				$_SESSION['mensaje'] = "La pregunta no puede ser eliminada.";
				$_SESSION['tipoerror'] = 1;
			}
		} else {
			$_SESSION['mensaje'] = "No especificó la pregunta a eliminar";
			$_SESSION['tipoerror'] = 1;
		}
	} else {

	}
	
	header("Location: preguntas.php");
?>