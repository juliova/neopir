<?php
session_start();
include 'Base.php';
//Coneccion ala base de datos
$conn = conectar();
if($conn->connect_error){
die("Conexion a la base fallida: " . $connect_error);
}
//Obtencion de los datos de los campos
$Cedula = $_POST['cedula2'];
$Nombre = $_POST['nombre'];
$Apellido1 = $_POST['apellidos1'];
$Apellido2 = $_POST['apellidos2'];
$Correo = $_POST['correo'];
$Contra = $_POST['contra2'];
///Determinar Genero por los radiobuttons
$Genero = $_POST['radio'];


//Llamado al procedimiento almacenado
$sql = "CALL Registro (".$Cedula .", '".$Nombre."', '".$Apellido1."', '".$Apellido2."', '".$Correo."', '".$Genero."', '".$Contra."')";
//Puede implicar fallos no probado tomar valores de token y mensaje
if($respuesta = $conn->query($sql)){
  $fila = $respuesta->fetch_assoc();
  
  if(isset($fila['Token2'])){
    $Token = $fila['Token2'];
    $Mensaje = $fila['Mensaje2'];

    $Mensaje2 = $Mensaje. "\n";
    $Mensaje2 .= $Token;
    //Envio de Correo el orden de los datos es destinatario,asunto y mensaje
    if(mail($Correo,'Tiquete Validacion de Registro',$Mensaje2)){
      $_SESSION['mensaje'] = "Registro Exitoso favor revisar su Correo";
      $_SESSION['tipoerror'] = 0;
      header("Location: login.php");
    } else {
      $_SESSION['mensaje'] = "Registro exitosos, Envío de correo fallido";
      $_SESSION['tipoerror'] = 1;
      header("Location: login.php");
    }
    
  } else {
    $_SESSION['mensaje'] = "Registro Fallido favor intente de nuevo mas tarde";
    $_SESSION['tipoerror'] = 1;
    header("Location: login.php");
  }
}else{
  $_SESSION['mensaje'] = "Error de conexión. Favor intentarlo más tarde";
  $_SESSION['tipoerror'] = 1;
  header("Location: login.php");
}
?>