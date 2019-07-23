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
    <link type="text/css" rel="stylesheet" href="css/estilo.css" />
    <link type="text/css" rel="stylesheet" href="css/all.css" />
    <link type="text/css" rel="stylesheet" href="css/datepicker.min.css" />
    <script src="js/jquery-3.4.1.min.js"></script>
    <script src="js/datepicker.min.js"></script>
    <script src="js/datepicker.es.js"></script>
    <script src="js/scripts.js"></script>
    <script>
        $(document).ready(function(){
          $("#fechaMatricula").datepicker({
              inline: true,
              language: 'es',
              minDate: new Date(),
              onSelect: function(fechaF,fecha,selector) {

              }
          });
        });
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
          <!--selector de fechas-->
          <div>
            <form action="matricula.php">
            <input type="text" id="fechaMatricula" readonly />
          </div>
        </div>
      </div>
    </div>
  </body>

</html>
