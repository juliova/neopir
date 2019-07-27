<?php 
  session_start();
  include 'Base.php';
  include '_menu.php';
?>
<!DOCTYPE html>
<html>

  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Inicio</title>
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
      <div class="contenido">
        <div class="imagen">

        </div>
        <h1>Requisitos</h1>
        <ol>
          <li>
            Estar registrado en el sitio.
          </li>
          <li>
            Haber realizado la validación mediante el tiquete enviado al correo con el cual se registró.
          </li>
          <li>
            Ser estudiante activo de la carrera de investigación criminal.
          </li>
          <li>
            Cancelar ₡9.300 de los aranceles en el Departamento Financiero.
          </li>
          <li>
            Presentar hoja de delincuencia al día.
          </li>
          <li>
            Cursar o haber llevado el curso de Balística en el Colegio Universitario de Cartago, presentar un borrador de notas que verifique este estado.
          </li>
          <li>
            1 fotocopia de la cédula de identidad
          </li>
          <li>
            Inscribirse en la secretaría de Bienestar estudiantil en las fechas establecidas en el planificador institucional
          </li>
          <li>
            Después de la aplicación de la prueba concertar cita para la entrevista y devolución del resultado, tiene duración de una hora.
          </li>
        </ol>
        <br>
        <br>
      </div>
      <?php include 'error.php';?>
    </div>
  </body>

</html>
