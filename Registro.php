<?php
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
$sql = "CALL Registro (".$Cedula .", '".$Nombre."', '".$Apellido1."', '".$Apellido2."', '".$Correo."', '".$Genero."', '".$Contra."', '@Token2', @Mensaje2)";
//Puede implicar fallos no probado tomar valores de token y mensaje
$respuesta = $conn->query($sql);
$fila = $respuesta->fetch_assoc();
$Token = $fila['Token2'];
$Mensaje = $fila['Mensaje2'];

$Mensaje2 = $Mensaje. "\n";
$Mensaje2 .= $Token;
//Envio de Correo el orden de los datos es destinatario,asunto y mensaje
mail($Correo,'Tiquete Validacion de Registro',$Mensaje2);

echo "<script type='text/javascript'>alert(Registro Exitoso favor revisar su Correo);</script>";
header('Location:login.html');

?>