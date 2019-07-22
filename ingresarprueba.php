<?php 
    session_start();
    include 'Base.php';
    $con = conectar();
    $error = false;
    if(isset($_POST['token'])){
        $sql = "";
        $respuesta = $con->query($sql);
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
  <?php //alerta de error. 
    
  ?>
</head>

<body>
  <div class="barraUsuario">
    <div class="contenedor">
      <ul>
        <li>
          <a href="login.html">registro</a>
        </li>
        <li>
          <a href="login.html">iniciar sesión</a>
        </li>
      </ul>
    </div>
  </div>
  <div class="contenedor">
    <menu>
      <img class="logo" src="img/logo-blanco-64.png" />

      <i class="fas fa-bars"></i>
      <div>
        <ul>
          <li>
            <a href="index.html">inicio</a>
          </li>
          <li>
            <a href="prueba.html">prueba</a>
          </li>
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
                <label>Token</label>
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