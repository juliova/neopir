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
    echo "<script type='text/javascript'>alert('Login Exitoso'); window.location.href = 'index.php';</script>";
  } else {
    echo "<script type='text/javascript'>alert('Login Fallido'); window.location.href= 'login.php';</script>";
  }
} else {
  ?>
    <h1>Conexión fallida</h1>
  <?php
}
  
?>