<?php 
  session_start();
  include 'Base.php';
  include '_menu.php';
  if(isset($_SESSION['Rol'])){
    if($_SESSION['Rol']!=3){
      header("Location: index.php");
    }
  } else {
    header("Location: index.php");
  }
  if(isset($_POST['btn'])){
    $conn= conectar();
    $sql = "Call ActualizarCorreo(".$_SESSION['usuario'].",'".$_POST['correo']."');";
    if($respuesta = $conn->query($sql)){
      $_SESSION['mensaje'] = "Correo actualizado con exito.";
      $_SESSION['tipoerror'] = 0;
    }else{
      $_SESSION['mensaje'] = "error al actualizar el correo.";
      $_SESSION['tipoerror'] = 1;
    }
  $conn->close();
  }
  $correo ="";
  $conn= conectar();
  $sql = "Call NombreCorreo(". $_SESSION['usuario'] .");";
  if($respuesta = $conn->query($sql)){
    $fila = $respuesta->fetch_assoc();
    $correo=$fila['Correo'];
  }
  $conn->close();
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

          <!--Login-->
          <div>
            <form action="usuario.php" method="post" >
              <div>

                <h1>Actualizar correo</h1>
                <div class="columna1">
                  <label>Correo</label>
                </div>
                <div class="columna2">
                  <input type="text" name="correo" value="<?php echo $correo ?>" required/>
                </div>
              </div>
              <button type="input" value="1" name="btn" class="seccionMedia">Actualizar</button>
            </form>
          </div>

          <!--Registro-->
          <div>
              <div>
                <?php 
          $con = conectar();
          $sql = "CALL MatriculaUsuario(".$_SESSION['usuario'].",'".date("Y-m-d h:i:s")."');";
          if($respuesta = $con->query($sql)){
              $fila = $respuesta->fetch_assoc()
                ?>
                <div class="ficha">
                  <div class="head">
                    <?php
                      echo date("d/m/Y",strtotime($fila['Fechar'])); 
                    ?>
                  </div>
                  <div class="cuerpo">
                    <ul>
                      <li>Hora Inicio: <?php echo date("h:i:s A",strtotime($fila['Fechar'])); ?></li>
                      <li>Hora Final: <?php echo date("h:i:s A",strtotime($fila['fechaF'])); ?></li>
                    </ul>
                  </div>
                </div>
                <?php
              } else {
            $_SESSION['mensaje'] = "Error de conexión. Favor intentarlo de nuevo";
            $_SESSION['tipoerror'] = 1;
          }
        ?>
              </div>
          </div>
        </div>
      </div>
      <?php include 'error.php'; ?>
    </div>
  </body>

</html>