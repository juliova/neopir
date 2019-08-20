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
  if(isset($_POST['btn'])){
    $con = conectar();
    $sql = "CALL Modvariables(".$_POST['cupo'].",".$_POST['pruebas'].",".
                                $_POST['intentos'].",".$_POST['duracion'].",".$_POST['preguntas'].");";
    if($respuesta = $con->query($sql)){
        $_SESSION['mensaje'] = "Modificación exitosa";
        $_SESSION['tipoerror'] = 0;
    } else {
        $_SESSION['mensaje'] = "Error de conexión. Favor intentarlo más tarde";
        $_SESSION['tipoerror'] = 1;
    }
    $con->close();
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
        <form action="variables.php" method="post" >
        
        <div class="seccionMedia">
          <?php
            $cupo = 0;
            $pruebas = 0;
            $intentos = 0;
            $duracion = 0;
            $preguntas = 0;
            $con = conectar();
            $sql = "CALL variables();";
            if($respuesta = $con->query($sql)){
                $fila = $respuesta->fetch_assoc();
                $cupo      = $fila['MaximoCupo'];
                $pruebas   = $fila['MaximoPruebasxMes'];
                $intentos  = $fila['MaximoIntentos'];
                $duracion  = $fila['DuracionPrueba'];
                $preguntas = $fila['PreguntasxVista'];
                $correo    = $fila['correoSmtp'];
                $host      = $fila['hostSmtp'];
                $seguridad = $fila['seguridadSmtp'];
                $contraseña= $fila['contraSmtp'];
                $puerto    = $fila['puertoSmtp'];
            } else {
                $_SESSION['mensaje'] = "Error de conexión. Favor intentarlo más tarde";
                $_SESSION['tipoerror'] = 1;
            }
            $con->close();
          ?>
          <!--Login-->
          <div>
            <div>
              <h1>Pruebas</h1>
              <div class="columna1">
              <label>Cupo Máximo</label>
              </div>
              <div class="columna2">
              <input type="number" name="cupo" value="<?php echo $cupo; ?>" required/>
              </div>
              <div class="columna1">
              <label># por mes</label>
              </div>
              <div class="columna2">
              <input type="number" name="pruebas" value="<?php echo $pruebas; ?>" required/>
              </div>
              <div class="columna1">
              <label># de intentos</label>
              </div>
              <div class="columna2">
              <input type="number" name="intentos" value="<?php echo $intentos; ?>" required/>
              </div>
              <div class="columna1">
              <label># de Horas</label>
              </div>
              <div class="columna2">
              <input type="number" name="duracion" value="<?php echo $duracion; ?>" required/>
              </div>
              
            </div>
            <button type="submit" name="btn" class="seccionMedia">Modificar</button>
          </div>
          <div>
            <div>
              <h1>Envío de correos</h1>
              <div class="columna1">
              <label>Correo</label>
              </div>
              <div class="columna2">
              <input type="text" name="correo" value="<?php echo $correo ; ?>" required/>
              </div>
              <div class="columna1">
              <label>Host</label>
              </div>
              <div class="columna2">
              <input type="text" name="host" value="<?php echo $host; ?>" required/>
              </div>
              <div class="columna1">
              <label>Seguridad</label>
              </div>
              <div class="columna2">
              <input type="text" name="seguridad" value="<?php echo $seguridad; ?>" required/>
              </div>
              <div class="columna1">
              <label>Contraseña</label>
              </div>
              <div class="columna2">
              <input type="text" name="contraseña" value="<?php echo $contraseña; ?>" required/>
              </div>
              <div class="columna1">
              <label>Puerto</label>
              </div>
              <div class="columna2">
              <input type="number" name="puerto" value="<?php echo $puerto; ?>" required/>
              </div>
            </div>
            <button type="submit" name="btn" class="seccionMedia">Modificar</button>
          </div>
          <div>
            <div>
              <h1>Preguntas</h1>
              <div class="columna1">
              <label># por vista</label>
              </div>
              <div class="columna2">
              <input type="number" name="preguntas" value="<?php echo $preguntas; ?>" required/>
              </div>
            </div>
            <button type="submit" name="btn" class="seccionMedia">Modificar</button>
          </div>
        </div>
      </form>
    </div>
    <?php include 'error.php'; ?>
    </div>
  </body>
</html>
