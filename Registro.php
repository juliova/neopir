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
    try{
      $mail = iniciarCorreo();
      $mail->addAddress($Correo);
      $mail->Subject = $fila['@asunto'];
      $mail->Body = str_replace("{[tiquete]}",$fila['Token2'],$fila['@html']);
      $mail->AltBody = str_replace("{[tiquete]}",$fila['Token2'],$fila['@texto']); 
      $mail->send();
      $_SESSION['mensaje'] = "Registro Exitoso favor revisar su Correo";
      $_SESSION['tipoerror'] = 0;
      header("Location: login.php");
    } catch (Exception $e){
      $_SESSION['mensaje'] = "Registro exitoso, Envío de correo fallido";
      $_SESSION['tipoerror'] = 1;
      header("Location: login.php");
    }	catch (\Exception $e){
      $_SESSION['mensaje'] = "Registro exitoso, Envío de correo fallido";
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