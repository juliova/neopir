<?php
  session_start();
  include 'Base.php';
  include '_menu.php';
  $con = conectar();
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
        <!--Instrucciones de la prueba -->
        <div class="instrucciones">
          <h1>Instrucciones</h1>
          <ul>
            <li>
              En esta ventana puede determinar la fecha y hora en que se realizaran las pruebas.
            </li>

            <li>
              Primero seleccione la fecha en que quiera que se realize la prueba en este formato DIA/MES/AÑO.
            </li>
            <li>
              Determine la hora en que se realizara la prueba en este formato HORA/MINUTOS.
            </li>
            <li>
              Seleccione el tipo de hora que requiera AM o PM.
            </li>
            <li>
              Al terminar de ingresar estos datos pulse el boton "GUARDAR".
            </li>
          </ul>
        </div>

        <!--Ingreso de datos -->
        <div class="seccionMedia">

          <!--contenedor para el calendario-->
          <div>
            <form method="POST" action="fechaprueba.php">
              <div class="columna1">
                <label>Fecha prueba:</label>
              </div>
              <div class="columna2">
                <input type="text" name="fecha" />
              </div>
              <div class="columna1">
                <label>Hora prueba:</label>
              </div>
              <div class="columna2">
                <input type="time" name="hora" value="12:00" />
              </div>
              <!--
              <label class="contenedorRadioCheck" id="am">AM
                <input type="radio" name="radio">
                <span class="radioCheck check"></span>
              </label>
              <label class="contenedorRadioCheck" id="pm">PM
                <input type="radio" name="radio">
                <span class="radioCheck check"></span>
              </label>-->
                <button type="submit" name="insert" value ="Agregar">Agregar</button>
            </form>
            
          </div>

        </div>
      </div>
    </div>
	
	<?php
	if(isset($_POST ['insert'])){
		$fecha = $_POST['fecha'];
		$hora = $_POST['hora'];
		$fechaf =date ($fecha ."".$hora);
		$fechaFinal=date("Y/d/m H:i",strtotime($fechaf."+ 2 hour"));
		$consulta = "SELECT * from prueba";

    $ciclo =mysqli_query($con,$consulta);
    $i = 0;
    $Paso = false;
    while($fila = mysqli_fetch_array($ciclo)){
    $fechap = $fila['Fechar'];
    
    if($fechaf > $fechap)
    {

    }else
      {
        $Paso = true;
    }
      $i++;
    }        

      $i++;
      echo $i;
      if($Paso){
        //echo "La fecha ya paso";
        $_SESSION['mensaje'] = "La fecha ya paso";
        $_SESSION['tipoerror'] = 1;
      }
      else{
        $insertar ="INSERT INTO prueba (IDPrueba,Fechar,fechaF) VALUES ($i,'$fechaf','$fechaFinal')";

        $ejecutar = mysqli_query($con,$insertar);
      if($ejecutar){
        $_SESSION['mensaje'] = "Fecha creada";
        $_SESSION['tipoerror'] = 0;
  }
      }
      }
      
				
?>	
  <?php include 'error.php'; ?>
  </body>

</html>