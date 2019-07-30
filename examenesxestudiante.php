<?php if (substr_count($_SERVER["HTTP_ACCEPT_ENCODING"], "gzip")) { ob_start("ob_gzhandler"); } else { ob_start(); } ?>
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
    <?php
    if(isset($_GET['fecha'])){
      $_SESSION['fecha']=$_GET['fecha'];
    }
    $con = conectar();
    $sql = "CALL obtener_Examenes(".$_SESSION['fecha'].")";
    if($result = $con->query($sql)){
      ?>
      <table class="tablaB"><tr><th>IDENTIFICACIÓN</th><th>FECHA PRUEBA</th><th>ESTADO</th><th>Pruebas Realizadas</th><th>Tiquete</th></tr>
      <?php
       
      if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
          if(strcmp ($row["Estado"] ,"SIN REVISAR") == 0){ 
            ?>
            <tr class="norevisado" onClick=window.location.href='grafico.php?idfecha=<?php echo($_SESSION['fecha']);?>&idestudiante=<?php echo($row["IDEstudiante"]);?>'>
              <td><?php echo($row["IDEstudiante"]);?></td>
              <td><?php echo($row["Fechar"]);?></td>
              <td><?php echo($row["Estado"]);?></td>
              <td><?php echo($row["veces"]);?></td>
              <td><?php echo($row["Utilizada"]);?></td>
            </tr><?php
          }else{?>
            <tr class="revisado" onClick=window.location.href='grafico.php?idfecha=<?php echo($_SESSION['fecha']);?>&idestudiante=<?php echo($row["IDEstudiante"]);?>'>
              <td><?php echo($row["IDEstudiante"]);?></td>
              <td><?php echo($row["Fechar"]);?></td>
              <td><?php echo($row["Estado"]);?></td>
              <td><?php echo($row["veces"]);?></td>
              <td><?php echo($row["Utilizada"]);?></td>
            </tr><?php 
          }  
        } ?>
        </table> 
        <div class="flexCentro">
          <form method="post" action="examenesxestudiante.php">
            <button name="btn" type="submit">Formalizar Revisión</button>
          </form> 
        </div>
<?php
      } else { ?>

      <tr class='sindatos'><td>....</td></tr>
            </table> 
            <h1>SIN DATOS</h1>
            <div class='flexCentro'>
                <button onClick=window.location.href='examenesxfecha.php'>ATRAS Revisión</button>
            </div> 
            <?php
      }
    } else {
      echo "Error Base";
    }
    $con->close();
    ?>  
    </div>

  </div>
  <?php
    $con = conectar();
    if(isset($_POST['btn'])){
      $sql = "CALL formalizar(".$_SESSION['fecha'].")";
      if( $result = $con->query($sql)){
        $fila = $result->fetch_assoc();
        if($fila["Estado"] == 'FORMALIZADO')
        { ?>
          <script LANGUAGE='JavaScript'>
            alert('La prueba ha sido formalizada con exito');
            location.href='examenesxfecha.php';
          </script>
          <?php
        }else{ ?>
    
        <script type='text/javascript'>alert('No puede formalizar la prueba sin antes revisar todos los estudiantes');</script>
        <?php
      }
    } else {
      echo "Error Base Formalizar";
    }
    $con->close();
  }
  ?>
</body>
</html>