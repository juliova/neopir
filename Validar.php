<?php
include 'Base.php';
//Coneccion ala base de datos
$conn = conectar();
if($conn->connect_error){
die("Conexion a la base fallida: " . $connect_error);
}
//Obtencion de los datos de los campos
$cedula = $_POST['cedula3'];
$token = $_POST['token'];


//Llamado al procedimiento almacenado
$sql = "CALL Validacion (".$cedula .", '".$token. "');";
$conn->query($sql);
if(mysqli_affected_rows($conn) >0){
  echo "<script type='text/javascript'>alert('Validacion Correcta'); window.location.href='index.php';</script>";
  //header('Location:index.html');
}else{
  echo "<script type='text/javascript'>alert('Validacion Incorrecta'); window.location.href='Validar.html';</script>";
  //header('Location:Validar.html');
}

?>