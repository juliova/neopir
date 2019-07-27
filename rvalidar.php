<?php
session_start();
include 'Base.php';
//Coneccion ala base de datos
$conn = conectar();
//Obtencion de los datos de los campos
$cedula = $_POST['cedula3'];
$token = $_POST['token'];


//Llamado al procedimiento almacenado
$sql = "CALL Validacion (".$cedula.", '".$token."');";
if($respuesta = $conn->query($sql)){
  $fila = $respuesta->fetch_assoc();
  if($fila['R'] == 0){
    $_SESSION['mensaje'] = "Validación Exitosa";
    $_SESSION['tipoerror'] = 0;
    header("Location: login.php");
  }else{
    $_SESSION['mensaje'] = "Validación Fallida";
    $_SESSION['tipoerror'] = 1;
    header("Location: validar.php");
  }
}else{
  $_SESSION['mensaje'] = "Error de conexión. Favor intentarlo más tarde";
  $_SESSION['tipoerror'] = 1;
  header("Location: validar.php");
}

?>