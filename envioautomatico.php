<?php
//Probablemtene se tenga que cambiar esta parte poner la conexion a la base manualemnte
  session_start();
  include 'Base.php';
  include 'Correo.php';
  date_default_timezone_set("America/Costa_Rica");
    //Realizar la conexión
  $conn = conectar();
  $contador = 0;
  $contador2 = 3;
  $Mensaje3 = "";
  $Html = "";
  $Asunto = "";
  $archivo = "";
  $tiempo = date("Y-m-d");
  echo $tiempo ."<br>";
       //Obtenemos el Mensaje 5 Recordatorio
  $sql = "CALL Correo (5)";
  if($respuesta = $conn->query($sql)){
    $fila = $respuesta->fetch_assoc();
    $Mensaje3 = $fila['TextoCorreo'];
    $Html = $fila['html'];
    $Asunto = $fila['asunto'];
    //Llamar plantilla de html.
    $archivo = file_get_contents("correos/tipo".$fila['estilo'].".html"); 
    //Apuntar al servidor con el url del sitio para obtener el logo.
    $archivo = str_replace("url(\"","url(\"https://".$_SERVER['HTTP_HOST']."/",$archivo);
    //Insertar el asunto como el título del correo.
    $archivo = str_replace("{[titulo]}",$Asunto,$archivo);
    //Insertar el contenido de correo.
    $archivo = str_replace("{[parrafos]}",$Html,$archivo);
    //Insertar un link a la página principal del sitio.
    $archivo = str_replace("{[raíz]}","https://".$_SERVER['HTTP_HOST'],$archivo);
    echo $Html;
  }else{
    echo 'error en Correo<br>';
  }
  $conn->close();
  $conn= conectar();
  //Procedimiento almacenado que consigue el contador de estudiantes que haran la prueba el dia siguiente
  $sql = "CALL ContadorEstudiantes ('".$tiempo."')";
  if($respuesta = $conn->query($sql)){
  $fila = $respuesta->fetch_assoc();
  //Contador 2 se vuelve igual a la cantidad de estudiantes que van a hacer la prueba mañana
  $contador2 =  $fila['estudiantes'];
  echo "Contador 2: ". $contador2."<br>";
  }else{
    echo 'error en ContadorEstudiantes<br>';
  }
  $conn->close();
        //Repetir el proceso para enviar correo a cada uno de los estudiantes
     // while ( $contador <=  $contador2) {
        $conn = conectar();
        //Procedimiento almacenado donde se consigue el correo del estudiante que deba hacer la prueba al dia siguiente
        $sql = "CALL CorreoAutomatico ('".$tiempo."')";
        //Pasa por cada uno de los resultados
        if($respuesta = $conn->query($sql)){
          while($fila = $respuesta->fetch_assoc()){
            $Correo =  $fila['Correo'];
            $Fecha =  $fila['Fechar'];
            $Tiquete =  $fila['Token'];
            try{
            //// Codigo de envio de Correo con los datos de arriba
            $mail = iniciarCorreo();
            $mail->addAddress($Correo);
            $mail->Subject=$Asunto;
            $Mensaje4 = $archivo;
            $Mensaje4 = str_replace("{[fecha]}",date("d/m/Y",strtotime($Fecha)),$Mensaje4);
            $Mensaje4 = str_replace("{[hora]}",date("h:i:s A",strtotime($Fecha)),$Mensaje4);
            $Mensaje4 = str_replace("{[tiquete]}",$Tiquete,$Mensaje4);
            $Mensaje5 = $Mensaje3;
            $Mensaje5 = str_replace("{[fecha]}",date("d/m/Y",strtotime($Fecha)),$Mensaje5);
            $Mensaje5 = str_replace("{[hora]}",date("h:i:s A",strtotime($Fecha)),$Mensaje5);
            $Mensaje5 = str_replace("{[tiquete]}",$Tiquete,$Mensaje5);
            $mail->Body = $Mensaje4;
            $mail->AltBody = $Mensaje5; 
            $mail->send();
            } catch (Exception $e){
            }	catch (\Exception $e){
            }
            echo $Mensaje4;
          }
        }else{
          echo 'error en CorreoAutomatico';
        }
        //Cierra Conexion
        $conn->close();

        //Contador aumenta +1 por cada loop hasta alcansar a contador 2
           $contador++;



?>
