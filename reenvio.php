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

         
    

          <!--Reenvio-->
          <div>
            <form action="reenvio.php" method="POST">
              <div>
                <h1>Reenviar Correos</h1>
             
           
           
            
                <div class="columna1">
                  <label>Cedula:</label>
                </div>
                <div class="columna2">
                  <input type="text" name="cedula3" />
                </div>
            
            
      
                <div class="columna1">
                  <label>Tipo de Correos:</label>
                </div>

                <div class="columna2">
                  <select name="listbox" size=1>
         
                    <option value=1>Registro</option>
                    <option value=2>Matricula</option>
                    <option value=3>Resultado</option>
                    <option value=4>Final de Examen</option>
                    <option value=5>Recordatorio Matricula</option>
                  </select>
                </div>
              

            

              </div>
              <button class="posicionDerecha">Reenviar</button>
            </form>
          </div>
        </div>
      </div>
      <?php include 'error.php';?>
    </div>
  </body>

</html>