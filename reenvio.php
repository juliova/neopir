<?php 
  session_start();
  include 'Base.php';
  include '_menu.php';
  include 'Correo.php';
  date_default_timezone_set("America/Costa_Rica");
  if(!isset($_SESSION['Rol'])){
    $_SESSION['mensaje'] = "Debe identificarse antes de continuar";
    $_SESSION['tipoerror'] = 1;
    header("Location: login.php");
  } else {
    if($_SESSION['Rol'] == 3){
      $_SESSION['mensaje'] = "No posee los permisos necesarios.";
      $_SESSION['tipoerror'] = 1;
      header("Location: index.php");
    }
  }
  $conn = conectar();
  $CodigoMensaje = 0;
  //Obtencion de los datos de los campos
  if(isset($_POST['listbox'])){
    $CodigoMensaje = $_POST['listbox'];
    $cedula = $_POST['cedula3'];
    
  }

  if(isset($_POST['btn'])){
    if($_POST['listbox'] == 1){
      $Mensaje3 = "";
      $Html = "";
      $Asunto = "";
      $Estilo = 0;
      //Procedimiento reenvio correo de registro
      $sql = "CALL Correo (".$CodigoMensaje.")";
      if($respuesta = $conn->query($sql)){
        $fila = $respuesta->fetch_assoc();
        $Mensaje3 = $fila['TextoCorreo'];
        $Html = $fila['html'];
        $Asunto = $fila['asunto'];
        $Estilo = $fila['estilo'];
      }else{
        $_SESSION['mensaje'] = "Error de conexión en correo. Favor intentarlo más tarde";
        $_SESSION['tipoerror'] = 1;
      }
      $conn->close();
      $conn = conectar();
      $sql = "CALL ObtenerEstudiante (".$cedula.")";
      if($respuesta = $conn->query($sql)){
        $fila = $respuesta->fetch_assoc();
        $destino = $fila['Correo'];
        $token = $fila['Token'];
        if ($token == ''){
          $_SESSION['mensaje'] = "Error devolvio vacio";
          $_SESSION['tipoerror'] = 1;
        } else {
          try{
            $mail = iniciarCorreo();
            $mail->addAddress($destino);
            $mail->Subject = $Asunto;
            //Llamar plantilla de html.
            $archivo = file_get_contents("correos/tipo".$Estilo.".html"); 
            //Apuntar al servidor con el url del sitio para obtener el logo.
            $archivo = str_replace("url(\"","url(\"https://".$_SERVER['HTTP_HOST']."/",$archivo);
            //Insertar el asunto como el título del correo.
            $archivo = str_replace("{[titulo]}",$Asunto,$archivo);
            //Insertar el contenido de correo.
            $archivo = str_replace("{[parrafos]}",$Html,$archivo);
            //Insertar link a validar
            $archivo = str_replace("{[enlace]}","<a href=\"https://".$_SERVER['HTTP_HOST']."/validar.php\" target=\"_blank\">Validar Registro</a>",$archivo);
            //Insertar el tiquete del correo.
            $archivo = str_replace("{[tiquete]}",$token,$archivo);
            //Insertar un link a la página principal del sitio.
            $archivo = str_replace("{[raíz]}","https://".$_SERVER['HTTP_HOST'],$archivo);
            $archivo2 = str_replace("{[enlace]}","https://".$_SERVER['HTTP_HOST']."/validar.php", $Mensaje3);
            $archivo2 = str_replace("{[tiquete]}",$token,$archivo2);
            $mail->Body = $archivo;
            $mail->AltBody = $archivo2; 
            $mail->send();
            $_SESSION['mensaje'] = "Correo enviado a $destino";
            $_SESSION['tipoerror'] = 0;
          } catch (Exception $e){
            $_SESSION['mensaje'] = "Registro exitoso, Envío de correo fallido";
            $_SESSION['tipoerror'] = 1;
            header("Location: login.php");
          }	catch (\Exception $e){
            $_SESSION['mensaje'] = "Registro exitoso, Envío de correo fallido";
            $_SESSION['tipoerror'] = 1;
            header("Location: login.php");
          }
          
        }
      }else{
        $_SESSION['mensaje'] = "Error de conexión despues de correo. Favor intentarlo más tarde";
        $_SESSION['tipoerror'] = 1;
      }
         ////////Aqui va el codigo de envio de Correo con las variables de arriba



    }
    if($_POST['listbox'] == 2){
      $Mensaje3 = "";
      $Html = "";
      $Asunto = "";
      $Estilo = 0;
    //Procedimiento reenvio correo de matricula
    $sql = "CALL Correo(".$CodigoMensaje.")";
    if($respuesta = $conn->query($sql)){
      $fila = $respuesta->fetch_assoc();
      $Mensaje3 = $fila['TextoCorreo'];
      $Html = $fila['html'];
      $Asunto = $fila['asunto'];
      $Estilo = $fila['estilo'];
    }else{

      $_SESSION['mensaje'] = "Error de conexión. Favor intentarlo más tarde";
      $_SESSION['tipoerror'] = 1;
    }
    $conn->close();
    $conn = conectar();
    $sql = "CALL DatosMatricula (".$cedula.",'".date("Y-m-d h:i:s")."')";
    if($respuesta = $conn->query($sql)){
      $fila = $respuesta->fetch_assoc();
      $destino = $fila['Correo'];
      $token = $fila['Token'];
      if($token == ''){
        $_SESSION['mensaje'] = "Error devolvio vacio";
        $_SESSION['tipoerror'] = 1;
      } else {
        try{
          $mail = iniciarCorreo();
          $mail->addAddress($destino);
          $mail->Subject = $Asunto;
          $archivo = file_get_contents("correos/tipo".$Estilo.".html");
          $archivo = str_replace("url(\"","url(\"https://".$_SERVER['HTTP_HOST']."/",$archivo);
          $archivo = str_replace("{[titulo]}",$Asunto,$archivo);
          $archivo = str_replace("{[parrafos]}",$Html,$archivo);
          $archivo = str_replace("{[tiquete]}",$token,$archivo);
          $archivo = str_replace("{[raíz]}","https://".$_SERVER['HTTP_HOST'],$archivo);
          $mail->Body = $archivo;
          $mail->AltBody = str_replace("{[tiquete]}",$token,$Mensaje3); 
          $mail->send();
          $_SESSION['mensaje'] = "Correo enviado a $destino";
          $_SESSION['tipoerror'] = 0;
        } catch (Exception $e){
          $_SESSION['mensaje'] = "Error al enviar el correo";
          $_SESSION['tipoerror'] = 1;
        }	catch (\Exception $e){
          $_SESSION['mensaje'] = "Error al enviar el correo";
          $_SESSION['tipoerror'] = 1;
        }
        
      }
    }else{
      $_SESSION['mensaje'] = "Error de conexión. Favor intentarlo más tarde";
      $_SESSION['tipoerror'] = 1;
    }
        ////////Aqui va el codigo de envio de Correo con las variables de arriba
    }
    
  }

