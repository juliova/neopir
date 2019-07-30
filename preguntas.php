<?php
session_start();
  include 'Base.php';
  include '_menu.php';
  $con = conectar();
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
          <th>Posicion</th>
          <th>Pregunta</th>
          <th>Opciones</th>
        </tr>
        <?php
	$consulta = "SELECT * from preguntas";

	$ejecutar =mysqli_query($con,$consulta);

	$i = 0;
	while($fila = mysqli_fetch_array($ejecutar)){
	$id = $fila['IDPregunta'];
	$texto =$fila['TextoPregunta'];
        $i++;
	?>
	<tr>
	<td><?php echo $id; ?></td>
	<td><?php echo $texto; ?></td>	
	<td> <a href = "preguntas.php?editar=<?php echo $id; ?>">Editar</a></td>
	</tr>
        <?php } ?>
      </table>
    	
    </div>
  </div>
</body>

</html>