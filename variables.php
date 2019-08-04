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
        <div class="instrucciones">
          <h1>Guía</h1>
          <ul>
            <li>
              Cupo Máximo: Cantidad total de aplicantes posibles por prueba.
            </li>
            <li>
              Cant. Pruebas: Cantidad total de pruebas por mes.
            </li>
            <li>
              Cant. Intentos: Cantidad de veces que el paciente puede realizar la prueba.
            </li>
            <li>
              Horas x prueba: Cantidad de horas que dura la prueba.
            </li>
            <li>
              Cant. Preguntas: Cantidad de preguntas mostradas al paciente por página.
            </li>
          </ul>
        </div>
        <div class="seccionMedia">
            <!--Login-->
            <div>
                <form action="variables.php" method="post" >
                    <div>
                        <h1>Variables</h1>
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
                            } else {
                                $_SESSION['mensaje'] = "Error de conexión. Favor intentarlo más tarde";
                                $_SESSION['tipoerror'] = 1;
                            }
                            $con->close();
                        ?>
                        <div class="columna1">
                        <label>Cupo Máximo</label>
                        </div>
                        <div class="columna2">
                        <input type="number" name="cupo" value="<?php echo $cupo; ?>" required/>
                        </div>
                        <div class="columna1">
                        <label>Cant Pruebas</label>
                        </div>
                        <div class="columna2">
                        <input type="number" name="pruebas" value="<?php echo $pruebas; ?>" required/>
                        </div>
                        <div class="columna1">
                        <label>Cant. Intentos</label>
                        </div>
                        <div class="columna2">
                        <input type="number" name="intentos" value="<?php echo $intentos; ?>" required/>
                        </div>
                        <div class="columna1">
                        <label>Horas x prueba</label>
                        </div>
                        <div class="columna2">
                        <input type="number" name="duracion" value="<?php echo $duracion; ?>" required/>
                        </div>
                        <div class="columna1">
                        <label>Cant. Preguntas</label>
                        </div>
                        <div class="columna2">
                        <input type="number" name="preguntas" value="<?php echo $preguntas; ?>" required/>
                        </div>
                    </div>
                    <button type="submit" name="btn" class="seccionMedia">Modificar</button>
                </form>
            </div>
        </div>
      </div>
      <?php include 'error.php'; ?>
    </div>
  </body>

</html>
