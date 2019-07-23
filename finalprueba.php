<?php 
  session_start();
  if(!isset($_SESSION['prueba'])){
    header("Location: ingresarprueba.php");
  }
  include 'Base.php';
  include '_menu.php';
  date_default_timezone_set("America/Costa_Rica");
  $siguiente = false;
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
          <?php barraUsuario(); ?>
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
            <?php menu(); ?>
          </ul>
        </div>
      </menu>

      <!--Contenido -->
      <div class="contenido">
        <?php 
          $con = conectar();
          $sql = "Call NombreCorreo(". $_SESSION['usuario'] .");";
          $respuesta = $con->query($sql);
          $fila = $respuesta->fetch_assoc();
        ?>
        <!--Instrucciones de la prueba -->
        <div class="instrucciones">
          <h1>Gracias por realizar la prueba <?php echo $fila['Nombre']." ".$fila['Apellido1']." ".$fila['Apellido2']; ?></h1>
          <ul>
            <li>Los resultados serán eviados por medio del correo: <?php echo $fila['Correo']; ?></li>
            <li>Estos serán enviados una vez que todas las pruebas sean evaluadas.</li>
            <li>Se tarda un plazo mínimo de una semana despues del <?php echo date("d-m-Y"); ?></li>
            <li>En el caso que el correo previamente mencionado se encuentre incorrecto 
              o desactualizado por favor cambiarlo lo mas antes posible. </li>
          </ul>
        </div>
      </div>
    </div>
  </body>

</html>

<?php 
  unset($_SESSION['prueba']);
?>