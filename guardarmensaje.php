<?php
include 'Base.php';
//Coneccion ala base de datos
$conn = conectar();
if($conn->connect_error){
die("Conexion a la base fallida: " . $connect_error);
}
//Obtencion de los datos de los campos

$CodigoMensaje = $_POST['radio'];
$Mensaje = $_POST['Mensaje'];
//Llamado al procedimiento almacenado
$sql = "CALL ModificarMensaje ('".$CodigoMensaje. "', '".$Mensaje. "')";
$conn->query($sql);


?>