?>
<!DOCTYPE html>
<html>

  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link type="text/css" rel="stylesheet" href="css/estilo.css" />
    <link type="text/css" rel="stylesheet" href="css/all.css" />
    <script src="js/jquery-3.4.1.min.js"></script>
    <script src="js/scripts.js"></script>
  </head>

  <body>
    <div class="barraUsuario">
      <div class="contenedor">
        <ul>
          <?php barraUsuario(); ?>
        </ul>
      </div>
    </div>
    <div class="contenedor">
      <menu>
        <img class="logo" src="img/logo-blanco-64.png" />

        <i class="fas fa-bars"></i>
        <div>
          <ul>
            <?php menu(); ?>
          </ul>
        </div>
      </menu>

      <!--Contenido-->
      <div class="contenido">
        <div class="seccionMedia">

          <!--Reenvio-->
          <div>
            <form action="reenvio.php" method="POST">
              <div>
                <h1>Reenviar Correos</h1>
             
                <div class="columna1">
                  <label>Cedula:</label>
                </div>
                <div class="columna2">
                  <input type="text" name="cedula3" required/>
                </div>
                
                <div class="columna1">
                  <label>Tipo de Correos:</label>
                </div>

                <div class="columna2">
                  <select name="listbox" size=1>
         
                    <option value=1>Registro</option>
                    <option value=2>Matricula</option>
               
                  </select>
                </div>
              
              </div>
              <button  type="submit" name="btn" class="posicionDerecha">Reenviar</button>
            </form>
          </div>
        </div>
      </div>
      <?php include 'error.php';?>
    </div>
  </body>

</html>