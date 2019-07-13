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

        <!--Preguntas -->

        <?php
          
          $numero = 1;
          $texto = "Yo no soy una persona que se preocupa mucho. ";
          $char = ["so","o","n","c","cv"];
          echo("<div class=\"pregunta\">
                  <p>".$numero.". ". $texto."</p>
                  <div class=\"opciones\">");
          $valores = [0,1,2,3,4];
          for($i=0; $i<5; $i++){
            echo ("<label class=\"contenedorRadio\">
                    <input type=\"radio\" name=\"radio".$numero."\" value=\"".$valores[$i]."\">
                    <span class=\"botonRadio ".$char[$i]."\"></span>
                  </label>");
          }
          echo("  </div>
                </div>");
        ?>
        <!--Botones de la prueba -->
        <div class="botonesPrueba">
          <button class="posicionIzquierda">GUARDAR</button>
          <button class="posicionDerecha">SIGUIENTE</button>
        </div>

      </div>
    </div>
  </body>

</html>
