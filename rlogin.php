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
$respuesta = $conn->query($sql);
  $fila = $respuesta->fetch_assoc();

  $Rol = $fila['Rol2'];
  $_SESSION['usuario'] = $cedula;
  $_SESSION['Rol'] = $Rol;
if($rol ==0 ){
  echo "<script type='text/javascript'>alert('Login Exitoso'); window.location.href = 'index.php';</script>";
} else {
  echo "<script type='text/javascript'>alert('Login Fallido'); window.location.href= 'login.php';</script>";
}
?>