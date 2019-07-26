<?php if (substr_count($_SERVER["HTTP_ACCEPT_ENCODING"], "gzip")) { ob_start("ob_gzhandler"); } else { ob_start(); } ?>
<?php 
  session_start();
  include 'Base.php';
  include '_menu.php';
  if(isset($_GET["idfecha"]) && isset($_GET["idestudiante"])){
    $_SESSION["fecha"] = $_GET["idfecha"];
    $_SESSION["idestudiante"] = $_GET["idestudiante"];
  }
  
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Grafico General</title>
    <link type="text/css" rel="stylesheet" href="css/estilo.css" />
    <link type="text/css" rel="stylesheet" href="css/all.css" />
    <script src="js/jquery-3.4.1.min.js"></script>
    <script src="js/canvasjs.min.js"></script>
    <script languaje= 'Javascript'>
    <?php
      $con = conectar();
      $n1 = 0;
      $n2 = 0;
      $n3 = 0;
      $n4 = 0;
      $n5 = 0;
      $n6 = 0;
      $e1 = 0;
      $e2 = 0;
      $e3 = 0;
      $e4 = 0;
      $e5 = 0;
      $e6 = 0;
      $a1 = 0;
      $a2 = 0;
      $a3 = 0;
      $a4 = 0;
      $a5 = 0;
      $a6 = 0;
      $o1 = 0;
      $o2 = 0;
      $o3 = 0;
      $o4 = 0;
      $o5 = 0;
      $o6 = 0;
      $c1 = 0;
      $c2 = 0;
      $c3 = 0;
      $c4 = 0;
      $c5 = 0;
      $c6 = 0;
      $genero = 0;
      $resultado = 0; 
      $estado = 0;
      $total = 0;
      if(($n1 = $con->query("CALL obtener_grafico(".$_SESSION["idestudiante"].",'N1')")) &&
        ($n2 = $con->query("CALL obtener_grafico(".$_SESSION['idestudiante'].",'N2')")) &&
        ($n3 = $con->query("CALL obtener_grafico(".$_SESSION['idestudiante'].",'N3')")) &&
        ($n4 = $con->query("CALL obtener_grafico(".$_SESSION['idestudiante'].",'N4')")) &&
        ($n5 = $con->query("CALL obtener_grafico(".$_SESSION['idestudiante'].",'N5')")) &&
        ($n6 = $con->query("CALL obtener_grafico(".$_SESSION['idestudiante'].",'N6')")) &&
        ($e1 = $con->query("CALL obtener_grafico(".$_SESSION['idestudiante'].",'E1')")) &&
        ($e2 = $con->query("CALL obtener_grafico(".$_SESSION['idestudiante'].",'E2')")) &&
        ($e3 = $con->query("CALL obtener_grafico(".$_SESSION['idestudiante'].",'E3')")) &&
        ($e4 = $con->query("CALL obtener_grafico(".$_SESSION['idestudiante'].",'E4')")) &&
        ($e5 = $con->query("CALL obtener_grafico(".$_SESSION['idestudiante'].",'E5')")) &&
        ($e6 = $con->query("CALL obtener_grafico(".$_SESSION['idestudiante'].",'E6')")) &&
        ($a1 = $con->query("CALL obtener_grafico(".$_SESSION['idestudiante'].",'A1')")) &&
        ($a2 = $con->query("CALL obtener_grafico(".$_SESSION['idestudiante'].",'A2')")) &&
        ($a3 = $con->query("CALL obtener_grafico(".$_SESSION['idestudiante'].",'A3')")) &&
        ($a4 = $con->query("CALL obtener_grafico(".$_SESSION['idestudiante'].",'A4')")) &&
        ($a5 = $con->query("CALL obtener_grafico(".$_SESSION['idestudiante'].",'A5')")) &&
        ($a6 = $con->query("CALL obtener_grafico(".$_SESSION['idestudiante'].",'A6')")) &&
        ($o1 = $con->query("CALL obtener_grafico(".$_SESSION['idestudiante'].",'O1')")) &&
        ($o2 = $con->query("CALL obtener_grafico(".$_SESSION['idestudiante'].",'O2')")) &&
        ($o3 = $con->query("CALL obtener_grafico(".$_SESSION['idestudiante'].",'O3')")) &&
        ($o4 = $con->query("CALL obtener_grafico(".$_SESSION['idestudiante'].",'O4')")) &&
        ($o5 = $con->query("CALL obtener_grafico(".$_SESSION['idestudiante'].",'O5')")) &&
        ($o6 = $con->query("CALL obtener_grafico(".$_SESSION['idestudiante'].",'O6')")) &&
        ($c1 = $con->query("CALL obtener_grafico(".$_SESSION['idestudiante'].",'C1')")) &&
        ($c2 = $con->query("CALL obtener_grafico(".$_SESSION['idestudiante'].",'C2')")) &&
        ($c3 = $con->query("CALL obtener_grafico(".$_SESSION['idestudiante'].",'C3')")) &&
        ($c4 = $con->query("CALL obtener_grafico(".$_SESSION['idestudiante'].",'C4')")) &&
        ($c5 = $con->query("CALL obtener_grafico(".$_SESSION['idestudiante'].",'C5')")) &&
        ($c6 = $con->query("CALL obtener_grafico(".$_SESSION['idestudiante'].",'C6')")) &&
        ($genero = $con->query("CALL obtener_gener(".$_SESSION['idestudiante'].")")) &&
        ($resultado = $con->query("CALL obtener_resultados(".$_SESSION['idestudiante'].",".$_SESSION['fecha'].")")) &&
        ($estado = $con->query("CALL obtener_estado_examen(".$_SESSION['fecha'].")"))){
          $total = $resultado["N1"]+$resultado["N2"]+$resultado["N3"]+$resultado["N4"]+$resultado["N5"]+$resultado["N6"]+$resultado["E1"]+$resultado["E2"]+$resultado["E3"]+$resultado["E4"]+$resultado["E5"]+$resultado["E6"]+$resultado["A1"]+$resultado["A2"]+$resultado["A3"]+$resultado["A4"]+$resultado["A5"]+$resultado["A6"]+$resultado["O1"]+$resultado["O2"]+$resultado["O3"]+$resultado["O4"]+$resultado["O5"]+$resultado["O6"]+$resultado["C1"]+$resultado["C2"]+$resultado["C3"]+$resultado["C4"]+$resultado["C5"]+$resultado["C6"];
          ?>
            window.onload = function() {
              CanvasJS.addColorSet('coloresGrafico',
                '#0008E6'.
                '#00FFFF',
                '#7CAD00',
                '#FEA90D',
                '#fd5f00'
              ]);
              var grafico = new CanvasJS.Chart('grafico',
              {
                colorSet: 'coloresGrafico',
                title: { text: "<?php $genero["Genero"]?>"},
                animationEnabled: true,
                axisY: {
                maximum: 34,
                interval: 2
                },
                data: [
                  {
                    type: 'stackedColumn',
                    dataPoints:[
                      { y: <?php echo $n1["muybajo"]; ?>, label: 'N1'},
                      { y: <?php echo $n2["muybajo"]; ?>, label: 'N2'},
                      { y: <?php echo $n3["muybajo"]; ?>, label: 'N3'},
                      { y: <?php echo $n4["muybajo"]; ?>, label: 'N4'},
                      { y: <?php echo $n5["muybajo"]; ?>, label: 'N5'},
                      { y: <?php echo $n6["muybajo"]; ?>, label: 'N6'},
                      { y: <?php echo $e1["muybajo"]; ?>, label: 'E1'},
                      { y: <?php echo $e2["muybajo"]; ?>, label: 'E2'},
                      { y: <?php echo $e3["muybajo"]; ?>, label: 'E3'},
                      { y: <?php echo $e4["muybajo"]; ?>, label: 'E4'},
                      { y: <?php echo $e5["muybajo"]; ?>, label: 'E5'},
                      { y: <?php echo $e6["muybajo"]; ?>, label: 'E6'},
                      { y: <?php echo $o1["muybajo"]; ?>, label: 'O1'},
                      { y: <?php echo $o2["muybajo"]; ?>, label: 'O2'},
                      { y: <?php echo $o3["muybajo"]; ?>, label: 'O3'},
                      { y: <?php echo $o4["muybajo"]; ?>, label: 'O4'},
                      { y: <?php echo $o5["muybajo"]; ?>, label: 'O5'},
                      { y: <?php echo $o6["muybajo"]; ?>, label: 'O6'},
                      { y: <?php echo $a1["muybajo"]; ?>, label: 'A1'},
                      { y: <?php echo $a2["muybajo"]; ?>, label: 'A2'},
                      { y: <?php echo $a3["muybajo"]; ?>, label: 'A3'},
                      { y: <?php echo $a4["muybajo"]; ?>, label: 'A4'},
                      { y: <?php echo $a5["muybajo"]; ?>, label: 'A5'},
                      { y: <?php echo $a6["muybajo"]; ?>, label: 'A6'},
                      { y: <?php echo $c1["muybajo"]; ?>, label: 'C1'},
                      { y: <?php echo $c2["muybajo"]; ?>, label: 'C2'},
                      { y: <?php echo $c3["muybajo"]; ?>, label: 'C3'},
                      { y: <?php echo $c4["muybajo"]; ?>, label: 'C4'},
                      { y: <?php echo $c5["muybajo"]; ?>, label: 'C5'},
                      { y: <?php echo $c6["muybajo"]; ?>, label: 'C6'}
                    ]
                  },{
                    type: 'stackedColumn',
                    dataPoints:[
                      { y: <?php echo $n1["bajo"]?>, label: 'N1'},
                      { y: <?php echo $n2["bajo"]?>, label: 'N2'},
                      { y: <?php echo $n3["bajo"]?>, label: 'N3'},
                      { y: <?php echo $n4["bajo"]?>, label: 'N4'},
                      { y: <?php echo $n5["bajo"]?>, label: 'N5'},
                      { y: <?php echo $n6["bajo"]?>, label: 'N6'},
                      { y: <?php echo $e1["bajo"]?>, label: 'E1'},
                      { y: <?php echo $e2["bajo"]?>, label: 'E2'},
                      { y: <?php echo $e3["bajo"]?>, label: 'E3'},
                      { y: <?php echo $e4["bajo"]?>, label: 'E4'},
                      { y: <?php echo $e5["bajo"]?>, label: 'E5'},
                      { y: <?php echo $e6["bajo"]?>, label: 'E6'},
                      { y: <?php echo $o1["bajo"]?>, label: 'O1'},
                      { y: <?php echo $o2["bajo"]?>, label: 'O2'},
                      { y: <?php echo $o3["bajo"]?>, label: 'O3'},
                      { y: <?php echo $o4["bajo"]?>, label: 'O4'},
                      { y: <?php echo $o5["bajo"]?>, label: 'O5'},
                      { y: <?php echo $o6["bajo"]?>, label: 'O6'},
                      { y: <?php echo $a1["bajo"]?>, label: 'A1'},
                      { y: <?php echo $a2["bajo"]?>, label: 'A2'},
                      { y: <?php echo $a3["bajo"]?>, label: 'A3'},
                      { y: <?php echo $a4["bajo"]?>, label: 'A4'},
                      { y: <?php echo $a5["bajo"]?>, label: 'A5'},
                      { y: <?php echo $a6["bajo"]?>, label: 'A6'},
                      { y: <?php echo $c1["bajo"]?>, label: 'C1'},
                      { y: <?php echo $c2["bajo"]?>, label: 'C2'},
                      { y: <?php echo $c3["bajo"]?>, label: 'C3'},
                      { y: <?php echo $c4["bajo"]?>, label: 'C4'},
                      { y: <?php echo $c5["bajo"]?>, label: 'C5'},
                      { y: <?php echo $c6["bajo"]?>, label: 'C6'}
                    ]
                  },{
                    type: 'stackedColumn',
                    dataPoints:[
                      { y: <?php echo $n1["aceptable"];?>, label: 'N1'},
                      { y: <?php echo $n2["aceptable"];?>, label: 'N2'},
                      { y: <?php echo $n3["aceptable"];?>, label: 'N3'},
                      { y: <?php echo $n4["aceptable"];?>, label: 'N4'},
                      { y: <?php echo $n5["aceptable"];?>, label: 'N5'},
                      { y: <?php echo $n6["aceptable"];?>, label: 'N6'},
                      { y: <?php echo $e1["aceptable"];?>, label: 'E1'},
                      { y: <?php echo $e2["aceptable"];?>, label: 'E2'},
                      { y: <?php echo $e3["aceptable"];?>, label: 'E3'},
                      { y: <?php echo $e4["aceptable"];?>, label: 'E4'},
                      { y: <?php echo $e5["aceptable"];?>, label: 'E5'},
                      { y: <?php echo $e6["aceptable"];?>, label: 'E6'},
                      { y: <?php echo $o1["aceptable"];?>, label: 'O1'},
                      { y: <?php echo $o2["aceptable"];?>, label: 'O2'},
                      { y: <?php echo $o3["aceptable"];?>, label: 'O3'},
                      { y: <?php echo $o4["aceptable"];?>, label: 'O4'},
                      { y: <?php echo $o5["aceptable"];?>, label: 'O5'},
                      { y: <?php echo $o6["aceptable"];?>, label: 'O6'},
                      { y: <?php echo $a1["aceptable"];?>, label: 'A1'},
                      { y: <?php echo $a2["aceptable"];?>, label: 'A2'},
                      { y: <?php echo $a3["aceptable"];?>, label: 'A3'},
                      { y: <?php echo $a4["aceptable"];?>, label: 'A4'},
                      { y: <?php echo $a5["aceptable"];?>, label: 'A5'},
                      { y: <?php echo $a6["aceptable"];?>, label: 'A6'},
                      { y: <?php echo $c1["aceptable"];?>, label: 'C1'},
                      { y: <?php echo $c2["aceptable"];?>, label: 'C2'},
                      { y: <?php echo $c3["aceptable"];?>, label: 'C3'},
                      { y: <?php echo $c4["aceptable"];?>, label: 'C4'},
                      { y: <?php echo $c5["aceptable"];?>, label: 'C5'},
                      { y: <?php echo $c6["aceptable"];?>, label: 'C6'}
                    ]
                  },{
                    type: 'stackedColumn',
                    dataPoints:[
                      { y: <?php echo $n1["alto"]?>, label: 'N1'},
                      { y: <?php echo $n2["alto"]?>, label: 'N2'},
                      { y: <?php echo $n3["alto"]?>, label: 'N3'},
                      { y: <?php echo $n4["alto"]?>, label: 'N4'},
                      { y: <?php echo $n5["alto"]?>, label: 'N5'},
                      { y: <?php echo $n6["alto"]?>, label: 'N6'},
                      { y: <?php echo $e1["alto"]?>, label: 'E1'},
                      { y: <?php echo $e2["alto"]?>, label: 'E2'},
                      { y: <?php echo $e3["alto"]?>, label: 'E3'},
                      { y: <?php echo $e4["alto"]?>, label: 'E4'},
                      { y: <?php echo $e5["alto"]?>, label: 'E5'},
                      { y: <?php echo $e6["alto"]?>, label: 'E6'},
                      { y: <?php echo $o1["alto"]?>, label: 'O1'},
                      { y: <?php echo $o2["alto"]?>, label: 'O2'},
                      { y: <?php echo $o3["alto"]?>, label: 'O3'},
                      { y: <?php echo $o4["alto"]?>, label: 'O4'},
                      { y: <?php echo $o5["alto"]?>, label: 'O5'},
                      { y: <?php echo $o6["alto"]?>, label: 'O6'},
                      { y: <?php echo $a1["alto"]?>, label: 'A1'},
                      { y: <?php echo $a2["alto"]?>, label: 'A2'},
                      { y: <?php echo $a3["alto"]?>, label: 'A3'},
                      { y: <?php echo $a4["alto"]?>, label: 'A4'},
                      { y: <?php echo $a5["alto"]?>, label: 'A5'},
                      { y: <?php echo $a6["alto"]?>, label: 'A6'},
                      { y: <?php echo $c1["alto"]?>, label: 'C1'},
                      { y: <?php echo $c2["alto"]?>, label: 'C2'},
                      { y: <?php echo $c3["alto"]?>, label: 'C3'},
                      { y: <?php echo $c4["alto"]?>, label: 'C4'},
                      { y: <?php echo $c5["alto"]?>, label: 'C5'},
                      { y: <?php echo $c6["alto"]?>, label: 'C6'}
                    ]
                  },{
                    type: 'stackedColumn',
                    dataPoints:[
                      { y: <?php echo $n1["muyalto"]?>, label: 'N1'},
                      { y: <?php echo $n2["muyalto"]?>, label: 'N2'},
                      { y: <?php echo $n3["muyalto"]?>, label: 'N3'},
                      { y: <?php echo $n4["muyalto"]?>, label: 'N4'},
                      { y: <?php echo $n5["muyalto"]?>, label: 'N5'},
                      { y: <?php echo $n6["muyalto"]?>, label: 'N6'},
                      { y: <?php echo $e1["muyalto"]?>, label: 'E1'},
                      { y: <?php echo $e2["muyalto"]?>, label: 'E2'},
                      { y: <?php echo $e3["muyalto"]?>, label: 'E3'},
                      { y: <?php echo $e4["muyalto"]?>, label: 'E4'},
                      { y: <?php echo $e5["muyalto"]?>, label: 'E5'},
                      { y: <?php echo $e6["muyalto"]?>, label: 'E6'},
                      { y: <?php echo $o1["muyalto"]?>, label: 'O1'},
                      { y: <?php echo $o2["muyalto"]?>, label: 'O2'},
                      { y: <?php echo $o3["muyalto"]?>, label: 'O3'},
                      { y: <?php echo $o4["muyalto"]?>, label: 'O4'},
                      { y: <?php echo $o5["muyalto"]?>, label: 'O5'},
                      { y: <?php echo $o6["muyalto"]?>, label: 'O6'},
                      { y: <?php echo $a1["muyalto"]?>, label: 'A1'},
                      { y: <?php echo $a2["muyalto"]?>, label: 'A2'},
                      { y: <?php echo $a3["muyalto"]?>, label: 'A3'},
                      { y: <?php echo $a4["muyalto"]?>, label: 'A4'},
                      { y: <?php echo $a5["muyalto"]?>, label: 'A5'},
                      { y: <?php echo $a6["muyalto"]?>, label: 'A6'},
                      { y: <?php echo $c1["muyalto"]?>, label: 'C1'},
                      { y: <?php echo $c2["muyalto"]?>, label: 'C2'},
                      { y: <?php echo $c3["muyalto"]?>, label: 'C3'},
                      { y: <?php echo $c4["muyalto"]?>, label: 'C4'},
                      { y: <?php echo $c5["muyalto"]?>, label: 'C5'},
                      { y: <?php echo $c6["muyalto"]?>, label: 'C6'}
                    ]
                  },{
                    color: 'black',
                    type: 'line',
                    dataPoints:[
                      { y: <?php echo $resultado["N1"]?>, label: 'N1'},
                      { y: <?php echo $resultado["N2"]?>, label: 'N2'},
                      { y: <?php echo $resultado["N3"]?>, label: 'N3'},
                      { y: <?php echo $resultado["N4"]?>, label: 'N4'},
                      { y: <?php echo $resultado["N5"]?>, label: 'N5'},
                      { y: <?php echo $resultado["N6"]?>, label: 'N6'},
                      { y: <?php echo $resultado["E1"]?>, label: 'E1'},
                      { y: <?php echo $resultado["E2"]?>, label: 'E2'},          
                      { y: <?php echo $resultado["E3"]?>, label: 'E3'},
                      { y: <?php echo $resultado["E4"]?>, label: 'E4'},
                      { y: <?php echo $resultado["E5"]?>, label: 'E5'},
                      { y: <?php echo $resultado["E6"]?>, label: 'E6'},
                      { y: <?php echo $resultado["O1"]?>, label: 'O1'},
                      { y: <?php echo $resultado["O2"]?>, label: 'O2'},
                      { y: <?php echo $resultado["O3"]?>, label: 'O3'},
                      { y: <?php echo $resultado["O4"]?>, label: 'O4'},
                      { y: <?php echo $resultado["O5"]?>, label: 'O5'},
                      { y: <?php echo $resultado["O6"]?>, label: 'O6'},
                      { y: <?php echo $resultado["A1"]?>, label: 'A1'},
                      { y: <?php echo $resultado["A2"]?>, label: 'A2'},
                      { y: <?php echo $resultado["A3"]?>, label: 'A3'},
                      { y: <?php echo $resultado["A4"]?>, label: 'A4'},
                      { y: <?php echo $resultado["A5"]?>, label: 'A5'},
                      { y: <?php echo $resultado["A6"]?>, label: 'A6'},
                      { y: <?php echo $resultado["C1"]?>, label: 'C1'},
                      { y: <?php echo $resultado["C2"]?>, label: 'C2'},
                      { y: <?php echo $resultado["C3"]?>, label: 'C3'},
                      { y: <?php echo $resultado["C4"]?>, label: 'C4'},
                      { y: <?php echo $resultado["C5"]?>, label: 'C5'},
                      { y: <?php echo $resultado["C6"]?>, label: 'C6'}
                    ] echo
                  }
                ]
              });
              grafico.render();
            
  <?php $con->close(); } else { echo "alert('Fallo en el if');"; } ?>
  </script>
          
      
      
      
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
        <img class="logo" src="img/logo-blanco-64.png"/>
        <i class="fas fa-bars"></i>
        <div>
          <ul>
            <?php menu(); ?>
          </ul>
        </div>
      </menu>
      <div class="contenido">
      <div class="instrucciones">
       <ul>
            <li>
              Fecha: 10/06/2019
            </li>
            <li>
              Cedula: 304830155
            </li>
            <li>
              Genero: H
            </li>
          </ul>
      </div>
      <br/>
        <div>
            <ul class="guiaGrafico">
              <li>
                Muy Bajo
                <div class="colorMuyBajo"></div>
              </li>
              <li>
                Bajo
                <div class="colorBajo"></div>
              </li>
              <li>
                Promedio
                <div class="colorPromedio"></div>
              </li>
              <li>
                Alto
                <div class="colorAlto"></div>
              </li>
              <li>
                Muy Alto
                <div class="colorMuyAlto"></div>
              </li>
            </ul>
            <!--cada grafico tiene la clase grafico y un id que lo diferencia
                el id es para identificarlo por el script-->
            <div id="grafico" class="grafico">

            </div>
             <?php
              echo"
              <div class='Columna1'>
              <label>Total N:</label>
              </div>
              <div class='columna2'>
              <label>".$total."</label>
              </div>";
           ?>
          </div>
         
        
           <div>
             <?php
             
              if(isset($_POST['calificacion'])){
                if(strcmp($calificacion,"APROBAR")==0)
                {
                  $con->close();
                  $con=conectar();
                  $con->query("CALL obtener_resultados(".$_SESSION["idestudiante"].",".$_SESSION['fecha'].", APROBAR)");
                  $con->close();
                }else{
                  $con->close();
                  $con=conectar();
                  $con->query("CALL obtener_resultados(".$_SESSION["idestudiante"].",".$_SESSION['fecha'].", REPROBAR)");
                  $con->close();
                }
              }
              
      
      
            if(strcmp($estado["Estado"],"FORMALIZADO")=0)
            {
              ?>
              <div class='botonesGraficos'>
                  
                  
                  <button class='seccionMedia especificos' onclick=".Back().">Atras</button>
                </div>
                <?php
            }else{?>
            
              <div class='botonesGraficos'>
             <form method="post" action="grafico.php">
               <button class='seccionMedia aprobado' name="calificacion" value="APROBAR">✔ Aprobar  </button>
                  <br/>
                  <button class='seccionMedia rechazado' name="calificacion" value="RECHAZAR" >X Rechazar </button>
                  <br/>
                  
                </form> 
                <button class='seccionMedia especificos' onclick=".Back().">Atras</button>
              </div>
              <?php
            }
           ?>
          </div>
      </div>
  </body>
</html>
