<?php
include 'Base.php';
//Coneccion ala base de datos
$conn = conectar();
//Obtencion de los datos de los campos
$cedula = $_POST['cedula3'];
$token = $_POST['token'];


//Llamado al procedimiento almacenado
$sql = "CALL Validacion (".$cedula .", '".$token. "');";
if($conn->query($sql)){
  echo "<script type='text/javascript'>alert('Validacion Correcta'); window.location.href='index.php';</script>";
  //header('Location:index.html');
}else{
  echo "<script type='text/javascript'>alert('Validacion Incorrecta'); window.location.href='validar.html';</script>";
  //header('Location:Validar.html');
}

?>