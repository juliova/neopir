<?php if (substr_count($_SERVER["HTTP_ACCEPT_ENCODING"], "gzip")) { ob_start("ob_gzhandler"); } else { ob_start(); } ?>
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
<?php
             echo "Variable $fecha: $HTTP_GET_VARS["fecha"]";
             echo "Variable $id: $HTTP_GET_VARS["idestudiante"]";
             include 'Base.php';
             $con = conectar();
             $n1 = $con->query("CALL obtener_grafico(".$id.",'N1')");
             $n2 = $con->query("CALL obtener_grafico(".$id.",'N2')");
             $n3 = $con->query("CALL obtener_grafico(".$id.",'N3')");
             $n4 = $con->query("CALL obtener_grafico(".$id.",'N4')");
             $n5 = $con->query("CALL obtener_grafico(".$id.",'N5')");
             $n6 = $con->query("CALL obtener_grafico(".$id.",'N6')");
             $e1 = $con->query("CALL obtener_grafico(".$id.",'E1')");
             $e2 = $con->query("CALL obtener_grafico(".$id.",'E2')");
             $e3 = $con->query("CALL obtener_grafico(".$id.",'E3')");
             $e4 = $con->query("CALL obtener_grafico(".$id.",'E4')");
             $e5 = $con->query("CALL obtener_grafico(".$id.",'E5')");
             $e6 = $con->query("CALL obtener_grafico(".$id.",'E6')");
             $a1 = $con->query("CALL obtener_grafico(".$id.",'A1')");
             $a2 = $con->query("CALL obtener_grafico(".$id.",'A2')");
             $a3 = $con->query("CALL obtener_grafico(".$id.",'A3')");
             $a4 = $con->query("CALL obtener_grafico(".$id.",'A4')");
             $a5 = $con->query("CALL obtener_grafico(".$id.",'A5')");
             $a6 = $con->query("CALL obtener_grafico(".$id.",'A6')");
             $o1 = $con->query("CALL obtener_grafico(".$id.",'O1')");
             $o2 = $con->query("CALL obtener_grafico(".$id.",'O2')");
             $o3 = $con->query("CALL obtener_grafico(".$id.",'O3')");
             $o4 = $con->query("CALL obtener_grafico(".$id.",'O4')");
             $o5 = $con->query("CALL obtener_grafico(".$id.",'O5')");
             $o6 = $con->query("CALL obtener_grafico(".$id.",'O6')");
             $c1 = $con->query("CALL obtener_grafico(".$id.",'C1')");
             $c2 = $con->query("CALL obtener_grafico(".$id.",'C2')");
             $c3 = $con->query("CALL obtener_grafico(".$id.",'C3')");
             $c4 = $con->query("CALL obtener_grafico(".$id.",'C4')");
             $c5 = $con->query("CALL obtener_grafico(".$id.",'C5')");
             $c6 = $con->query("CALL obtener_grafico(".$id.",'C6')");
             $genero = $con->query("CALL obtener_gener(".$id.")");
             $resultado = $con->query("CALL obtener_resultados(".$id.",".$fecha.")");
             $estado = $con->query("CALL obtener_estado_examen(".$fecha.")");
             $total = $resultado["N1"]+$resultado["N2"]+$resultado["N3"]+$resultado["N4"]+$resultado["N5"]+$resultado["N6"]+$resultado["E1"]+$resultado["E2"]+$resultado["E3"]+$resultado["E4"]+$resultado["E5"]+$resultado["E6"]+$resultado["A1"]+$resultado["A2"]+$resultado["A3"]+$resultado["A4"]+$resultado["A5"]+$resultado["A6"]+$resultado["O1"]+$resultado["O2"]+$resultado["O3"]+$resultado["O4"]+$resultado["O5"]+$resultado["O6"]+$resultado["C1"]+$resultado["C2"]+$resultado["C3"]+$resultado["C4"]+$resultado["C5"]+$resultado["C6"];
             $con->close();
             echo "< script languaje= 'Javascript'>
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
              title: { text: ".$genero["Genero"]."},
              animationEnabled: true,
              axisY: {
              maximum: 34,
              interval: 2
              },
          data: [
            {
            type: 'stackedColumn',
            dataPoints:[
          { y: ".$n1["muybajo"].", label: 'N1'},
          { y: ".$n2["muybajo"].", label: 'N2'},
          { y: ".$n3["muybajo"].", label: 'N3'},
          { y: ".$n4["muybajo"].", label: 'N4'},
          { y: ".$n5["muybajo"].", label: 'N5'},
          { y: ".$n6["muybajo"].", label: 'N6'},
          { y: ".$e1["muybajo"].", label: 'E1'},
          { y: ".$e2["muybajo"].", label: 'E2'},
          { y: ".$e3["muybajo"].", label: 'E3'},
          { y: ".$e4["muybajo"].", label: 'E4'},
          { y: ".$e5["muybajo"].", label: 'E5'},
          { y: ".$e6["muybajo"].", label: 'E6'},
          { y: ".$o1["muybajo"].", label: 'O1'},
          { y: ".$o2["muybajo"].", label: 'O2'},
          { y: ".$o3["muybajo"].", label: 'O3'},
          { y: ".$o4["muybajo"].", label: 'O4'},
          { y: ".$o5["muybajo"].", label: 'O5'},
          { y: ".$o6["muybajo"].", label: 'O6'},
          { y: ".$a1["muybajo"].", label: 'A1'},
          { y: ".$a2["muybajo"].", label: 'A2'},
          { y: ".$a3["muybajo"].", label: 'A3'},
          { y: ".$a4["muybajo"].", label: 'A4'},
          { y: ".$a5["muybajo"].", label: 'A5'},
          { y: ".$a6["muybajo"].", label: 'A6'},
          { y: ".$c1["muybajo"].", label: 'C1'},
          { y: ".$c2["muybajo"].", label: 'C2'},
          { y: ".$c3["muybajo"].", label: 'C3'},
          { y: ".$c4["muybajo"].", label: 'C4'},
          { y: ".$c5["muybajo"].", label: 'C5'},
          { y: ".$c6["muybajo"].", label: 'C6'}
        ]
      },{
            type: 'stackedColumn',
            dataPoints:[
          { y: ".$n1["bajo"].", label: 'N1'},
          { y: ".$n2["bajo"].", label: 'N2'},
          { y: ".$n3["bajo"].", label: 'N3'},
          { y: ".$n4["bajo"].", label: 'N4'},
          { y: ".$n5["bajo"].", label: 'N5'},
          { y: ".$n6["bajo"].", label: 'N6'},
          { y: ".$e1["bajo"].", label: 'E1'},
          { y: ".$e2["bajo"].", label: 'E2'},
          { y: ".$e3["bajo"].", label: 'E3'},
          { y: ".$e4["bajo"].", label: 'E4'},
          { y: ".$e5["bajo"].", label: 'E5'},
          { y: ".$e6["bajo"].", label: 'E6'},
          { y: ".$o1["bajo"].", label: 'O1'},
          { y: ".$o2["bajo"].", label: 'O2'},
          { y: ".$o3["bajo"].", label: 'O3'},
          { y: ".$o4["bajo"].", label: 'O4'},
          { y: ".$o5["bajo"].", label: 'O5'},
          { y: ".$o6["bajo"].", label: 'O6'},
          { y: ".$a1["bajo"].", label: 'A1'},
          { y: ".$a2["bajo"].", label: 'A2'},
          { y: ".$a3["bajo"].", label: 'A3'},
          { y: ".$a4["bajo"].", label: 'A4'},
          { y: ".$a5["bajo"].", label: 'A5'},
          { y: ".$a6["bajo"].", label: 'A6'},
          { y: ".$c1["bajo"].", label: 'C1'},
          { y: ".$c2["bajo"].", label: 'C2'},
          { y: ".$c3["bajo"].", label: 'C3'},
          { y: ".$c4["bajo"].", label: 'C4'},
          { y: ".$c5["bajo"].", label: 'C5'},
          { y: ".$c6["bajo"].", label: 'C6'}
        ]
      },{
        type: 'stackedColumn',
        dataPoints:[
      { y: ".$n1["aceptable"].", label: 'N1'},
          { y: ".$n2["aceptable"].", label: 'N2'},
          { y: ".$n3["aceptable"].", label: 'N3'},
          { y: ".$n4["aceptable"].", label: 'N4'},
          { y: ".$n5["aceptable"].", label: 'N5'},
          { y: ".$n6["aceptable"].", label: 'N6'},
          { y: ".$e1["aceptable"].", label: 'E1'},
          { y: ".$e2["aceptable"].", label: 'E2'},
          { y: ".$e3["aceptable"].", label: 'E3'},
          { y: ".$e4["aceptable"].", label: 'E4'},
          { y: ".$e5["aceptable"].", label: 'E5'},
          { y: ".$e6["aceptable"].", label: 'E6'},
          { y: ".$o1["aceptable"].", label: 'O1'},
          { y: ".$o2["aceptable"].", label: 'O2'},
          { y: ".$o3["aceptable"].", label: 'O3'},
          { y: ".$o4["aceptable"].", label: 'O4'},
          { y: ".$o5["aceptable"].", label: 'O5'},
          { y: ".$o6["aceptable"].", label: 'O6'},
          { y: ".$a1["aceptable"].", label: 'A1'},
          { y: ".$a2["aceptable"].", label: 'A2'},
          { y: ".$a3["aceptable"].", label: 'A3'},
          { y: ".$a4["aceptable"].", label: 'A4'},
          { y: ".$a5["aceptable"].", label: 'A5'},
          { y: ".$a6["aceptable"].", label: 'A6'},
          { y: ".$c1["aceptable"].", label: 'C1'},
          { y: ".$c2["aceptable"].", label: 'C2'},
          { y: ".$c3["aceptable"].", label: 'C3'},
          { y: ".$c4["aceptable"].", label: 'C4'},
          { y: ".$c5["aceptable"].", label: 'C5'},
          { y: ".$c6["aceptable"].", label: 'C6'}
        ]
      },{
        type: 'stackedColumn',
        dataPoints:[
          { y: ".$n1["alto"].", label: 'N1'},
          { y: ".$n2["alto"].", label: 'N2'},
          { y: ".$n3["alto"].", label: 'N3'},
          { y: ".$n4["alto"].", label: 'N4'},
          { y: ".$n5["alto"].", label: 'N5'},
          { y: ".$n6["alto"].", label: 'N6'},
          { y: ".$e1["alto"].", label: 'E1'},
          { y: ".$e2["alto"].", label: 'E2'},
          { y: ".$e3["alto"].", label: 'E3'},
          { y: ".$e4["alto"].", label: 'E4'},
          { y: ".$e5["alto"].", label: 'E5'},
          { y: ".$e6["alto"].", label: 'E6'},
          { y: ".$o1["alto"].", label: 'O1'},
          { y: ".$o2["alto"].", label: 'O2'},
          { y: ".$o3["alto"].", label: 'O3'},
          { y: ".$o4["alto"].", label: 'O4'},
          { y: ".$o5["alto"].", label: 'O5'},
          { y: ".$o6["alto"].", label: 'O6'},
          { y: ".$a1["alto"].", label: 'A1'},
          { y: ".$a2["alto"].", label: 'A2'},
          { y: ".$a3["alto"].", label: 'A3'},
          { y: ".$a4["alto"].", label: 'A4'},
          { y: ".$a5["alto"].", label: 'A5'},
          { y: ".$a6["alto"].", label: 'A6'},
          { y: ".$c1["alto"].", label: 'C1'},
          { y: ".$c2["alto"].", label: 'C2'},
          { y: ".$c3["alto"].", label: 'C3'},
          { y: ".$c4["alto"].", label: 'C4'},
          { y: ".$c5["alto"].", label: 'C5'},
          { y: ".$c6["alto"].", label: 'C6'}
        ]
      },{
        type: 'stackedColumn',
        dataPoints:[
          { y: ".$n1["muyalto"].", label: 'N1'},
          { y: ".$n2["muyalto"].", label: 'N2'},
          { y: ".$n3["muyalto"].", label: 'N3'},
          { y: ".$n4["muyalto"].", label: 'N4'},
          { y: ".$n5["muyalto"].", label: 'N5'},
          { y: ".$n6["muyalto"].", label: 'N6'},
          { y: ".$e1["muyalto"].", label: 'E1'},
          { y: ".$e2["muyalto"].", label: 'E2'},
          { y: ".$e3["muyalto"].", label: 'E3'},
          { y: ".$e4["muyalto"].", label: 'E4'},
          { y: ".$e5["muyalto"].", label: 'E5'},
          { y: ".$e6["muyalto"].", label: 'E6'},
          { y: ".$o1["muyalto"].", label: 'O1'},
          { y: ".$o2["muyalto"].", label: 'O2'},
          { y: ".$o3["muyalto"].", label: 'O3'},
          { y: ".$o4["muyalto"].", label: 'O4'},
          { y: ".$o5["muyalto"].", label: 'O5'},
          { y: ".$o6["muyalto"].", label: 'O6'},
          { y: ".$a1["muyalto"].", label: 'A1'},
          { y: ".$a2["muyalto"].", label: 'A2'},
          { y: ".$a3["muyalto"].", label: 'A3'},
          { y: ".$a4["muyalto"].", label: 'A4'},
          { y: ".$a5["muyalto"].", label: 'A5'},
          { y: ".$a6["muyalto"].", label: 'A6'},
          { y: ".$c1["muyalto"].", label: 'C1'},
          { y: ".$c2["muyalto"].", label: 'C2'},
          { y: ".$c3["muyalto"].", label: 'C3'},
          { y: ".$c4["muyalto"].", label: 'C4'},
          { y: ".$c5["muyalto"].", label: 'C5'},
          { y: ".$c6["muyalto"].", label: 'C6'}
        ]
      },{
        color: 'black',
        type: 'line',
        dataPoints:[
          { y: ".$resultado["N1"].", label: 'N1'},
          { y: ".$resultado["N2"].", label: 'N2'},
          { y: ".$resultado["N3"].", label: 'N3'},
          { y: ".$resultado["N4"].", label: 'N4'},
          { y: ".$resultado["N5"].", label: 'N5'},
          { y: ".$resultado["N6"].", label: 'N6'},
          { y: ".$resultado["E1"].", label: 'E1'},
          { y: ".$resultado["E2"].", label: 'E2'},          
          { y: ".$resultado["E3"].", label: 'E3'},
          { y: ".$resultado["E4"].", label: 'E4'},
          { y: ".$resultado["E5"].", label: 'E5'},
          { y: ".$resultado["E6"].", label: 'E6'},
          { y: ".$resultado["O1"].", label: 'O1'},
          { y: ".$resultado["O2"].", label: 'O2'},
          { y: ".$resultado["O3"].", label: 'O3'},
          { y: ".$resultado["O4"].", label: 'O4'},
          { y: ".$resultado["O5"].", label: 'O5'},
          { y: ".$resultado["O6"].", label: 'O6'},
          { y: ".$resultado["A1"].", label: 'A1'},
          { y: ".$resultado["A2"].", label: 'A2'},
          { y: ".$resultado["A3"].", label: 'A3'},
          { y: ".$resultado["A4"].", label: 'A4'},
          { y: ".$resultado["A5"].", label: 'A5'},
          { y: ".$resultado["A6"].", label: 'A6'},
          { y: ".$resultado["C1"].", label: 'C1'},
          { y: ".$resultado["C2"].", label: 'C2'},
          { y: ".$resultado["C3"].", label: 'C3'},
          { y: ".$resultado["C4"].", label: 'C4'},
          { y: ".$resultado["C5"].", label: 'C5'},
          { y: ".$resultado["C6"].", label: 'C6'}
        ]
      }
    ]
  });
  grafico.render();
}
                 </script>";

          ?> 
    <script src="js/scripts.js"></script>
  </head>
  <body>
    <div class="barraUsuario">
      <div class="contenedor">
        <ul>
          <li>
            <a href="#">registro</a>
          </li>
          <li>
            <a href="#">iniciar sesión</a>
          </li>
        </ul>
      </div>
    </div>
    <div class="contenedor">
      <menu>
        <img class="logo" src="img/logo-blanco-64.png"/>
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
              <label>".$Total."</label>
              </div>";
           ?>
          </div>
         
        
           <div>
             <?php

          function Back()
           {
           header('Location: examenxestudiante.php?fecha=".$fecha."');
           }
        function calificar($calificacion)
          {   
          $con->query("CALL obtener_resultados(".$id.",".$fecha.",".$calificacion.")");
          Back();
          }
            if($result["Estado"]='FORMALIZADO')
            {
              echo "<div class='botonesGraficos'>
                  
                  <button class='seccionMedia aprobado'onclick="calificar('APROBADO');" >✔ Aprobar  </button>
                  <br/>
                  <button class='seccionMedia rechazado' onclick="calificar('REPROBADO');" >X Rechazar </button>
                  <br/>
                  <button class='seccionMedia especificos' onclick="Back();">Atras</button>
                  
                </div>";
            }else{
              echo"
              <div class='botonesGraficos'>
               
                  <button class='seccionMedia especificos' onclick="Back();">Atras</button>
                  
                </div>";
            }
           ?>
          </div>
      </div>
  </body>
</html>
