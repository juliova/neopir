<?php if (substr_count($_SERVER["HTTP_ACCEPT_ENCODING"], "gzip")) { ob_start("ob_gzhandler"); } else { ob_start(); } ?>
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
        <li>
          <a href="login.html">registro</a>
        </li>
        <li>
          <a href="login.html">iniciar sesión</a>
        </li>
      </ul>
    </div>
  </div>
  <div class="contenedor">
    <menu>
      <img class="logo" src="img/logo-blanco-64.png" />

      <i class="fas fa-bars"></i>
      <div>
        <ul>
          <li>
            <a href="index.html">inicio</a>
          </li>
          <li>
            <a href="fechaprueba.html">fechas</a>
          </li>
          <li>
            <a href="preguntas.html">preguntas</a>
          </li>
          <li>
            <a href="calificacion.html">evaluación</a>
          </li>
          <li>
            <a href="tokens.html">Tokens</a>
          </li>
        </ul>
      </div>
    </menu>         
    <div class="contenido">
    <?php
    function Formalizar($conectar, $fechas)
    {   
             $sql = "CALL formalizar(".$fechas.")";
             $result = $conectar->query($sql);
             if($result["Estado"]='FORMALIZADO')
             {
               echo ("<script LANGUAGE='JavaScript'>
                    alert('La prueba ha sido formalizada con exito');
                    location.href='examenxfecha.php';
                </script>");
             }else{
              echo "<script type='text/javascript'>alert('No puede formalizar la prueba sin antes revisar todos los estudiantes');</script>";
            }
            $conectar->close();
    }

             $fecha=$_GET['fecha'];
             include 'Base.php';
             $con = conectar();
             $sql = "CALL obtener_fechas(".$fecha.")";
             $result = $con->query($sql);
             echo "<table class='tablaB'><tr><th>IDENTIFICACIÓN</th><th>FECHA PRUEBA</th><th>ESTADO</th></tr>";
             if ($result->num_rows > 0) {
              while($row = $result->fetch_assoc()) {
                  if(strcmp ($row["estadoestudiante.Estado"] ,"SIN REVISAR") == 0){ 
                       echo "<tr class='norevisado' onClick=window.location.href='examenesxestudiante?idfecha=".$fecha."&idestudiante=".$row["IDEstudiante"]."><td>" . $row["IDEstudiante"]."</td><td>" . $row["Fechar"]."</td> <td>".$row["estadoestudiante.Estado"]."</td></tr>";
                  }else{
                       echo "<tr class='revisado' onClick=window.location.href='examenesxestudiante?idfecha=".$fecha."&idestudiante=".$row["IDEstudiante"]."><td>" . $row["IDEstudiante"]."</td><td>" . $row["Fechar"]."</td> <td>".$row["estadoestudiante.Estado"]."</td></tr>";                  }  
              } 
            echo "</table> 
                   <div class='flexCentro'>
                             <button onclick=".Formalizar($con,$fecha).">Formalizar Revisión</button>
                   </div>";

                  } else { 

                   echo "<tr class='sindatos'><td>....</td></tr>
                        </table> 
                        <h1>SIN DATOS</h1>
                        <div class='flexCentro'>
                           <button onClick=window.location.href='examenesxfecha>ATRAS Revisión</button>
                        </div>";
      }
    $con->close();
  ?>  
    </div>
  </div>
</body>

</html>