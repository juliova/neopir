<?php 

    function barraUsuario(){
        if(isset($_SESSION['usuario'])){
            $sql = "Call NombreCorreo(". $_SESSION['usuario'] .");";
            $con = conectar();
            if($respuesta = $con->query($sql)){
                $fila = $respuesta->fetch_assoc();
                ?>
                <li>
                    <a>Bienvenido: <?php echo $fila['Nombre']." ".$fila['Apellido1']; ?></a>
                </li>
                <li class="cerrarsesion">
                    <a href="cerrar.php">Cerrar Sesión</a>
                </li>
            <?php
            } else { ?> 
            <li>
                <a href="login.php">registro</a>
            </li>
            <li>
                <a href="login.php">iniciar sesión</a>
            </li>
            <?php
            } 
            $con->close();
        } else { ?> 
            <li>
                <a href="login.php">registro</a>
            </li>
            <li>
                <a href="login.php">iniciar sesión</a>
            </li>
        <?php
        }
    }
    
    function menu(){
        ?>
            <li>
              <a href="index.php">inicio</a>
            </li>
        <?php    
        if(isset($_SESSION['usuario'])){
            switch($_SESSION['Rol']){
                case 1://evaluación, fechas, preguntas, variables
                    ?>
                        <li class="itemDesplegable">
                            <a>reportes</a>
                            <ul>
                                <li><a href="reportesestudiantes.php">estudiantes</a></li>
                            </ul>
                        </li>
                    <?php
                    break;
                case 2://evaluación, fechas, preguntas, 
                    ?>
                        <li>
                            <a href="examenesxfecha.php">evaluación</a>
                        </li>
                        <li>
                            <a href="fechaprueba.php">fechas</a>
                        </li>
                        <li>
                            <a href="preguntas.php">preguntas</a>
                        </li>
                        <li>
                            <a href="mensajes.php">mensajes</a>
                        </li>
                        <li>
                            <a href="reenvio.php">tiquetes</a>
                        </li>
                        <li>
                            <a href="variables.php">variables</a>
                        </li>
                    <?php
                    break;
                case 3:// inicio, matricula, ingresoprueba;
                    ?>
                        <li>
                            <a href="matricula.php">matrícula</a>
                        </li>
                        <li>
                            <a href="ingresarprueba.php">prueba</a>
                        </li>
                    <?php
                    break;
            }
        }
    }

?>