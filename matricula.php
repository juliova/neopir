<?php 
  session_start();
  include 'Base.php';
  include '_menu.php';
  include 'Correo.php';
  if(!isset($_SESSION['usuario'])){
    header("Location: index.php");
  }
  date_default_timezone_set("America/Costa_Rica");
  if(isset($_GET['prueba'])){
    $con = conectar();
    $sql = "Call Matricula(".$_GET['prueba'].",".$_SESSION['usuario'].");";
    if($respuesta = $con->query($sql)){
      $fila = $respuesta->fetch_assoc();
      try{
        $mail = iniciarCorreo();
        $mail->addAddress($fila['Correo']);
        $mail->Subject = $fila['@asunto'];
        $archivo = file_get_contents("correos/tipo".$fila['@estilo'].".html");
        $archivo = str_replace("url(\"","url(\"https://".$_SERVER['HTTP_HOST']."/",$archivo);
        $archivo = str_replace("{[titulo]}",$fila['@asunto'],$archivo);
        $archivo = str_replace("{[parrafos]}",$fila['@html'],$archivo);
        $archivo = str_replace("{[tiquete]}",$fila['Token2'],$archivo);
        $archivo = str_replace("{[raíz]}","https://".$_SERVER['HTTP_HOST'],$archivo);
        $mail->Body = $archivo;
        $mail->AltBody = str_replace("{[tiquete]}",$fila['Token2'],$fila['@texto']); 
        $mail->send();
        $_SESSION['mensaje'] = "Matrícula realizada con éxito. El tiquete fué enviado al correo";
        $_SESSION['tipoerror'] = 0;
      } catch (Exception $e){
        $_SESSION['mensaje'] = "Matrícula realizada con éxito. Error al enviar el correo";
        $_SESSION['tipoerror'] = 1;
      }	catch (\Exception $e){
        $_SESSION['mensaje'] = "Matrícula realizada con éxito. Error al enviar el correo";
        $_SESSION['tipoerror'] = 1;
      }
    } else {
      $_SESSION['mensaje'] = "Error de conexión. Favor intentarlo de nuevo";
      $_SESSION['tipoerror'] = 1;
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
    <link type="text/css" rel="stylesheet" href="css/datepicker.min.css" />
    <script src="js/jquery-3.4.1.min.js"></script>
    <script src="js/datepicker.min.js"></script>
    <script src="js/datepicker.es.js"></script>
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
        <?php 
          $con = conectar();
          $sql = "CALL PruebasDisponibles('".date("Y-m-d H:i:s")."',".$_SESSION['usuario'].");";
          if($respuesta = $con->query($sql)){
            while($fila = $respuesta->fetch_assoc()){
              if($fila['pendiente'] == 0){
                ?>
                <div class="ficha" onclick="window.location.href='matricula.php?prueba=<?php echo $fila['IDPrueba']; ?>'">
                  <div class="head">
                    <?php
                      echo date("d/m/Y",strtotime($fila['Fechar'])); 
                    ?>
                  </div>
                  <div class="cuerpo">
                    <ul>
                      <li>Hora Inicio: <?php echo date("h:i:s A",strtotime($fila['Fechar'])); ?></li>
                      <li>Hora Final: <?php echo date("h:i:s A",strtotime($fila['fechaF'])); ?></li>
                      <li>Campos: <?php echo $fila['cupo']; ?></li>
                    </ul>
                  </div>
                </div>
                <?php
              } else {
                $_SESSION['mensaje'] = "No es elegible para realizar la matrícula";
                $_SESSION['tipoerror'] = 1;
              }
            }
          } else {
            $_SESSION['mensaje'] = "Error de conexión. Favor intentarlo de nuevo";
            $_SESSION['tipoerror'] = 1;
          }
        ?>
      </div>
      <?php include 'error.php';?>
    </div>
  </body>

</html>
