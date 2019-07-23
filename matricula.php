<?php 
  session_start();
  include 'Base.php';
  include '_menu.php';
  $exito = false;
  date_default_timezone_set("America/Costa_Rica");
  if(isset($_GET['prueba'])){
    $con = conectar();
    $sql = "Call Matricula(".$_GET['prueba'].",".$_SESSION['usuario'].");";
    $respuesta = $con->query($sql);
    if($respuesta->num_rows >0){
      $fila = $respuesta->fetch_assoc();
      mail($fila['Correo'],'Tiquete de ingreso a la prueba.',$fila['Mensaje2']);
      $exito = true;
    } else {  
      
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
    <link type="text/css" rel="stylesheet" href="css/datepicker.min.css" />
    <script src="js/jquery-3.4.1.min.js"></script>
    <script src="js/datepicker.min.js"></script>
    <script src="js/datepicker.es.js"></script>
    <script src="js/scripts.js"></script>
    <?php if($exito){  ?>
    <script> 
      alert("Matrícula realizada con éxito. El tiquete fué enviado al correo");
    </script>
    <?php } ?>
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
        <table class="tablaB">
          <tr>
            <th>Fecha Inicio</th>
            <th>Fecha Fin</th>
            <th>Campos disponible</th>
            <?php 
              $con = conectar();
              $sql = "CALL PruebasDisponibles('".date("Y-m-d H:i:s")."');";
              $respuesta = $con->query($sql);
              if($respuesta->num_rows > 0){  
                while($fila = $respuesta->fetch_assoc()){
                  ?>
                  <tr onclick="window.location.href='matricula.php?prueba=<?php echo $fila['IDPrueba']; ?>'">
                    <td><?php echo $fila['Fechar']; ?></td></a>
                    <td><?php echo $fila['fechaF']; ?></td></a>
                    <td><?php echo 20-$fila['cupo']; ?></td></a>
                  </tr>
                  <?php 
                }
              }
            ?>

          </tr>
        </table>
      </div>
    </div>
  </body>

</html>
