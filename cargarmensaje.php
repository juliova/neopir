<?php
include 'Base.php';
//Coneccion ala base de datos
$conn = conectar();
if($conn->connect_error){
die("Conexion a la base fallida: " . $connect_error);
}
//Obtencion de los datos de los campos

$CodigoMensaje = $_POST['radio'];

//Llamado al procedimiento almacenado
$sql = "CALL MostrarMensaje ('".$CodigoMensaje. "')";
$conn->query($sql);
$respuesta = $conn->query($sql);
$fila = $respuesta->fetch_assoc();
$Mensaje = $fila['Mensaje2'];
Echo "<input type='text' value='$Mensaje' name='Mensaje' />";  

?>