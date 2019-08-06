<?php
  session_start();
  include 'Base.php';
  include '_menu.php';
  date_default_timezone_set("America/Costa_Rica");
  $inicio = "";
  $fin ="";
	if(isset($_GET['prueba'])){
    $con = conectar();
    $sql = "SELECT Fechar, fechaF from prueba where IDPrueba = ".$_GET['prueba'].";";
    if($respuesta = $con->query($sql)){
      $fila = $respuesta->fetch_assoc();
      $inicio = $fila['Fechar'];
      $fin = $fila['fechaF'];
    }
	} else {
		header("Location: fechaprueba.php");
	}
?>

<!DOCTYPE html>
<html>
  <!--Cabeza con el estilo -->

  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Fechas</title>
    <link type="text/css" rel="stylesheet" href="css/estilo.css" />
    <link type="text/css" rel="stylesheet" href="css/all.css" />
    <link type="text/css" rel="stylesheet" href="css/datepicker.min.css" />
    <script src="js/jquery-3.4.1.min.js"></script>
    <script src="js/datepicker.min.js"></script>
    <script src="js/datepicker.es.js"></script>
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

        <!--Ingreso de datos -->
        <div class="seccionMedia">
          <div>
            <form method="POST" action="modfecha.php">
              <h1>Modificar Prueba</h1>
              <div class="columna1">
                <label>Formato</label>
              </div>
              <div class="columna2">
								<label> mes/dia/año</label>
							</div>
							<div class="columna1">
								<label>Fecha:</label>
							</div>
							<div class="columna2">
								<input type="date" name="fecha" required value="<?php echo date("Y-m-d",strtotime($inicio)); ?>"/>
							</div>
							<div class="columna1">
								<label>Hora inicio:</label>
							</div>
							<div class="columna2">
								<input type="time" name="horainicio" required  value="<?php echo $inicio; ?>"/>
              </div>
              <div class="columna1">
								<label>Hora fin:</label>
							</div>
							<div class="columna2">
								<input type="time" name="horafin" required  value="<?php echo $fin; ?>"/>
							</div>
							<button class="posicionDerecha" type="submit" name="btn" value ="1">Modificar</button>
            </form>
          </div>
        </div>
        <table class="tablaB">
          <tr>
            <th>Fecha Inicio</th>
            <th>Fecha Fin</th>
          </tr>
          <?php 
            $sql = "Call PruebasAno('".date("Y-m-d H:i:s")."');";
            if($respuesta = $con->query($sql)){
              while($fila = $respuesta->fetch_assoc()){
                ?>
                <tr onclick="window.location.href='modfecha.php?prueba=<?php echo $fila['IDPrueba']; ?>';">
                  <td><?php echo date("d/m/Y  h:i:s A",strtotime($fila['Fechar'])); ?></td>
                  <td><?php echo date("d/m/Y  h:i:s A",strtotime($fila['fechaF'])); ?></td>
                </tr>
                <?php
              }
            } else {
              $_SESSION['mensaje'] = "Error de conexión. Favor intentarlo de nuevo";
              $_SESSION['tipoerror'] = 1;
            }
            $con->close();
          ?>
        </table>
      </div>
    </div>
  <?php include "error.php"; ?>
  </body>

</html>
