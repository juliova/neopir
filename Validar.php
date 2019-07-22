<?php
include 'Base.php';
//Coneccion ala base de datos
$conn = conectar();
if($conn->connect_error){
die("Conexion a la base fallida: " . $connect_error);
}
//Obtencion de los datos de los campos
$cedula = $_POST['cedula2'];
$token = $_POST['token'];


//Llamado al procedimiento almacenado
$sql = "CALL Validacion ('".$cedula ."', '".$token. "')";
$conn->query($sql);


?>