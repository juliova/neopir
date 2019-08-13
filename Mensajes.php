<?php 
  session_start();
  include 'Base.php';
  include '_menu.php';
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
  $Mensaje3 = "";
  $Html = "";
  $Asunto = "";
  //Obtencion de los datos de los campos
  if(isset($_POST['listbox'])){
    $CodigoMensaje = $_POST['listbox'];
  }
  if(isset($_POST['mensaje'])){
    $Mensaje3 = $_POST['mensaje'];
  }
  if(isset($_POST['html'])){
    $Html = $_POST['html'];
  }
  if(isset($_POST['asunto'])){
    $Asunto = $_POST['asunto'];
  }
  if(isset($_POST['btn'])){
    if($_POST['btn'] == 2){
      //Llamado al procedimiento almacenado cargar
      $sql = "CALL Correo (".$CodigoMensaje. ")";
      if($respuesta = $conn->query($sql)){
      $fila = $respuesta->fetch_assoc();
      $Mensaje3 = $fila['TextoCorreo'];
      $Html = $fila['html'];
      $Asunto = $fila['asunto'];
      }else{
        $_SESSION['mensaje'] = "Error de conexión. Favor intentarlo más tarde";
        $_SESSION['tipoerror'] = 1;
      }
    }
    if($_POST['btn'] == 1){
    //Llamado al procedimiento almacenado guardar
    $sql = "CALL ModificarMensaje (".$CodigoMensaje. ",'".$Asunto."','".$Html."' ,'".$Mensaje3. "');";
    if($respuesta = $conn->query($sql)){
        $fila = $respuesta->fetch_assoc();
        if($fila['R'] == 0){
          $_SESSION['mensaje'] = "Modificacion Exitosa";
          $_SESSION['tipoerror'] = 0;
        }else{
          $_SESSION['mensaje'] = "Modificacion Fallida";
          $_SESSION['tipoerror'] = 1;
        }
      }else{
        $_SESSION['mensaje'] = "Error de conexión. Favor intentarlo más tarde";
        $_SESSION['tipoerror'] = 1;
      }
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

          <!--Validacion-->
          <div>
            <form  action="mensajes.php" method="POST">
              <div>
                <h1>Modificar Mensajes</h1>
                <div class="columna1">
                  <label>Asunto:</label>
                </div>

                <div class="columna2">
                  <input placeholder="Asunto del correo" type="text" name="asunto" value="<?php if($Asunto!=""){ echo $Asunto; } ?>">
                </div>
                <div class="columna1">
                  <label>Html:</label>
                </div>
                <div class="columna2">
                  <textarea name="html" rows="5" 
                    placeholder="Texto con formato html"><?php if($Html != ""){ echo $Html;} ?></textarea>
                </div>
                <div class="columna1">
                  <label>Texto:</label>
                </div>
                <div class="columna2">
                  <textarea name="mensaje" rows="5" 
                    placeholder="Texto puro"><?php if($Mensaje3 != ""){ echo $Mensaje3;} ?></textarea>
                </div>
            
                <div class="columna1">
                  <label>Tipo de Correos:</label>
                </div>

                <div class="columna2">
                  <select name="listbox" size=1>
                    <?php 
                      switch($CodigoMensaje){
                        case 1:
                          echo "<option value=1>Registro</option>";
                          break;
                        case 2:
                          echo "<option value=2>Matricula</option>";
                          break;
                        case 3:
                          echo "<option value=3>Resultado</option>";
                          break;
                        case 4: 
                          echo "<option value=4>Final de Examen</option>";
                          break;
                        default:
                          break;
                      }
                    ?>
                    <option value=1>Registro</option>
                    <option value=2>Matricula</option>
                    <option value=3>Resultado</option>
                    <option value=4>Final de Examen</option>
                  </select>
                </div>
              </div>
              <button  type="submit" name="btn" class="posicionDerecha" value="1">Guardar</button>
              <button  type="submit" name="btn" class="posicionDerecha" value="2">Cargar</button>
         
            </form>
          </div>
        </div>
      </div>
      <?php include 'error.php';?>
    </div>
  </body>

</html>