<?php 
    session_start();
    date_default_timezone_set("America/Costa_Rica");
    $_SESSION['usuario'] = 116360429;
    include 'Base.php';
    include '_menu.php';
    $con = conectar();
    $error = false;
    if(isset($_POST['token'])){
        $sql = "Call IngresoPrueba(".$_SESSION['usuario'].",'".$_POST['token']."','".date("Y-m-d H:i:s")."')";
        $respuesta = $con->query($sql);
        $fila = $respuesta->fetch_assoc();
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
    <script>
        <?php if($fila['examen']!=0) { ?>
            alert("Tiquete correcto.");
            window.location.href = "prueba.php";
        <?php } else { ?>
            alert("Error de tiquete o hora incorrecta.");
        <?php } ?>
    </script>
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
  </div>
</body>

</html>