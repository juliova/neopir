<?php 
  session_start();
  include 'Base.php';
  include '_menu.php';
  $exito = false;
  date_default_timezone_set("America/Costa_Rica");
  if(isset($_GET['prueba'])){
    $con = conectar();
    $sql = "Call Matricula(".$_GET['prueba'].",".$_SESSION['usuario'].");";
    if($respuesta = $con->query($sql)){
      $fila = $respuesta->fetch_assoc();
      mail($fila['Correo'],'Tiquete de ingreso a la prueba.',$fila['Mensaje2']." ".$fila['Token2'] );
      $exito = true;
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
        <div class="ficha" onclick="window.location.href='matricula.php?prueba=<?php echo 1; ?>'">
                <div class="head">
                  <?php echo "8 Mayo, 2019"; ?>
                </div>
                <div class="cuerpo">
                  <ul>
                    <li>Hora Inicio: <?php echo "2:00 pm"; ?></li>
                    <li>Hora Final : <?php echo "4:00 pm"; ?></li>
                    <li>Campos Disp: <?php echo 20-8; ?></li>
                  </ul>
                </div>
              </div>
        <?php 
          $con = conectar();
          $sql = "CALL PruebasDisponibles('".date("Y-m-d H:i:s")."');";
          if($respuesta = $con->query($sql)){
            while($fila = $respuesta->fetch_assoc()){
              ?>
              <div class="ficha" onclick="window.location.href='matricula.php?prueba=<?php echo $fila['IDPrueba']; ?>'">
                <div class="head">
                  <?php echo $fila['Fechar']; ?>
                </div>
                <div class="cuerpo">
                  <ul>
                    <li>Hora Inicio: <?php echo $fila['Fechar']; ?></li>
                    <li>Hora Final : <?php echo $fila['fechaF']; ?></li>
                    <li>Campos Disp: <?php echo 20-$fila['cupo']; ?></li>
                  </ul>
                </div>
              </div>
              <?php 
            }
          }
        ?>
      </div>
    </div>
  </body>

</html>
