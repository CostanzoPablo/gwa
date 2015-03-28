<?php
	include('./class/conectar.php');
	include('./class/categoria.php');
	
	$destinatario = (new categoria)->buscarPorId($_GET["categoria"])->contacto;
	
	if ($destinatario){
		$message = '<html>
		<body bgcolor="C0C0C0">
		  Apellido y Nombre: '.$_POST["apellido"].'<br><br>
		  Asunto: '.$_POST["asunto"].'<br><br>
		  Mensaje: '.$_POST["mensaje"].'<br><br>
		  <br><br><br>
		</body>
		</html>';

		// Add the content headers
		$headers  = 'MIME-Version: 1.0' . "\r\n";
		$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

		$headers .= 'To: '.$destinatario.' <'.$destinatario.'>' . "\r\n";
		$headers .= 'From: WEB <'.$destinatario.'>' . "\r\n";

		mail($destinatario, 'Nuevo mensaje - '.date("d/m/Y", time()), $message, $headers);
	}
?>