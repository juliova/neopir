<?php
session_start();
  include 'Base.php';
  include '_menu.php';
  
  if(!isset($_SESSION['totalPreguntas'])){
    $con = conectar();
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

  if(isset($_GET['indice'])){
    $_SESSION['numPregunta'] = 1;
    for($i = 2; $i<=$_GET['indice']; $i++){
      $_SESSION['numPregunta'] += $_SESSION['cantPreguntas'];
    }
  } else {
    $_SESSION['numPregunta'] = 1;
  }

?>

<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Afirmaciones</title>
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
      <div class="flexCentro">
        <button class="button button2">Agregar Pregunta</button>
      </div>
      <!--Lista-->
      <table class="tablaB">
        <tr>
          <th>#</th>
          <th>Pregunta</th>
          <th>Tipo</th>
          <th>Opciones</th>
        </tr>
        <?php
        $con = conectar();
        //$consulta = "SELECT * from preguntas";
        $consulta = "CALL PreguntasPrueba(".$_SESSION['numPregunta'].");";
        $ejecutar = mysqli_query($con,$consulta);

        $i = 0;
        while($fila = mysqli_fetch_array($ejecutar)){
          $id = $fila['IDPregunta'];
          $texto =$fila['TextoPregunta'];
          $tipo = $fila['Tipo'];
                $i++;
          ?>
          <tr>
          <td><?php echo $id; ?></td>
          <td><?php echo $texto; ?></td>
          <td><?php echo $tipo; ?></td>
          <td> <a href = "preguntas.php?editar=<?php echo $id; ?>">Editar</a></td>
          </tr>
        <?php } ?>
      </table>
      <ul class="paginacion">
      <?php
      $paginas = $_SESSION['totalPreguntas']/$_SESSION['cantPreguntas'];
      for($i=1; $i<=$paginas; $i++){
        ?>
        <li 
          <?php 
          if(!isset($_GET['indice'])){
            if($_SESSION['numPregunta']==1 && $i==1){
              echo "class='actual'"; 
            }
          }else{
            if($i==$_GET['indice']){ 
              echo "class='actual'"; 
            } 
          }
          ?>>
          <a href="preguntas.php?indice=<?php echo $i; ?>"><?php echo $i; ?></a>
        </li>
        <?php 
      }?>
      </ul>
    </div>
    <?php include 'error.php'; ?>
  </div>
</body>

</html>