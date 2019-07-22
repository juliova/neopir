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
            include 'Base.php';
             $con = conectar();
             $sql = "CALL obtener_fechas()";
             $result = $con->query($sql);
             echo "<table class='tablaB' id='estudiantes'><tr><th>Fechas de Examenes realizados</th><th>Estudiantes que realizaron la prueba</th></tr>";
             if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                  if(strcmp ($row["Estado"] ,"SIN REVISAR") == 0){ 
                    echo "<tr class='norevisado' onclick='examenesxestudiante.php?fecha=".$row["IDPrueba"].";'><td>" . $row["Fechar"]."</td><td>" . $row["numestudiantes"]."</td></tr>";
                  }else{
                    echo "<tr class='revisado'  onclick='examenesxestudiante.php?fecha=".$row["IDPrueba"].";' ><td>" . $row["Fechar"]."</td><td>" . $row["numestudiantes"]."</td></tr>";
                  }  
              } 
            echo "</table>";
      } else { 
          echo "<tr class='sindatos'><td>....</td><td>....</td></tr>
          </table> 
               <h1>SIN DATOS</h1>";
      }
    $con->close();
  ?>  
    </div>
  </div>
</body>

</html>