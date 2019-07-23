<?php 

    function barraUsuario(){
        if(isset($_SESSION['usuario'])){
            $sql = "Call NombreCorreo(". $_SESSION['usuario'] .");";
            $con = conectar();
            if($respuesta = $con->query($sql)){
                $fila = $respuesta->fetch_assoc();
                ?>
                <li>
                    <a>Bienvenido: <?php echo $fila['Nombre']." ".$fila['Apellido1']." ".$fila['Apellido2']; ?></a>
                </li>
                <li>
                    <a href="cerrar.php">Cerrar Sessión</a>
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
                        <li>
                            <a href="examenesxfecha.php">evaluación</a>
                        </li>
                        <li>
                            <a href="fechaprueba.html">fechas</a>
                        </li>
                        <li>
                            <a href="preguntas.html">preguntas</a>
                        </li>
                        <li>
                            <a href="#">variables</a>
                        </li>
                    <?php
                    break;
                case 2://evaluación, fechas, preguntas, 
                    ?>
                        <li>
                            <a href="examenesxfecha.php">evaluación</a>
                        </li>
                        <li>
                            <a href="fechaprueba.html">fechas</a>
                        </li>
                        <li>
                            <a href="preguntas.html">preguntas</a>
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