<?php
  session_start();
  include 'Base.php';
  include '_menu.php';
  $con = conectar();
  date_default_timezone_set("America/Costa_Rica");
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
        <!--Instrucciones de la prueba 
        <div class="instrucciones">
          <h1>Instrucciones</h1>
          <ul>
            <li>
              En esta ventana puede determinar la fecha y hora en que se realizaran las pruebas.
            </li>
            <li>
              Primero seleccione la fecha en que quiera que se realize la prueba.
            </li>
            <li>
              Determine la hora en que se realizara la prueba.
            </li>
            <li>
              Al terminar de ingresar estos datos pulse el boton "AGREGAR".
            </li>
          </ul>
        </div>-->

        <!--Ingreso de datos -->
        <div class="seccionMedia">
          <div>
            <form method="POST" action="fechaprueba.php">
              <h1>Agregar Prueba</h1>
              <div class="columna1">
                <label>Fecha prueba:</label>
              </div>
              <div class="columna2">
                <input type="date" name="fecha" required />
              </div>
              <div class="columna1">
                <label>Hora prueba:</label>
              </div>
              <div class="columna2">
                <input type="time" name="hora" required />
              </div>
              <button class="seccionMedia" type="submit" name="insert" value ="Agregar">Agregar</button>
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
                <tr>
                  <td><?php echo date("d/m/Y  h:i:s A",strtotime($fila['Fechar'])); ?></td>
                  <td><?php echo date("d/m/Y  h:i:s A",strtotime($fila['fechaF'])); ?></td>
                  <td>
                    <button class="aprobado" onclick="window.location.href='modfecha.php?prueba=<?php echo $fila['IDPrueba']; ?>';">Modificar</button>
                    <?php if($fila['Fechar']>date("Y-m-d H:i:s")) {?>
                    <button class="rechazado" onclick="window.location.href='eliminarfecha.php?prueba=<?php echo $fila['IDPrueba']; ?>';">Eliminar</button>
                    <?php } ?>
                  </td>
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
	
	<?php
	if(isset($_POST ['insert'])){
    $con = conectar();
		$fecha = $_POST['fecha'];
    $hora = $_POST['hora'];
    $fechaf =date ($fecha ." ".$hora);
    $sql = "CALL variables();";
    $sumahoras = 2;
    if($respuesta = $con->query($sql)){
      $fila = $respuesta->fetch_assoc();
      $sumahoras = $fila['DuracionPrueba'];
    }
    $con->close();
    $con = conectar();
    $fechaFinal=date("Y/m/d H:i",strtotime($fechaf."+ ".$sumahoras." hour"));
		$consulta = "SELECT * from prueba";
		$fechaComoEntero = strtotime($fechaf);
		$anio = date("Y", $fechaComoEntero);
		$mes = date("m", $fechaComoEntero);
    $ciclo =mysqli_query($con,$consulta);
    $i = 0;
    $Paso = false;
	  while($fila = mysqli_fetch_array($ciclo)){
  	  $fechap = $fila['Fechar'];
      $fechaEntero = strtotime($fechap);
      $annio = date("Y", $fechaEntero);
      $mess = date("m", $fechaEntero);
      if($fechaf > $fechap and !($annio==$anio and $mess ==$mes))
      {

      }else
      {
        $Paso = true;
      }
		  $i++;
	  }        

		$i++;
		if($Paso){
      $_SESSION['mensaje'] = "La fecha que se ingreso no es correcta";
      $_SESSION['tipoerror'] = 1;
		}
		else{
			$insertar ="INSERT INTO prueba (Fechar,fechaF) VALUES ('$fechaf','$fechaFinal')";

			$ejecutar = mysqli_query($con,$insertar);
      if($ejecutar){
        $_SESSION['mensaje'] = "Fecha creada";
        $_SESSION['tipoerror'] = 0;
      }
		}
  }				
?>	
  <?php include "error.php"; ?>
  </body>

</html>
