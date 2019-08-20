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
            <th>Acción</th>
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
                    <button class="revisado" onclick="window.location.href='modfecha.php?prueba=<?php echo $fila['IDPrueba']; ?>';">Modificar</button>
                    <?php if($fila['Fechar']>date("Y-m-d H:i:s")) {?>
                    <button class="norevisado" onclick="window.location.href='eliminarfecha.php?prueba=<?php echo $fila['IDPrueba']; ?>';">Eliminar</button>
                    <?php } else { ?>
                    <button  disabled>Eliminar</button>
                    <?php
                    } ?> 
                  </td>
                </tr>
                <?php
              }
            } else {
              $_SESSION['mensaje'] = "Error de conexión. Favor intentarlo de nuevos";
              $_SESSION['tipoerror'] = 1;
            }
            $con->close();
          ?>
        </table>
      </div>
    </div>
	
	<?php
  if(isset($_POST ['insert'])){
    $fecha = $_POST['fecha'];
    $hora = $_POST['hora'];
    $fechaf =date ($fecha ."".$hora);
    $consulta = "SELECT * from prueba";
    $fechaComoEntero = strtotime($fechaf);
    $anio = date("Y", $fechaComoEntero);
    $mes = date("m", $fechaComoEntero);
    $fecha_actual=date("Y-m-d", time());
    $ciclo =mysqli_query($con,$consulta);
    $i = 0;
    $cupos = 0;
    $consultaHora = "SELECT DuracionPrueba, MaximoPruebasxMes from variables";
    $consultaCupos = "SELECT Fechar from prueba";
    $result = mysqli_query($con,$consultaHora);
    $result1 = mysqli_query($con,$consultaCupos);
    if ($result->num_rows > 0) {
      while($row = $result->fetch_assoc()) {	
        $horas=$row["DuracionPrueba"];
        $pruebasXmes=$row["MaximoPruebasxMes"];
      }
    }
    $fechaFinal=date("Y/m/d H:i",strtotime($fechaf."+ ". $horas . "hour"));

    if ($result1->num_rows > 0) {
      while($row1 = $result1->fetch_assoc()) {	
        $fechas=$row1["Fechar"];
        $fechaEntero = strtotime($fechas);
        $mess = date("m", $fechaEntero);
        $annio = date("Y", $fechaEntero);
        if($mess==$mes and $annio == $anio){
          $cupos++;
        }
        $i++;
      }
    }      
    $i++;
    if($fecha_actual>$fechaf or $cupos>=$pruebasXmes){
      $_SESSION['mensaje'] = "La fecha que se ingreso no es correcta";
      $_SESSION['tipoerror'] = 1;
    }
    else{
      $insertar ="INSERT INTO prueba (IDPrueba,Fechar,fechaF) VALUES ($i,'$fechaf','$fechaFinal')";
      $ejecutar = mysqli_query($con,$insertar);
      $_SESSION['mensaje'] = "La fecha se ingreso correctamente";
      $_SESSION['tipoerror'] = 0;
    }
  }

?>
  <?php include "error.php"; ?>
  </body>

</html>
