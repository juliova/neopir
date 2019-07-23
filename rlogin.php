<?php
session_start();
include 'Base.php';
//Coneccion ala base de datos
$conn = conectar();
if($conn->connect_error){
die("Conexion a la base fallida: " . $connect_error);
}
//Obtencion de los datos de los campos
 $cedula = $_POST['cedula'];
  $contra = $_POST['contra'];


//Llamado al procedimiento almacenado
//$sql = "CALL Login (".$cedula .", '".$contra. "', @Rol2)";
$sql ="CALL Login(".$cedula.",'".$contra."');";
//Puede implicar fallos no probado
$respuesta = $conn->query($sql);
if($respuesta->num_rows >0){
  $fila = $respuesta->fetch_assoc();

  $Rol = $fila['Rol2'];
  $_SESSION['usuario'] = $cedula;
  $_SESSION['Rol'] = $Rol;
  echo "<script type='text/javascript'>alert('Login Exitoso'); window.location.href = 'index.php';</script>";
  //header('Location:index.php');
} else {
  echo "<script type='text/javascript'>alert('Login Fallido'); window.location.href= 'login.html';</script>";
  //header('Location:login.html');
}
//Se determinal la variable de sesion rol para mas adelante

//Se determinar si el login fue exitoso si rol tiene un valor mayor a 0
/*
if($Rol = 0)
{
  echo "<script type='text/javascript'>alert(Login Fallido);</script>";
  header('Location:login.php');
}
else {
  echo "<script type='text/javascript'>alert(Login Exitoso);</script>";
  header('Location:index.php');
}*/

?>