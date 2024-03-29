<?php 
  //inicio de variables de session
  session_start();
  //Incluir función de conexión a la base
  include 'Base.php';
  if(!isset($_SESSION['prueba']) || $_SESSION['prueba']==0){
    header("Location: ingresarprueba.php");
  }
  //Cambio a la siguiente página como falso.
  if(!isset($_SESSION['siguiente'])){
    $_SESSION['siguiente'] = false;
  }
  
  //Realizar la conexión
  $con = conectar();
  //Si tenemos el numero de pregunta actual iniciado 
  if(isset($_SESSION['numPregunta'])){
    //Si ya inició y finalizó la prueba el usuario es devuleto a la pagina de fin.
    if($_SESSION['numPregunta'] == 0){
      header("Location: finalprueba.php");
    }
  } else {
    $_SESSION['numPregunta'] = 1;
    $sql = "CALL datosPreguntas();";
    if($respuesta = $con->query($sql)){
      $fila = $respuesta->fetch_assoc();
      $_SESSION['cantPreguntas'] = $fila['xvista'];
      $_SESSION['totalPreguntas'] = $fila['total'];
    } else {
      $_SESSION['mensaje'] = "Error de conexión. Favor intentarlo más tarde";
      $_SESSION['tipoerror'] = 1;
    }
    $con->close();
  }
  if(isset($_POST['btn'])){
    switch ($_POST['btn']) {
      case 1: //Guardar
        $_SESSION['siguiente'] = true;
        //Valores del 1 al 20.
        $puntos = array();
        for($i = 1; $i<=$_SESSION['cantPreguntas']; $i++){
          if(!isset($_POST['radio'.$i])){
            $_POST['radio'.$i] = 0;
          }
          array_push($puntos,$_POST['radio'.$i]);
        }
        //totales;
        $totales = array("A1"=>0,"N1"=>0,"E1"=>0,"O1"=>0,"C1"=>0,
                         "A2"=>0,"N2"=>0,"E2"=>0,"O2"=>0,"C2"=>0,
                         "A3"=>0,"N3"=>0,"E3"=>0,"O3"=>0,"C3"=>0,
                         "A4"=>0,"N4"=>0,"E4"=>0,"O4"=>0,"C4"=>0,
                         "A5"=>0,"N5"=>0,"E5"=>0,"O5"=>0,"C5"=>0,
                         "A6"=>0,"N6"=>0,"E6"=>0,"O6"=>0,"C6"=>0);
        $sql = "Call TiposXPregunta(".$_SESSION['numPregunta'].");";
        if($respuesta = $con->query($sql)){
          $i = 0;
          while($fila = $respuesta->fetch_assoc()){
            switch($fila['Tipo']){
              case "A1":
                $totales['A1'] += $puntos[$i];
                break;
              case "A2":
                $totales['A2'] += $puntos[$i]; 
                break;
              case "A3":
                $totales['A3'] += $puntos[$i]; 
                break;
              case "A4":
                $totales['A4'] += $puntos[$i]; 
                break;
              case "A5":
                $totales['A5'] += $puntos[$i]; 
                break;
              case "A6":
                $totales['A6'] += $puntos[$i]; 
                break;
              case "N1":
                $totales['N1'] += $puntos[$i]; 
                break;
              case "N2":
                $totales['N2'] += $puntos[$i]; 
                break;
              case "N3":
                $totales['N3'] += $puntos[$i]; 
                break;
              case "N4":
                $totales['N4'] += $puntos[$i]; 
                break;
              case "N5":
                $totales['N5'] += $puntos[$i]; 
                break;
              case "N6":
                $totales['N6'] += $puntos[$i]; 
                break;
              case "E1":
                $totales['E1'] += $puntos[$i]; 
                break;
              case "E2":
                $totales['E2'] += $puntos[$i];
                break;
              case "E3":
                $totales['E3'] += $puntos[$i]; 
                break;
              case "E4":
                $totales['E4'] += $puntos[$i]; 
                break;
              case "E5":
                $totales['E5'] += $puntos[$i]; 
                break;
              case "E6":
                $totales['E6'] += $puntos[$i]; 
                break;
              case "O1":
                $totales['O1'] += $puntos[$i]; 
                break;
              case "O2":
                $totales['O2'] += $puntos[$i]; 
                break;
              case "O3":
                $totales['O3'] += $puntos[$i]; 
                break;
              case "O4":
                $totales['O4'] += $puntos[$i]; 
                break;
              case "O5":
                $totales['O5'] += $puntos[$i]; 
                break;
              case "O6":
                $totales['O6'] += $puntos[$i]; 
                break;
              case "C1":
                $totales['C1'] += $puntos[$i]; 
                break;
              case "C2":
                $totales['C2'] += $puntos[$i]; 
                break;
              case "C3":
                $totales['C3'] += $puntos[$i]; 
                break;
              case "C4":
                $totales['C4'] += $puntos[$i]; 
                break;
              case "C5":
                $totales['C5'] += $puntos[$i]; 
                break;
              case "C6":
                $totales['C6'] += $puntos[$i]; 
                break;
            }
            $i++;
          }
        } else {
          $_SESSION['mensaje'] = "Error de conexión. Favor intentarlo más tarde";
          $_SESSION['tipoerror'] = 1;
        }
        $con->close();
        $con = conectar();
        $sql = "Call GuardarCalificaciones(
          ".$totales['A1'].",".$totales['N1'].",".$totales['E1'].",".$totales['O1'].",".$totales['C1'].",
          ".$totales['A2'].",".$totales['N2'].",".$totales['E2'].",".$totales['O2'].",".$totales['C2'].",
          ".$totales['A3'].",".$totales['N3'].",".$totales['E3'].",".$totales['O3'].",".$totales['C3'].",
          ".$totales['A4'].",".$totales['N4'].",".$totales['E4'].",".$totales['O4'].",".$totales['C4'].",
          ".$totales['A5'].",".$totales['N5'].",".$totales['E5'].",".$totales['O5'].",".$totales['C5'].",
          ".$totales['A6'].",".$totales['N6'].",".$totales['E6'].",".$totales['O6'].",".$totales['C6'].", 
          ".$_SESSION['usuario'].", ".$_SESSION['prueba'].");";
        if($respuesta = $con->query($sql)){
          //exitosa
          $_SESSION['mensaje'] = "Sus respuestas han sido guardadas. Favor presione el botón SIGUIENTE.";
          $_SESSION['tipoerror'] = 0;
          $con->close();
          $con = conectar();
          $suma = $_SESSION['numPregunta'] + $_SESSION['cantPreguntas'];
          $sql = "CALL AlmacenarProgreso(".$_SESSION['usuario'].",".$_SESSION['prueba'].",".$suma.");";
          if($con->query($sql)){
          }
          $con->close();
        } else {
          $_SESSION['mensaje'] = "Error al guardar sus respuestas. Favor intentarlo de nuevo";
          $_SESSION['tipoerror'] = 1;
          $con->close();
        }
        break;
      case 2: //Siguiente
        $_SESSION['siguiente']=false;
        //ingcrementar numPregunta
        $_SESSION['numPregunta'] = $_SESSION['numPregunta'] + $_SESSION['cantPreguntas'];
        if($_SESSION['numPregunta']>$_SESSION['totalPreguntas']){
          $con = conectar();
          $sql = "Call EliminarProgreso(".$_SESSION['usuario'].");";
          if($con->query($sql)){
            
          }
          $_SESSION['numPregunta'] = 0;
          header("Location: finalprueba.php");
        }
        break;
      case 3:
      unset($_SESSION['prueba']);
      unset($_SESSION['numPregunta']);
      unset($_SESSION['cantPreguntas']);
      unset($_SESSION['totalPreguntas']);
      $_SESSION['mensaje'] = "Usted a salido de la prueba puede retomarla detro del tiempo establecido.";
      $_SESSION['tipoerror'] = 0;
      header("Location: index.php");

        break;
    }
  }
