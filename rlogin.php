<?php
session_start();
include 'Base.php';
//Coneccion ala base de datos
$conn = conectar();
//Obtencion de los datos de los campos
$cedula = $_POST['cedula'];
$contra = $_POST['contra'];


//Llamado al procedimiento almacenado
$sql ="CALL Login(".$cedula.",'".$contra."');";
if($respuesta = $conn->query($sql)){
  $fila = $respuesta->fetch_assoc();

  if($fila['Rol2'] !=0 ){
    $_SESSION['usuario'] = $cedula;
    $_SESSION['Rol'] = $fila['Rol2'];
    $_SESSION['mensaje'] = "Login Exitoso";
    $_SESSION['tipoerror'] = 0;
    header("Location: index.php");
  } else {
    $_SESSION['mensaje'] = "Login Fallido";
    $_SESSION['tipoerror'] = 1;
    header("Location: login.php");
  }
} else {
  $_SESSION['mensaje'] = "Error de conexión. Favor intentarlo más tarde";
  $_SESSION['tipoerror'] = 1;
  header("Location: login.php");
}
  
?>