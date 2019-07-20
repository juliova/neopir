<?php 
  session_start();
  $siguiente = false;
  include 'Base.php';
  $con = conectar();
  if(isset($_SESSION['numPregunta'])){
    
  } else {
    $_SESSION['numPregunta'] = 0;
    $sql = "SELECT PreguntasxVista FROM variables;";
    $resultado = $con->query($sql);
    $fila = $resultado->fetch_assoc();
    $_SESSION['cantPreguntas'] = $fila['PreguntasxVista'];
  }
  if(isset($_POST['btn'])){
    switch ($_POST['btn']) {
      case 1: //Guardar
        $siguiente = true;

        break;
      case 2: //Siguiente
        if($_SESSION['numPregunta']>=220){
          header("Location: finalprueba.php");
        }
        //ingcrementar numPregunta
        $_SESSION['numPregunta'] = $_SESSION['numPregunta'] + 20;
        break;
    }
  } else {
    $_SESSION['numPregunta'] = 0;
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
    <?php if(isset($_POST['btn'])) {
      if($_POST['btn'] == 1){?>
        <script>
          $(document).ready(function(){
            alert("Sus respuestas han sido guardadas. Favor presione el botón SIGUIENTE."); 
          });
        </script>
    <?php }} ?>
  </head>

  <!--Cuerpo -->

  <body>
    <!--Barra de Usuario con login -->
    <div class="barraUsuario">
      <div class="contenedor">
        <ul>
          <li>
            <a href="Login.html">registro</a>
          </li>
          <li>
            <a href="Login.html">iniciar sesión</a>
          </li>
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
            <li>
              <a href="index.html">inicio</a>
            </li>
            <li>
              <a href="prueba.html">prueba</a>
            </li>
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
              Esta prueba contiene un total de 240 afirmaciones.
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
        <form action="prueba_temp.php" method="post">
          <!--Preguntas -->
          <?php
            $pregunta = 1;
            $sql = "SELECT IDPregunta, TextoPregunta, formatos.Valor1, formatos.Valor2, 
                      formatos.Valor3, formatos.Valor4, formatos.Valor5 FROM preguntas
                      JOIN formatos ON formatos.IDFormato = preguntas.Formato;";
            $respuesta = $con->query($sql);
            for($for = $_SESSION['numPregunta']; $for<($_SESSION['cantPreguntas']+$_SESSION['numPregunta']); $for++ ){
              $respuesta->data_seek($for);
              $fila = $respuesta->fetch_assoc();
              ?>
              <div class="pregunta">
                <p><?php echo($fila['IDPregunta'].". ".$fila['TextoPregunta']);?></p>
                <div class="opciones">
                  <label class="contenedorRadio">
                    <input type="radio" name="radio<?php echo($pregunta);?>" value="<?php echo($fila['Valor1']); ?>"/>
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
          ?>
          <?php echo "num = ". $_SESSION['numPregunta'] . " cant = ".$_SESSION['cantPreguntas']; ?>
          <!--Botones de la prueba -->
          <div class="botonesPrueba">
            <button type="submit" name="btn" class="posicionIzquierda" value="1">GUARDAR</button>
            <button type="submit" name="btn" <?php if($siguiente){ echo "";} else { echo "disabled"; } ?> class="posicionDerecha" value="2">SIGUIENTE</button>
          </div>
        </form>
      </div>
    </div>
  </body>

</html>
