<?php
session_start();
include 'Base.php';
//Coneccion ala base de datos
$conn = conectar();
//Obtencion de los datos de los campos

$CodigoMensaje = $_POST['radio'];

//Llamado al procedimiento almacenado
$sql = "CALL MostrarMensaje ('".$CodigoMensaje. "')";
if($respuesta = $conn->query($sql)){
$conn->query($sql);
$respuesta = $conn->query($sql);
$fila = $respuesta->fetch_assoc();
$Mensaje = $fila['Mensaje2'];
Echo "<textarea value='$Mensaje' name='Mensaje' rows='10' cols='50'/>"; 
}else{
    $_SESSION['mensaje'] = "Error de conexión. Favor intentarlo más tarde";
    $_SESSION['tipoerror'] = 1;
    header("Location: Mensajes.php");
  }

?>