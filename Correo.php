<?php 
	use PHPMailer\PHPMailer\PHPMailer;
	use PHPMailer\PHPMailer\Exception;
	require "PHPMailer/src/Exception.php";
	require "PHPMailer/src/PHPMailer.php";
	require "PHPMailer/src/SMTP.php";

	function iniciarCorreo(){
		$con = conectar();
		$sql = "Call variables();";
		$correo = new PHPMailer(TRUE);
		if($respuesta = $con->query($sql)){
			$fila = $respuesta->fetch_assoc();
			//Correo que hace el envío
			$correo->setFrom($fila['correoSmtp']);
			//configurar que use SMTP
			$correo->isSMTP();
			//Configurar host
			$correo->Host = $fila['hostSmtp'];
			//Utilizar autentificación
			$correo->SMTPAuth = TRUE;
			//Configurar sistema de encriptación
			$correo->SMTPSecure = $fila['seguridadSmtp'];
			//usuario servidor SMTP
			$correo->Username = $fila['correoSmtp'];
			//Contraseña
			$correo->Password = $fila['contraSmtp'];
			//puerto SMTP
			$correo->Port = $fila['puertoSmtp'];
			//Configurar correo html
			$correo->isHTML(TRUE);
		}
		
		$con->close();
		return $correo;
	}

?>