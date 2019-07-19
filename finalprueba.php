<?php 
  session_start();
  $siguiente = false;
  include 'Base.php';
  $con = conectar();
  if(isset($_SESSION['numPregunta'])){
    
  } else {
    $_SESSION['numPregunta'] = 1;
    $sql = "SELECT PreguntasxVista FROM variables;";
    $resultado = $con->query($sql);
    $fila = $resultado->fetch_assoc();
    $_SESSION['cantPreguntas'] = $fila['PreguntasxVista'];
  }
  if(isset($_POST['btn'])){
    switch ($_POST['btn']) {
      case 1: //Guardar
        $siguiente = true;
        break;
      case 2: //Siguiente
        if($_SESSION['numPregunta']>240){
          head("Location: finalprueba.php");
        }
        //ingcrementar numPregunta
        $_SESSION['numPregunta'] = $_SESSION['numPregunta'] + 20; 
        break;
    }
  } else {
    $_SESSION['numPregunta'] = 1;
  }
?>

<!DOCTYPE html>
<html>
  <!--Cabeza con el estilo -->

  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Prueba</title>
    <link type="text/css" rel="stylesheet" href="css/estilo.css" />
    <link type="text/css" rel="stylesheet" href="css/all.css" />
    <script src="js/jquery-3.4.1.min.js"></script>
    <script src="js/scripts.js"></script>
  </head>

  <!--Cuerpo -->

  <body>
    <!--Barra de Usuario con login -->
    <div class="barraUsuario">
      <div class="contenedor">
        <ul>
          <li>
            <a href="Login.html">registro</a>
          </li>
          <li>
            <a href="Login.html">iniciar sesión</a>
          </li>
        </ul>
      </div>
    </div>

    <!--Contenedor con el menu de logo, inicio,prueba y grafico -->
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

      <!--Contenido -->
      <div class="contenido">

        <!--Instrucciones de la prueba -->
        <div class="instrucciones">
            <p>Gracias por realizar la prueba</p>
        </div>
      </div>
    </div>
  </body>

</html>
