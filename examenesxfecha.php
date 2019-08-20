<?php if (substr_count($_SERVER["HTTP_ACCEPT_ENCODING"], "gzip")) { ob_start("ob_gzhandler"); } else { ob_start(); } ?>
<?php 
  session_start();
  include 'Base.php';
  include '_menu.php';
  date_default_timezone_set("America/Costa_Rica");
  if(!isset($_SESSION['Rol'])){
    $_SESSION['mensaje'] = "Debe identificarse antes de continuar";
    $_SESSION['tipoerror'] = 1;
    header("Location: login.php");
  } else {
    if($_SESSION['Rol'] == 3){
      $_SESSION['mensaje'] = "No posee los permisos necesarios.";
      $_SESSION['tipoerror'] = 1;
      header("Location: index.php");
    }
  }
  date_default_timezone_set("America/Costa_Rica");
  $fechaini = date("Y")."-01-01";
  $fechafin = date("Y-m-d");
  if(isset($_POST["fechaini"])){
    $fechaini=$_POST["fechaini"];
  }
   if(isset($_POST["fechafin"])){
    $fechafin=$_POST["fechafin"];
  }
  if(isset($_GET["revisar"]))
  {
      $con = conectar();
      $sql = "CALL PuedoRevisar('".$_GET["fecha"]."')";
      if($result = $con->query($sql)){
        $row = $result->fetch_assoc();
        if($row["cantidad"]==0){
          header("Location: examenesxestudiante.php?fecha=".$_GET["id"]);
         }
         else{
          $_SESSION['mensaje'] = "Para poder revisar la  prueba del ".date("d/m/Y",strtotime($_GET["fecha"]))." debe de haber revisado y formalizado todas las pruebas anteriores";
          $_SESSION['tipoerror'] = 1;
         }
      }else{
        $_SESSION['mensaje'] = "Error de conexion.";
          $_SESSION['tipoerror'] = 1;
      }
      $con->close();
  }
?>
<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Revicion de examenenes</title>
  <link type="text/css" rel="stylesheet" href="css/estilo.css" />
  <link type="text/css" rel="stylesheet" href="css/all.css" />
  <script src="js/jquery-3.4.1.min.js"></script>
  <script src="js/datepicker.min.js"></script>
  <script src="js/datepicker.es.js"></script>
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
    <div class="seccionMedia">
          <div>
            <form action="examenesxfecha.php" method="post" >
            <h1>Filtro por fechas</h1>
              <div class="columna1">
                <label>Fecha Inicio</label>
              </div>
              <div class="columna2">
                <input type="date" name="fechaini" value="<?php echo $fechaini; ?>" required/>
              </div>
              <div class="columna1">
                <label>Fecha Fin</label>
              </div>
              <div class="columna2">
                <input type="date" readonly name="fechafin" value="<?php echo $fechafin; ?>" required/>
              </div>
              <button type="submit">Filtrar</button>
            </form>
          </div>
    </div>
    </br>
    <div class="guiaTabla">
            <ul class="guiaGrafico">
              <li>
                Formalizado
                <div class="colorrevisado"></div>
              </li>
              <li>
                Sin Formalizar
                <div class="colornorevisado"></div>
              </li>
            </ul>
    </div>
    <?php 
    
    

      $con = conectar();
      $sql = "CALL obtener_fechas('".$fechaini."','".date("Y-m-d h:i:s")."')";
      if($result = $con->query($sql)){
      ?> 
        <table class="tablaB" id="estudiantes"><tr><th>Fechas de Examenes realizados</th><th>Estudiantes que realizaron la prueba</th><th>Estado</th></tr>
        <?php
        if ($result->num_rows > 0) {
          while($row = $result->fetch_assoc()) {
            if(strcmp ($row["Estado"] ,"SIN REVISAR") == 0){  ?>
              <tr class="norevisado" onclick="window.location.href='examenesxfecha.php?fecha=<?php echo($row["Fechar"]);?>&revisar=1&id=<?php echo($row["IDPrueba"]);?>'">
              <td><?php echo(date("d/m/Y  h:i:s A", strtotime($row["Fechar"])));?></td>
              <td><?php echo($row["numestudiantes"]);?></td>
              <td><?php echo($row["Estado"]);?></td>
               </tr>
              <?php
            }else{?>
              <tr class="revisado" onclick="window.location.href='examenesxestudiante.php?fecha=<?php echo($row["IDPrueba"]);?>'">
              <td><?php echo(date("d/m/Y  h:i:s A", strtotime($row["Fechar"])));?></td>
              <td><?php echo($row["numestudiantes"]);?></td>
              <td><?php echo($row["Estado"]);?></td>
              </tr>
            <?php 
            }
          } ?>
          </table>
        <?php
        } else { ?>
          <tr class="sindatos">
          <td>....</td>
          <td>....</td>
          <td>....</td>
          </tr>
          </table>
          <h1>SIN DATOS</h1>" 
          <?php
        }
      } else {
        $_SESSION['mensaje'] = "Error de conexión. Favor intentarlo más tarde";
        $_SESSION['tipoerror'] = 1;
      }
      $con->close();
      ?>  
    </div>
    <?php include 'error.php'; ?>
  </div>
</body>

</html>