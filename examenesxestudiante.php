<?php if (substr_count($_SERVER["HTTP_ACCEPT_ENCODING"], "gzip")) { ob_start("ob_gzhandler"); } else { ob_start(); } ?>
<?php 
  session_start();
  include 'Base.php';
  include '_menu.php';
  include 'Correo.php';
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
     <div class="guiaTabla">
            <ul class="guiaGrafico">
              <li>
                Apto
                <div class="colorrevisado"></div>
              </li>
              <li>
                No Apto
                <div class="colornorevisado"></div>
              </li>
              <li>
                Por Revisar
                <div class="colorporrevisar"></div>
              </li>
            </ul>
       </div>

    <?php
    if(isset($_GET['fecha'])){
      $_SESSION['fecha']=$_GET['fecha'];
    }
    $con = conectar();
    $sql = "CALL obtener_Examenes(".$_SESSION['fecha'].")";
    if($result = $con->query($sql)){
      ?>
      <table class="tablaB"><tr><th>IDENTIFICACIÓN</th><th>Pruebas Realizadas</th><th>Aplico</th><th>Tiquete</th><th>FECHA PRUEBA</th><th>ESTADO</th><th>Genero</th></tr>
      <?php
       
      if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
             $con2=conectar();
          if(strcmp ($row["Estado"] ,"SIN REVISAR") == 0){ 
         
            if($veces=$con2->query("CALL veces(".$row["IDEstudiante"].")"))
            {
              $ves=$veces->fetch_assoc();
            ?>
            <tr class="porrevisar" onClick=window.location.href='grafico.php?idfecha=<?php echo($_SESSION['fecha']);?>&idestudiante=<?php echo($row["IDEstudiante"]);?>'>
              <td><?php echo($row["IDEstudiante"]);?></td>
              <td><?php echo($ves["veces"]);?></td>
              <td><?php echo($ves["Utilizada"]);?></td>
              <td><?php echo($row["Utilizada"]);?></td>
              <td><?php echo($row["Fechar"]);?></td>
              <td><?php echo($row["Estado"]);?></td>
              <td><?php echo($row["Genero"]);?></td>
    
            </tr><?php
            }
            
          }else{
            if(strcmp ($row["Estado"] ,"APTO"))
            {
             if($veces=$con2->query("CALL veces(".$row["IDEstudiante"].")"))
            
            {
               $ves=$veces->fetch_assoc();?>
            
             <tr class="revisado" onClick=window.location.href='grafico.php?idfecha=<?php echo($_SESSION['fecha']);?>&idestudiante=<?php echo($row["IDEstudiante"]);?>'>
             <td><?php echo($row["IDEstudiante"]);?></td>
              <td><?php echo($ves["veces"]);?></td>
              <td><?php echo($ves["Utilizada"]);?></td>
              <td><?php echo($row["Utilizada"]);?></td>
              <td><?php echo($row["Fechar"]);?></td>
              <td><?php echo($row["Estado"]);?></td>
              <td><?php echo($row["Genero"]);?></td>
            </tr><?php 
          } 
          }else{
            if($veces=$con2->query("CALL veces(".$row["IDEstudiante"].")"))
            
            {
               $ves=$veces->fetch_assoc();?>
            
             <tr class="norevisado" onClick=window.location.href='grafico.php?idfecha=<?php echo($_SESSION['fecha']);?>&idestudiante=<?php echo($row["IDEstudiante"]);?>'>
             <td><?php echo($row["IDEstudiante"]);?></td>
              <td><?php echo($ves["veces"]);?></td>
              <td><?php echo($ves["Utilizada"]);?></td>
              <td><?php echo($row["Utilizada"]);?></td>
              <td><?php echo($row["Fechar"]);?></td>
              <td><?php echo($row["Estado"]);?></td>
              <td><?php echo($row["Genero"]);?></td>
            </tr><?php 
          } 
        }
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
      $_SESSION['mensaje'] = "Error de conexión. Favor intentarlo más tarde";
      $_SESSION['tipoerror'] = 1;
    }
    $con->close();
    ?>  
    </div>

  </div>
  <?php
    $correo = conectar();
    $con = conectar();
    if(isset($_POST['btn'])){
    	$corr=0;
      $sql = "CALL formalizar(".$_SESSION['fecha'].")";
      if( $result = $con->query($sql)){
        $fila = $result->fetch_assoc();
        if($fila["Estado"] == 'FORMALIZADO')
        { 
          if($result =$correo->query("CALL correos_formalizar(".$_SESSION['fecha'].")"))
            {
              if ($result->num_rows > 0) {
                
                while($cor = $result->fetch_assoc()) {
                  $mail = iniciarCorreo();
                  try{
                    $mail->addAddress($cor['Correo']);
                    $mail->Subject = $cor['@asunto'];
                    $mail->Body = str_replace("{[resultado]}",$cor['Estado'],$cor['@html']);
                    $mail->AltBody = str_replace("{[resultado]}",$cor['Estado'],$cor['@texto']); 
                    $mail->send();
                    $corr=$corr + 0;
                  } catch (Exception $e){
                    $corr=1;
                  }	catch (\Exception $e){
                    $corr=1;
                  }
                }
                
                if( $corr==0 ){
                  $_SESSION['tipoerror'] = 0;
                  $_SESSION['mensaje'] = "La prueba ha sido formalizada con exito";
                  header("Location: examenesxfecha.php");
                }else{
                  $_SESSION['mensaje'] = "No pudieron enviar todos los correos debido a un fallo con el servidor. Intentelo mas tarde";
                  $_SESSION['tipoerror'] = 1;
                }
              }
            }
         }else{ 
          	$_SESSION['mensaje'] = "No puede formalizar la prueba sin antes revisar todos los estudiantes";
          	$_SESSION['tipoerror'] = 1;
      	}
    } else {
      $_SESSION['mensaje'] = "Error de conexión. Favor intentarlo más tarde";
      $_SESSION['tipoerror'] = 1;
    }
    $con->close();
  }
  ?>
  <?php include 'error.php'; ?>
</body>
</html>