?>

<!DOCTYPE html>
<html>
  <!--Cabeza con el estilo -->

  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Prueba</title>
    <link type="text/css" rel="stylesheet" href="css/estilo.css" />
    <link type="text/css" rel="stylesheet" href="css/all.css" />
    <script src="js/jquery-3.4.1.min.js"></script>
    <script src="js/scripts.js"></script>
  </head>

  <!--Cuerpo -->

  <body>
    <!--Barra de Usuario con login -->
    <div class="barraUsuario">
      <div class="contenedor">
        <ul>
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
              Esta prueba contiene un total de <?php echo $_SESSION['totalPreguntas']; ?> afirmaciones.
            </li>

            <li>
              Cuenta con todo el tiempo establecido según el calendario.
            </li>
            <li>
              Describase sinceramente y presente sus opiniones lo más preciso posible.
            </li>
            <li>
              Cada afirmación contará con las siguientes respuestas:
            </li>
          </ul>
          <table>
            <tr>
              <td>
                SO
              </td>
              <td>
                Si la afirmación es todo falso o si se opone vigorosamente.
              </td>
            </tr>
            <tr>
              <td>
                O
              </td>
              <td>
                Si la afirmación es casi todo falso o si se opone.
              </td>
            </tr>
            <tr>
              <td>
                N
              </td>
              <td>
                Si la afirmación es casi igualmente cierta o falsa, si usted no puede decidirse, o si es neutral en cuanto a la afirmación.
              </td>
            </tr>
            <tr>
              <td>
                C
              </td>
              <td>
                Si la afirmación es casi todo cierta o si coincide.
              </td>
            </tr>
            <tr>
              <td>
                CV
              </td>
              <td>
                Si la afirmación es todo cierta o si coincide vigorosamente.
              </td>
            </tr>
          </table>
        </div>
             <!--Botones de la prueba arriba-->
        <form action="prueba.php" method="post">
          <div id="siguiente" class="botonesPrueba botonesPruebaArriba">
            <button type="submit" name="btn" <?php if(!$_SESSION['siguiente']){ echo "";} else { echo "disabled"; } ?> value="1">GUARDAR</button>
            <button formnovalidate type="submit" name="btn" <?php if($_SESSION['siguiente']){ echo "";} else { echo "disabled"; } ?> value="3">SALIR</button>
            <button formnovalidate type="submit" name="btn" <?php if($_SESSION['siguiente']){ echo "";} else { echo "disabled"; } ?> 
               value="2"><?php
              if(($_SESSION['numPregunta']+$_SESSION['cantPreguntas'])>$_SESSION['totalPreguntas']){
                echo "FINALIZAR";
              } else {
                echo "SIGUIENTE";
              }?></button>
          </div>
          <!--Preguntas -->
          <?php
            $con = conectar();
            $pregunta = 1;
            $sql = "Call PreguntasPrueba(".$_SESSION['numPregunta'].")";
            if($respuesta = $con->query($sql)){
              while($fila = $respuesta->fetch_assoc()){
                ?>
                <div class="pregunta">
                  <p><?php echo($fila['IDPregunta'].". ".$fila['TextoPregunta']);?></p>
                  <div class="opciones">
                    <label class="contenedorRadio">
                      <input required type="radio" name="radio<?php echo($pregunta);?>" value="<?php echo($fila['Valor1']); ?>"/>
                      <span class="botonRadio so"></span>
                    </label>
                    <label class="contenedorRadio">
                      <input type="radio" name="radio<?php echo($pregunta);?>" value="<?php echo($fila['Valor2']); ?>"/>
                      <span class="botonRadio o"></span>
                    </label>
                    <label class="contenedorRadio">
                      <input type="radio" name="radio<?php echo($pregunta);?>" value="<?php echo($fila['Valor3']); ?>"/>
                      <span class="botonRadio n"></span>
                    </label>
                    <label class="contenedorRadio">
                      <input type="radio" name="radio<?php echo($pregunta);?>" value="<?php echo($fila['Valor4']); ?>"/>
                      <span class="botonRadio c"></span>
                    </label>
                    <label class="contenedorRadio">
                      <input type="radio" name="radio<?php echo($pregunta);?>" value="<?php echo($fila['Valor5']); ?>"/>
                      <span class="botonRadio cv"></span>
                    </label>
                  </div>
                </div>
                <?php $pregunta++;
              }
            } else {
              echo "error de base";
            }
          $con->close();
          ?>
          <!--Botones de la prueba abajo-->
          <div id="siguiente" class="botonesPrueba botonesPruebaArriba">
            <button type="submit" name="btn" <?php if(!$_SESSION['siguiente']){ echo "";} else { echo "disabled"; } ?> value="1">GUARDAR</button>
            <button formnovalidate type="submit" name="btn" <?php if($_SESSION['siguiente']){ echo "";} else { echo "disabled"; } ?> value="3">SALIR</button>
            <button formnovalidate type="submit" name="btn" <?php if($_SESSION['siguiente']){ echo "";} else { echo "disabled"; } ?> 
               value="2"><?php
              if(($_SESSION['numPregunta']+$_SESSION['cantPreguntas'])>$_SESSION['totalPreguntas']){
                echo "FINALIZAR";
              } else {
                echo "SIGUIENTE";
              }?></button>
          </div>
        </form>
      </div>
      <?php include 'error.php'; ?>
    </div>
  </body>

</html>