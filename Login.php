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

          <!--Login-->
          <div>
            <form action="rlogin.php" method="post" >
              <div>

                <h1>Login</h1>
                <div class="columna1">
                  <label>Cedula</label>
                </div>
                <div class="columna2">
                  <input type="text" name="cedula" required/>
                </div>
                <div class="columna1">
                  <label>Contraseña</label>
                </div>
                <div class="columna2">
                  <input type="password" name="contra" required/>
                </div>
              </div>
              <button class="seccionMedia">Iniciar Sesion</button>
            </form>
          </div>

          <!--Registro-->
          <div>
            <form action="registro.php" method="post">
              <div>
                <h1>Registro</h1>
                <div class="columna1">
                  <label>Nombre:</label>
                </div>
                <div class="columna2">
                  <input type="text" name="nombre" required/>
                </div>
                <div class="columna1">
                  <label>Primer Apellido:</label>
                </div>
                <div class="columna2">
                  <input type="text" name="apellidos1" required/>
                </div>
                <div class="columna1">
                  <label>Segundo Apellido:</label>
                </div>
                <div class="columna2">
                  <input type="text" name="apellidos2" required/>
                </div>
                <div class="columna1">
                  <label>Cedula:</label>
                </div>
                <div class="columna2">
                  <input type="text" name="cedula2" required/>
                </div>
                <div class="columna1">
                  <label>Correo:</label>
                </div>
                <div class="columna2">
                  <input type="text" name="correo" required/>
                </div>
                <div class="columna1">
                  <label>Contraseña:</label>
                </div>
                <div class="columna2">
                  <input type="password" name="contra2" required/>
                </div>
                <div class="columna1">
                  <label></label>
                </div>
                <div class="columna2">
                  <input type="password" name="contraC" required placeholder="Confirmar contraseña"/>
                </div>
                <div class="columna1">
                  <label>Sexo:</label>
                </div>

                <div class="columna2">
                  <label class="contenedorRadioCheck">
                    <input value= "Hombre" type="radio" name="radio" required>
                    <span class="radioCheck radioH"></span>
                  </label>
                  <label class="contenedorRadioCheck">
                    <input value = "Mujer" type="radio" name="radio" required>
                    <span class="radioCheck radioM"></span>
                  </label>
                </div>

              </div>
              <button id="registro" disabled class="posicionDerecha">Registro</button>
            </form>
          </div>
        </div>
      </div>
      <?php include 'error.php'; ?>
    </div>
  </body>

</html>
