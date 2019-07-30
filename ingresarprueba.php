<?php 
    session_start();
    date_default_timezone_set("America/Costa_Rica");
    include 'Base.php';
    include '_menu.php';
    $con = conectar();
    if(isset($_POST['token'])){
        $sql = "Call IngresoPrueba(".$_SESSION['usuario'].",'".$_POST['token']."','".date("Y-m-d H:i:s")."')";
        if($respuesta = $con->query($sql)){
          $fila = $respuesta->fetch_assoc();
          if($fila['examen'] != 0){
            $_SESSION['prueba'] = $fila['examen'];
            $_SESSION['mensaje'] = "Tiquete correcto";
            $_SESSION['tipoerror'] = 0;
            header("Location: prueba.php");
          } else {
            $_SESSION['mensaje'] = "Tiquete o hora incorrecta";
            $_SESSION['tipoerror'] = 1;
          }
          $con->close();
        } else {
          $_SESSION['mensaje'] = "Error de conexión. Favor intentarlo más tarde";
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

        <!--Login-->
        <div>
          <form action="ingresarprueba.php" method="post">
            <div>
              <h1>Iniciar Examen</h1>
              <div class="columna1">
                <label>Tiquete</label>
              </div>
              <div class="columna2">
                <input type="text" name="token" />
              </div>
            </div>
            <button type="submit" class="posicionDerecha ">Iniciar Prueba</button>
          </form>
        </div>
      </div>
    </div>
    <?php include 'error.php';?>
  </div>
</body>

</html>