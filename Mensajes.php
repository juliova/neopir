<?php 
  session_start();
  include 'Base.php';
  include '_menu.php';
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
            <form  method="POST">
              <div>
                <h1>Modificar Mensajes</h1>
             
           
           
            
                <div class="columna1">
                  <label>Mensaje:</label>
                </div>
                <div class="columna2">
                  <textarea name="Mensaje" rows="10" cols="50">Texto del mensaje del correo</textarea>
                </div>
            
                <div class="columna1">
                  <label>Tipo de Correos:</label>
                </div>

                <div class="columna3">
                  <label class="contenedorRadioCheck">
                    <input value= "1" type="radio" name="radio">
                    <span class="radioCheck"></span>
                  </label>
                  <label class="contenedorRadioCheck">
                    <input value = "2" type="radio" name="radio">
                    <span class="radioCheck"></span>
                  </label>
                </div>
              

            

              </div>
             
              <button class="posicionDerecha">Guardar</button>
              <button  class="posicionDerecha">Cargar</button>
         
            </form>
          </div>
        </div>
      </div>
      <?php include 'error.php';?>
    </div>
  </body>

</html>