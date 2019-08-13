<?php 
	use PHPMailer\PHPMailer\PHPMailer;
	use PHPMailer\PHPMailer\Exception;
	require "PHPMailer/src/Exception.php";
	require "PHPMailer/src/PHPMailer.php";
	require "PHPMailer/src/SMTP.php";

	function iniciarCorreo(){
		$ini = parse_ini_file("app.ini");
		$correo = new PHPMailer(TRUE);
		//Correo que hace el envío
		$correo->setFrom($ini['usuarioSmtp']);
		//configurar que use SMTP
		$correo->isSMTP();
		//Configurar host
		$correo->Host = $ini['hostSmtp'];
		//Utilizar autentificación
		$correo->SMTPAuth = TRUE;
		//Configurar sistema de encriptación
		$correo->SMTPSecure = $ini['seguridSmtp'];
		//usuario servidor SMTP
		$correo->Username = $ini['usuarioSmtp'];
		//Contraseña
		$correo->Password = $ini['contraSmtp'];
		//puerto SMTP
		$correo->Port = $ini['puertoSmtp'];
		//Configurar correo html
		$correo->isHTML(TRUE);
		return $correo;
	}

?>