<?php
session_start();
include 'Base.php';
//Coneccion ala base de datos
$conn = conectar();

//Obtencion de los datos de los campos

$CodigoMensaje = $_POST['radio'];
$Mensaje3 = $_POST['Mensaje'];
//Llamado al procedimiento almacenado
$sql = "CALL ModificarMensaje ('".$CodigoMensaje. "', '".$Mensaje3. "')";

if($respuesta = $conn->query($sql)){
    $fila = $respuesta->fetch_assoc();
    if($fila['R'] == 0){
      $_SESSION['mensaje'] = "Modificacion Exitosa";
      $_SESSION['tipoerror'] = 0;
      header("Location: Mensajes.php");
    }else{
      $_SESSION['mensaje'] = "Modificacion Fallida";
      $_SESSION['tipoerror'] = 1;
      header("Location: Mensajes.php");
    }
  }else{
    $_SESSION['mensaje'] = "Error de conexión. Favor intentarlo más tarde";
    $_SESSION['tipoerror'] = 1;
    header("Location: Mensajes.php");
  }
  ?>