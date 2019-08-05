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
  if(isset($_POST['btn'])){
    $con = conectar();
    $sql = "CALL AnadirPregunta(".$_POST['numero'].",'".$_POST['texto']."','".$_POST['tipo']."',".$_POST['formato'].");";
    if($respuesta=$con->query($sql)){
        $_SESSION['mensaje'] = "Pregunta añadida exitosamente.";
        $_SESSION['tipoerror'] = 0;
    } else {
        $_SESSION['mensaje'] = "Error de conexión. Favor intentarlo más tarde";
        $_SESSION['tipoerror'] = 1;
    }
  }
?>
<!DOCTYPE html>
<html>

  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link type="text/css" rel="stylesheet" href="css/estilo.css" />
    <link type="text/css" rel="stylesheet" href="css/all.css" />
    <script src="js/jquery-3.4.1.min.js"></script>
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

        <!--Contenido-->
        <div class="contenido">
            <div class="seccionMedia">

                <!--Validacion-->
                <div>
                    <form  action="preguntasnueva.php" method="POST">
                        <div>
                            <?php 
                                $con = conectar();
                                $sql ="CALL datosPreguntas();";
                                $numero = 0;
                                if($respuesta = $con->query($sql)){
                                    $fila = $respuesta->fetch_assoc();
                                    $numero = $fila['total']+1;
                                } else {
                                    $_SESSION['mensaje'] = "Error de conexión. Favor intentarlo más tarde";
                                    $_SESSION['tipoerror'] = 1;
                                }
                                $con->close();
                            ?>
                            <h1>Añadir Pregunta</h1>
                            <div class="columna1">
                                <label>Número:</label>
                            </div>
                            <div class="columna2">
                                <input type="number" name="numero" value="<?php echo $numero; ?>" readonly />
                            </div>
                            <div class="columna1">
                                <label>Texto:</label>
                            </div>
                            <div class="columna2">
                                <textarea required name="texto" rows="4" placeholder="Texto de la pregunta"></textarea>
                            </div>
                        
                            <div class="columna1">
                                <label>Tipo de Pregunta:</label>
                            </div>
                            <div class="columna2">
                                <select name="tipo" required>
                                    <option></option>
                                    <option value="N1">N1</option>
                                    <option value="N2">N2</option>
                                    <option value="N3">N3</option>
                                    <option value="N4">N4</option>
                                    <option value="N5">N5</option>
                                    <option value="N6">N6</option>
                                    <option value="E1">E1</option>
                                    <option value="E2">E2</option>
                                    <option value="E3">E3</option>
                                    <option value="E4">E4</option>
                                    <option value="E5">E5</option>
                                    <option value="E6">E6</option>
                                    <option value="A1">A1</option>
                                    <option value="A2">A2</option>
                                    <option value="A3">A3</option>
                                    <option value="A4">A4</option>
                                    <option value="A5">A5</option>
                                    <option value="A6">A6</option>
                                    <option value="O1">O1</option>
                                    <option value="O2">O2</option>
                                    <option value="O3">O3</option>
                                    <option value="O4">O4</option>
                                    <option value="O5">O5</option>
                                    <option value="O6">O6</option>
                                    <option value="C1">C1</option>
                                    <option value="C2">C2</option>
                                    <option value="C3">C3</option>
                                    <option value="C4">C4</option>
                                    <option value="C5">C5</option>
                                    <option value="C6">C6</option>
                                </select>
                            </div>
                            <div class="columna1">
                                <label>Valores:</label>
                            </div>
                            <div class="columna2">
                                <select name="formato" required>
                                    <option></option>
                                    <option value="1">SO: 0,O: 1,N: 2,C: 3,CV: 4</option>
                                    <option value="2">SO: 4,O: 3,N: 2,C: 1,CV: 0</option>
                                </select>
                            </div>
                        </div>
                        <button type="submit" name="btn" class="posicionDerecha" value="1">Añadir</button>
                
                    </form>
                </div>
            </div>
        </div>
        <?php include 'error.php';?>
    </div>
  </body>

</html>