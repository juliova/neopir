<?php 
    function conectar(){
        //Obtener variables del archivo de configuración
        $ini = parse_ini_file("app.ini");
        //Crear la conexión con los datos.
        $con = mysqli_connect($ini["urlBase"],$ini["usuarioBase"],
            $ini["contraBase"], $ini["nombreBase"]);
        //Revisar que funcione la conexión.
        if($con->connect_errno){
            echo "Fallo al conectar a la base.";
        }
        //Cambiar idioma para poder escribir las letras como 'ñ'
        $con->set_charset("utf8");
        //Devolver la conexión
        return $con;
    }
?>