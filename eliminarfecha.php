<?php
	session_start();
	include 'Base.php';
	//Coneccion ala base de datos
	$con = conectar();
	if(isset($_GET['prueba'])){
		$sql = "CALL EliminarPrueba(".$_GET['prueba'].");";
		if($respuesta = $con->query($sql)){
			$_SESSION['mensaje'] = "Prueba eliminada";
    	$_SESSION['tipoerror'] = 0;
		} else {
			$_SESSION['mensaje'] = "Error de conexión. Favor intentarlo de nuevo";
			$_SESSION['tipoerror'] = 1;
		}
	} else {
		$_SESSION['mensaje'] = "No especificó la prueba a eliminar";
    $_SESSION['tipoerror'] = 1;
	}
	header("Location: fechaprueba.php");
?>