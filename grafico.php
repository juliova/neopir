<?php if (substr_count($_SERVER["HTTP_ACCEPT_ENCODING"], "gzip")) { ob_start("ob_gzhandler"); } else { ob_start(); } ?>
<?php 
  session_start();
  include 'Base.php';
  include '_menu.php';
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
    <script src="js/scripts.js"></script>
    <script languaje= 'Javascript'>
    <?php
      $total = 0;
      $conr = conectar();
      $conn1 = conectar();
      $conn2 = conectar();
      $conn3 = conectar();
      $conn4 = conectar();
      $conn5 = conectar();
      $conn6 = conectar();
      $cono1 = conectar();
      $cono2 = conectar();
      $cono3 = conectar();
      $cono4 = conectar();
      $cono5 = conectar();
      $cono6 = conectar();
      $cone1 = conectar();
      $cone2 = conectar();
      $cone3 = conectar();
      $cone4 = conectar();
      $cone5 = conectar();
      $cone6 = conectar();
      $cona1 = conectar();
      $cona2 = conectar();
      $cona3 = conectar();
      $cona4 = conectar();
      $cona5 = conectar();
      $cona6 = conectar();
      $conc1 = conectar();
      $conc2 = conectar();
      $conc3 = conectar();
      $conc4 = conectar();
      $conc5 = conectar();
      $conc6 = conectar();
      $cong = conectar();
      if(($n1 = $conn1->query("CALL obtener_grafico(".$_SESSION["idestudiante"].",'N1')")) &&
         ($n2 = $conn2->query("CALL obtener_grafico(".$_SESSION["idestudiante"].",'N2')")) &&
         ($n3 = $conn3->query("CALL obtener_grafico(".$_SESSION["idestudiante"].",'N3')")) &&
         ($n4 = $conn4->query("CALL obtener_grafico(".$_SESSION["idestudiante"].",'N4')")) &&
         ($n5 = $conn5->query("CALL obtener_grafico(".$_SESSION["idestudiante"].",'N5')")) &&
         ($n6 = $conn6->query("CALL obtener_grafico(".$_SESSION["idestudiante"].",'N6')")) &&
         ($e1 = $cone1->query("CALL obtener_grafico(".$_SESSION["idestudiante"].",'E1')")) &&
         ($e2 = $cone2->query("CALL obtener_grafico(".$_SESSION["idestudiante"].",'E2')")) &&
         ($e3 = $cone3->query("CALL obtener_grafico(".$_SESSION["idestudiante"].",'E3')")) &&
         ($e4 = $cone4->query("CALL obtener_grafico(".$_SESSION["idestudiante"].",'E4')")) &&
         ($e5 = $cone5->query("CALL obtener_grafico(".$_SESSION["idestudiante"].",'E5')")) &&
         ($e6 = $cone6->query("CALL obtener_grafico(".$_SESSION["idestudiante"].",'E6')")) &&
         ($a1 = $cona1->query("CALL obtener_grafico(".$_SESSION["idestudiante"].",'A1')")) &&
         ($a2 = $cona2->query("CALL obtener_grafico(".$_SESSION["idestudiante"].",'A2')")) &&
         ($a3 = $cona3->query("CALL obtener_grafico(".$_SESSION["idestudiante"].",'A3')")) &&
         ($a4 = $cona4->query("CALL obtener_grafico(".$_SESSION["idestudiante"].",'A4')")) &&
         ($a5 = $cona5->query("CALL obtener_grafico(".$_SESSION["idestudiante"].",'A5')")) &&
         ($a6 = $cona6->query("CALL obtener_grafico(".$_SESSION["idestudiante"].",'A6')")) &&
         ($o1 = $cono1->query("CALL obtener_grafico(".$_SESSION["idestudiante"].",'O1')")) &&
         ($o2 = $cono2->query("CALL obtener_grafico(".$_SESSION["idestudiante"].",'O2')")) &&
         ($o3 = $cono3->query("CALL obtener_grafico(".$_SESSION["idestudiante"].",'O3')")) &&
         ($o4 = $cono4->query("CALL obtener_grafico(".$_SESSION["idestudiante"].",'O4')")) &&
         ($o5 = $cono5->query("CALL obtener_grafico(".$_SESSION["idestudiante"].",'O5')")) &&
         ($o6 = $cono6->query("CALL obtener_grafico(".$_SESSION["idestudiante"].",'O6')")) &&
         ($c1 = $conc1->query("CALL obtener_grafico(".$_SESSION["idestudiante"].",'C1')")) &&
         ($c2 = $conc2->query("CALL obtener_grafico(".$_SESSION["idestudiante"].",'C2')")) &&
         ($c3 = $conc3->query("CALL obtener_grafico(".$_SESSION["idestudiante"].",'C3')")) &&
         ($c4 = $conc4->query("CALL obtener_grafico(".$_SESSION["idestudiante"].",'C4')")) &&
         ($c5 = $conc5->query("CALL obtener_grafico(".$_SESSION["idestudiante"].",'C5')")) &&
         ($c6 = $conc6->query("CALL obtener_grafico(".$_SESSION["idestudiante"].",'C6')")) &&
         ($genero = $cong->query("CALL obtener_genero(".$_SESSION["idestudiante"].")")) &&
         ($resultado = $conr->query("CALL obtener_resultados(".$_SESSION["idestudiante"].",".$_SESSION["fecha"].")"))){
           $gn1 = $n1->fetch_assoc();
           $gn2 = $n2->fetch_assoc();
           $gn3 = $n3->fetch_assoc();
           $gn4 = $n4->fetch_assoc();
           $gn5 = $n5->fetch_assoc();
           $gn6 = $n6->fetch_assoc();
           $ge1 = $e1->fetch_assoc();
           $ge2 = $e2->fetch_assoc();
           $ge3 = $e3->fetch_assoc();
           $ge4 = $e4->fetch_assoc();
           $ge5 = $e5->fetch_assoc();
           $ge6 = $e6->fetch_assoc();
           $ga1 = $a1->fetch_assoc();
           $ga2 = $a2->fetch_assoc();
           $ga3 = $a3->fetch_assoc();
           $ga4 = $a4->fetch_assoc();
           $ga5 = $a5->fetch_assoc();
           $ga6 = $a6->fetch_assoc();
           $go1 = $o1->fetch_assoc();
           $go2 = $o2->fetch_assoc();
           $go3 = $o3->fetch_assoc();
           $go4 = $o4->fetch_assoc();
           $go5 = $o5->fetch_assoc();
           $go6 = $o6->fetch_assoc();
           $gc1 = $c1->fetch_assoc();
           $gc2 = $c2->fetch_assoc();
           $gc3 = $c3->fetch_assoc();
           $gc4 = $c4->fetch_assoc();
           $gc5 = $c5->fetch_assoc();
           $gc6 = $c6->fetch_assoc();
           $gg = $genero->fetch_assoc();
           $suma = $resultado->fetch_assoc();
          $total = 
          $suma["N1"]+$suma["N2"]+$suma["N3"]+$suma["N4"]+$suma["N5"]+$suma["N6"]+
          $suma["E1"]+$suma["E2"]+$suma["E3"]+$suma["E4"]+$suma["E5"]+$suma["E6"]+
          $suma["A1"]+$suma["A2"]+$suma["A3"]+$suma["A4"]+$suma["A5"]+$suma["A6"]+
          $suma["O1"]+$suma["O2"]+$suma["O3"]+$suma["O4"]+$suma["O5"]+$suma["O6"]+
          $suma["C1"]+$suma["C2"]+$suma["C3"]+$suma["C4"]+$suma["C5"]+$suma["C6"];
          ?>
            window.onload = function() {
              CanvasJS.addColorSet('coloresGrafico',
              [
                '#0008E6',
                '#00FFFF',
                '#7CAD00',
                '#FEA90D',
                '#fd5f00'
              ]);
              var graficoG = new CanvasJS.Chart('graficoG',
              {
                colorSet: 'coloresGrafico',
                title: { text: "<?php echo $gg["Genero"];?>"},
                animationEnabled: true,
                axisX: {
                  interval: 1
                },
                axisY: {
                maximum: 34,
                interval: 2
                },
                data: [
                  {
                    type: 'stackedColumn',
                    dataPoints:[
                      { y: <?php echo $gn1["muybajo"]; ?>, label: 'N1'},
                      { y: <?php echo $gn2["muybajo"]; ?>, label: 'N2'},
                      { y: <?php echo $gn3["muybajo"]; ?>, label: 'N3'},
                      { y: <?php echo $gn4["muybajo"]; ?>, label: 'N4'},
                      { y: <?php echo $gn5["muybajo"]; ?>, label: 'N5'},
                      { y: <?php echo $gn6["muybajo"]; ?>, label: 'N6'},
                      { y: <?php echo $ge1["muybajo"]; ?>, label: 'E1'},
                      { y: <?php echo $ge2["muybajo"]; ?>, label: 'E2'},
                      { y: <?php echo $ge3["muybajo"]; ?>, label: 'E3'},
                      { y: <?php echo $ge4["muybajo"]; ?>, label: 'E4'},
                      { y: <?php echo $ge5["muybajo"]; ?>, label: 'E5'},
                      { y: <?php echo $ge6["muybajo"]; ?>, label: 'E6'},
                      { y: <?php echo $go1["muybajo"]; ?>, label: 'O1'},
                      { y: <?php echo $go2["muybajo"]; ?>, label: 'O2'},
                      { y: <?php echo $go3["muybajo"]; ?>, label: 'O3'},
                      { y: <?php echo $go4["muybajo"]; ?>, label: 'O4'},
                      { y: <?php echo $go5["muybajo"]; ?>, label: 'O5'},
                      { y: <?php echo $go6["muybajo"]; ?>, label: 'O6'},
                      { y: <?php echo $ga1["muybajo"]; ?>, label: 'A1'},
                      { y: <?php echo $ga2["muybajo"]; ?>, label: 'A2'},
                      { y: <?php echo $ga3["muybajo"]; ?>, label: 'A3'},
                      { y: <?php echo $ga4["muybajo"]; ?>, label: 'A4'},
                      { y: <?php echo $ga5["muybajo"]; ?>, label: 'A5'},
                      { y: <?php echo $ga6["muybajo"]; ?>, label: 'A6'},
                      { y: <?php echo $gc1["muybajo"]; ?>, label: 'C1'},
                      { y: <?php echo $gc2["muybajo"]; ?>, label: 'C2'},
                      { y: <?php echo $gc3["muybajo"]; ?>, label: 'C3'},
                      { y: <?php echo $gc4["muybajo"]; ?>, label: 'C4'},
                      { y: <?php echo $gc5["muybajo"]; ?>, label: 'C5'},
                      { y: <?php echo $gc6["muybajo"]; ?>, label: 'C6'}
                    ]
                  },{
                   type: 'stackedColumn',
                    dataPoints:[
                      { y: <?php echo $gn1["bajo"]; ?>, label: 'N1'},
                      { y: <?php echo $gn2["bajo"]; ?>, label: 'N2'},
                      { y: <?php echo $gn3["bajo"]; ?>, label: 'N3'},
                      { y: <?php echo $gn4["bajo"]; ?>, label: 'N4'},
                      { y: <?php echo $gn5["bajo"]; ?>, label: 'N5'},
                      { y: <?php echo $gn6["bajo"]; ?>, label: 'N6'},
                      { y: <?php echo $ge1["bajo"]; ?>, label: 'E1'},
                      { y: <?php echo $ge2["bajo"]; ?>, label: 'E2'},
                      { y: <?php echo $ge3["bajo"]; ?>, label: 'E3'},
                      { y: <?php echo $ge4["bajo"]; ?>, label: 'E4'},
                      { y: <?php echo $ge5["bajo"]; ?>, label: 'E5'},
                      { y: <?php echo $ge6["bajo"]; ?>, label: 'E6'},
                      { y: <?php echo $go1["bajo"]; ?>, label: 'O1'},
                      { y: <?php echo $go2["bajo"]; ?>, label: 'O2'},
                      { y: <?php echo $go3["bajo"]; ?>, label: 'O3'},
                      { y: <?php echo $go4["bajo"]; ?>, label: 'O4'},
                      { y: <?php echo $go5["bajo"]; ?>, label: 'O5'},
                      { y: <?php echo $go6["bajo"]; ?>, label: 'O6'},
                      { y: <?php echo $ga1["bajo"]; ?>, label: 'A1'},
                      { y: <?php echo $ga2["bajo"]; ?>, label: 'A2'},
                      { y: <?php echo $ga3["bajo"]; ?>, label: 'A3'},
                      { y: <?php echo $ga4["bajo"]; ?>, label: 'A4'},
                      { y: <?php echo $ga5["bajo"]; ?>, label: 'A5'},
                      { y: <?php echo $ga6["bajo"]; ?>, label: 'A6'},
                      { y: <?php echo $gc1["bajo"]; ?>, label: 'C1'},
                      { y: <?php echo $gc2["bajo"]; ?>, label: 'C2'},
                      { y: <?php echo $gc3["bajo"]; ?>, label: 'C3'},
                      { y: <?php echo $gc4["bajo"]; ?>, label: 'C4'},
                      { y: <?php echo $gc5["bajo"]; ?>, label: 'C5'},
                      { y: <?php echo $gc6["bajo"]; ?>, label: 'C6'}
                    ]
                  },{
                   type: 'stackedColumn',
                    dataPoints:[
                      { y: <?php echo $gn1["aceptable"]; ?>, label: 'N1'},
                      { y: <?php echo $gn2["aceptable"]; ?>, label: 'N2'},
                      { y: <?php echo $gn3["aceptable"]; ?>, label: 'N3'},
                      { y: <?php echo $gn4["aceptable"]; ?>, label: 'N4'},
                      { y: <?php echo $gn5["aceptable"]; ?>, label: 'N5'},
                      { y: <?php echo $gn6["aceptable"]; ?>, label: 'N6'},
                      { y: <?php echo $ge1["aceptable"]; ?>, label: 'E1'},
                      { y: <?php echo $ge2["aceptable"]; ?>, label: 'E2'},
                      { y: <?php echo $ge3["aceptable"]; ?>, label: 'E3'},
                      { y: <?php echo $ge4["aceptable"]; ?>, label: 'E4'},
                      { y: <?php echo $ge5["aceptable"]; ?>, label: 'E5'},
                      { y: <?php echo $ge6["aceptable"]; ?>, label: 'E6'},
                      { y: <?php echo $go1["aceptable"]; ?>, label: 'O1'},
                      { y: <?php echo $go2["aceptable"]; ?>, label: 'O2'},
                      { y: <?php echo $go3["aceptable"]; ?>, label: 'O3'},
                      { y: <?php echo $go4["aceptable"]; ?>, label: 'O4'},
                      { y: <?php echo $go5["aceptable"]; ?>, label: 'O5'},
                      { y: <?php echo $go6["aceptable"]; ?>, label: 'O6'},
                      { y: <?php echo $ga1["aceptable"]; ?>, label: 'A1'},
                      { y: <?php echo $ga2["aceptable"]; ?>, label: 'A2'},
                      { y: <?php echo $ga3["aceptable"]; ?>, label: 'A3'},
                      { y: <?php echo $ga4["aceptable"]; ?>, label: 'A4'},
                      { y: <?php echo $ga5["aceptable"]; ?>, label: 'A5'},
                      { y: <?php echo $ga6["aceptable"]; ?>, label: 'A6'},
                      { y: <?php echo $gc1["aceptable"]; ?>, label: 'C1'},
                      { y: <?php echo $gc2["aceptable"]; ?>, label: 'C2'},
                      { y: <?php echo $gc3["aceptable"]; ?>, label: 'C3'},
                      { y: <?php echo $gc4["aceptable"]; ?>, label: 'C4'},
                      { y: <?php echo $gc5["aceptable"]; ?>, label: 'C5'},
                      { y: <?php echo $gc6["aceptable"]; ?>, label: 'C6'}
                    ]
                  },{
                    type: 'stackedColumn',
                    dataPoints:[
                      { y: <?php echo $gn1["alto"]; ?>, label: 'N1'},
                      { y: <?php echo $gn2["alto"]; ?>, label: 'N2'},
                      { y: <?php echo $gn3["alto"]; ?>, label: 'N3'},
                      { y: <?php echo $gn4["alto"]; ?>, label: 'N4'},
                      { y: <?php echo $gn5["alto"]; ?>, label: 'N5'},
                      { y: <?php echo $gn6["alto"]; ?>, label: 'N6'},
                      { y: <?php echo $ge1["alto"]; ?>, label: 'E1'},
                      { y: <?php echo $ge2["alto"]; ?>, label: 'E2'},
                      { y: <?php echo $ge3["alto"]; ?>, label: 'E3'},
                      { y: <?php echo $ge4["alto"]; ?>, label: 'E4'},
                      { y: <?php echo $ge5["alto"]; ?>, label: 'E5'},
                      { y: <?php echo $ge6["alto"]; ?>, label: 'E6'},
                      { y: <?php echo $go1["alto"]; ?>, label: 'O1'},
                      { y: <?php echo $go2["alto"]; ?>, label: 'O2'},
                      { y: <?php echo $go3["alto"]; ?>, label: 'O3'},
                      { y: <?php echo $go4["alto"]; ?>, label: 'O4'},
                      { y: <?php echo $go5["alto"]; ?>, label: 'O5'},
                      { y: <?php echo $go6["alto"]; ?>, label: 'O6'},
                      { y: <?php echo $ga1["alto"]; ?>, label: 'A1'},
                      { y: <?php echo $ga2["alto"]; ?>, label: 'A2'},
                      { y: <?php echo $ga3["alto"]; ?>, label: 'A3'},
                      { y: <?php echo $ga4["alto"]; ?>, label: 'A4'},
                      { y: <?php echo $ga5["alto"]; ?>, label: 'A5'},
                      { y: <?php echo $ga6["alto"]; ?>, label: 'A6'},
                      { y: <?php echo $gc1["alto"]; ?>, label: 'C1'},
                      { y: <?php echo $gc2["alto"]; ?>, label: 'C2'},
                      { y: <?php echo $gc3["alto"]; ?>, label: 'C3'},
                      { y: <?php echo $gc4["alto"]; ?>, label: 'C4'},
                      { y: <?php echo $gc5["alto"]; ?>, label: 'C5'},
                      { y: <?php echo $gc6["alto"]; ?>, label: 'C6'}
                    ]
                  },{
                    type: 'stackedColumn',
                    dataPoints:[
                      { y: <?php echo $gn1["muyalto"]; ?>, label: 'N1'},
                      { y: <?php echo $gn2["muyalto"]; ?>, label: 'N2'},
                      { y: <?php echo $gn3["muyalto"]; ?>, label: 'N3'},
                      { y: <?php echo $gn4["muyalto"]; ?>, label: 'N4'},
                      { y: <?php echo $gn5["muyalto"]; ?>, label: 'N5'},
                      { y: <?php echo $gn6["muyalto"]; ?>, label: 'N6'},
                      { y: <?php echo $ge1["muyalto"]; ?>, label: 'E1'},
                      { y: <?php echo $ge2["muyalto"]; ?>, label: 'E2'},
                      { y: <?php echo $ge3["muyalto"]; ?>, label: 'E3'},
                      { y: <?php echo $ge4["muyalto"]; ?>, label: 'E4'},
                      { y: <?php echo $ge5["muyalto"]; ?>, label: 'E5'},
                      { y: <?php echo $ge6["muyalto"]; ?>, label: 'E6'},
                      { y: <?php echo $go1["muyalto"]; ?>, label: 'O1'},
                      { y: <?php echo $go2["muyalto"]; ?>, label: 'O2'},
                      { y: <?php echo $go3["muyalto"]; ?>, label: 'O3'},
                      { y: <?php echo $go4["muyalto"]; ?>, label: 'O4'},
                      { y: <?php echo $go5["muyalto"]; ?>, label: 'O5'},
                      { y: <?php echo $go6["muyalto"]; ?>, label: 'O6'},
                      { y: <?php echo $ga1["muyalto"]; ?>, label: 'A1'},
                      { y: <?php echo $ga2["muyalto"]; ?>, label: 'A2'},
                      { y: <?php echo $ga3["muyalto"]; ?>, label: 'A3'},
                      { y: <?php echo $ga4["muyalto"]; ?>, label: 'A4'},
                      { y: <?php echo $ga5["muyalto"]; ?>, label: 'A5'},
                      { y: <?php echo $ga6["muyalto"]; ?>, label: 'A6'},
                      { y: <?php echo $gc1["muyalto"]; ?>, label: 'C1'},
                      { y: <?php echo $gc2["muyalto"]; ?>, label: 'C2'},
                      { y: <?php echo $gc3["muyalto"]; ?>, label: 'C3'},
                      { y: <?php echo $gc4["muyalto"]; ?>, label: 'C4'},
                      { y: <?php echo $gc5["muyalto"]; ?>, label: 'C5'},
                      { y: <?php echo $gc6["muyalto"]; ?>, label: 'C6'}
                    ]
                  },{
                    color: 'black',
                    type: 'line',
                    dataPoints:[
                      { y: <?php echo $suma["N1"]?>, label: 'N1'},
                      { y: <?php echo $suma["N2"]?>, label: 'N2'},
                      { y: <?php echo $suma["N3"]?>, label: 'N3'},
                      { y: <?php echo $suma["N4"]?>, label: 'N4'},
                      { y: <?php echo $suma["N5"]?>, label: 'N5'},
                      { y: <?php echo $suma["N6"]?>, label: 'N6'},
                      { y: <?php echo $suma["E1"]?>, label: 'E1'},
                      { y: <?php echo $suma["E2"]?>, label: 'E2'},          
                      { y: <?php echo $suma["E3"]?>, label: 'E3'},
                      { y: <?php echo $suma["E4"]?>, label: 'E4'},
                      { y: <?php echo $suma["E5"]?>, label: 'E5'},
                      { y: <?php echo $suma["E6"]?>, label: 'E6'},
                      { y: <?php echo $suma["O1"]?>, label: 'O1'},
                      { y: <?php echo $suma["O2"]?>, label: 'O2'},
                      { y: <?php echo $suma["O3"]?>, label: 'O3'},
                      { y: <?php echo $suma["O4"]?>, label: 'O4'},
                      { y: <?php echo $suma["O5"]?>, label: 'O5'},
                      { y: <?php echo $suma["O6"]?>, label: 'O6'},
                      { y: <?php echo $suma["A1"]?>, label: 'A1'},
                      { y: <?php echo $suma["A2"]?>, label: 'A2'},
                      { y: <?php echo $suma["A3"]?>, label: 'A3'},
                      { y: <?php echo $suma["A4"]?>, label: 'A4'},
                      { y: <?php echo $suma["A5"]?>, label: 'A5'},
                      { y: <?php echo $suma["A6"]?>, label: 'A6'},
                      { y: <?php echo $suma["C1"]?>, label: 'C1'},
                      { y: <?php echo $suma["C2"]?>, label: 'C2'},
                      { y: <?php echo $suma["C3"]?>, label: 'C3'},
                      { y: <?php echo $suma["C4"]?>, label: 'C4'},
                      { y: <?php echo $suma["C5"]?>, label: 'C5'},
                      { y: <?php echo $suma["C6"]?>, label: 'C6'}
                    ] 
                  }
                ]
              });
              graficoG.render();
            }
            
  <?php 
$conr->close();
$conn1->close();
$conn2->close();
$conn3->close();
$conn4->close();
$conn5->close();
$conn6->close();
$cono1->close();
$cono2->close();
$cono3->close();
$cono4->close();
$cono5->close();
$cono6->close();
$cone1->close();
$cone2->close();
$cone3->close();
$cone4->close();
$cone5->close();
$cone6->close();
$cona1->close();
$cona2->close();
$cona3->close();
$cona4->close();
$cona5->close();
$cona6->close();
$conc1->close();
$conc2->close();
$conc3->close();
$conc4->close();
$conc5->close();
$conc6->close();
$cong->close();
 } else { 
    $_SESSION['mensaje'] = "Error de conexión. Favor intentarlo más tarde";
    $_SESSION['tipoerror'] = 1; 
  }  ?>
  </script>
          
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
              <?php
              $con=conectar();
              if($fecha = $con->query("CALL fecha(".$_SESSION["fecha"].")")){
                $fechaf=$fecha->fetch_assoc();
               echo"Fecha: ".date("d/m/Y  h:i:s A", strtotime($fechaf["Fechar"]));
              } else {
                $_SESSION['mensaje'] = "Error de conexión. Favor intentarlo más tarde";
                $_SESSION['tipoerror'] = 1; 
              }

    
              ?>
              
            </li>
            <li>
              Cedula: <?php echo $_SESSION['idestudiante'] ?>
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
            <div id="graficoG" class="grafico">

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
                $calificacion=$_POST['calificacion'];
                if(strcmp($calificacion,"Aprobado")==0)
                {
                  $con->close();
                  $con=conectar();
                  $coreo=conectar();
                  if($con->query("CALL  calificar(".$_SESSION['idestudiante'].",".$_SESSION['fecha'].",'Aprobado')")){
                      if($correo->query("select Correo from ususarios where Cedula=".$SESSION['idestudiante'].""))
                      {
                        $Correo=$correo->fetch_assoc();
                    if(mail($Correo['Correo'],' Resultado Neo_pir','su estado es Aprobado')){
                      
                    } else {
                      
                    }
                  }
                  $correo->close();
                    header("Location: examenesxestudiante.php");
                  }else{
                    $_SESSION['mensaje'] = "no se pudo aprobar";
                    $_SESSION['tipoerror'] = 1; 
                  }
                  $con->close();

                }else{
                  $con->close();
                  $con=conectar();
                   if($con->query("CALL  calificar(".$_SESSION['idestudiante'].",".$_SESSION['fecha'].",'Reprobado')")){
                     if($correo->query("select Correo from ususarios where Cedula=".$SESSION['idestudiante'].""))
                      {
                        $Correo=$correo->fetch_assoc();
                    if(mail($Correo['Correo'],' Resultado Neo_pir','su estado es Reprobo')){
                      
                    } else {
                      
                    }
                  }
                  $correo->close();
                    
                    header("Location: examenesxestudiante.php");
                  }else{
                    $_SESSION['mensaje'] = "no se pudo reprobar";
                    $_SESSION['tipoerror'] = 1;
                  }
                  $con->close();
                }
              }
              
              $con=conectar();
              if($estado=$con->query("CALL  obtener_estado_examen(".$_SESSION['fecha'].")")){
                $fila = $estado->fetch_assoc();
                if(strcmp($fila["Estado"],"FORMALIZADO")==0){             
                  ?>
                    <div class='botonesGraficos'>
                      <button class='seccionMedia especificos' onclick="window.location.href='examenesxestudiante.php'">Atras</button>
                    </div>
                  <?php
                }else{?>
                  <div class='botonesGraficos'>
                    <form method="post" action="grafico.php">
                      <button class='seccionMedia aprobado' name="calificacion" value="Aprobado">✔ Aprobar  </button>
                      <br/>
                      <button class='seccionMedia rechazado' name="calificacion" value="Reprobado" >X Rechazar </button>
                      <br/>
                      <button class='seccionMedia especificos' onclick="window.location.href='examenesxestudiante.php'">Atras</button>
                    </form> 
                    
                  </div>
                  <?php
                }
          
              }else{
                $_SESSION['mensaje'] = "Error de conexión. Favor intentarlo más tarde";
                $_SESSION['tipoerror'] = 1; 
              }
           ?>
          </div>
          <?php include 'error.php'; ?>
      </div>
  </body>
</html>
