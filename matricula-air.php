<?php 
  session_start();
  include 'Base.php';
  include '_menu.php';
  date_default_timezone_set("America/Costa_Rica");
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
      var d = new Date();
      var eventDates = [23];
      var eventMonths = [6,7,8,9];
      $(document).ready(function(){
        $("#fechaMatricula").datepicker({
          inline: true,
          language: 'es',
          minDate: new Date(),
          onRenderCell: function(date, cellType){
            var currentDate = date.getDate();
            var currentMonth = date.getMonth();
            if (cellType == 'day' && (eventDates.indexOf(currentDate) != -1)) {
              if(celltype)
              return {
                  html: currentDate + '<span class="fechaexamen"></span>'
              }
            }
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
          <?php
          /*
          <?php 
        $con = conectar();
        $sql = "CALL PruebasDisponibles('".date("Y-m-d H:i:s")."');";
        //Año, Día, Mes, Hora, Minuto, Segundo
        $respuesta = $con->query($sql);
        //saca datos desde la base.
        if($respuesta->num_rows > 0){  
          while($fila = $respuesta->fetch_assoc()){
      ?>
            fechasH(<?php echo $fila['Mes']; ?>) =<?php echo "\"".$fila['A']."-".$fila['Mes']."-".$fila['D']." ".$fila['H'].":".$fila['Min'].":".$fila['S']."\";"; ?>
      <?php
          }
        }
        $con->close();
      ?>*/
          ?>
        </div>
      </div>
    </div>
  </body>

</html>
