<?php
	include('./class/conectar.php');
	include('./class/categoria.php');
	
	$destinatario = (new categoria)->buscarPorId($_GET["categoria"])->contacto;
	
	if ($destinatario){
		$message = '<html>
		<body bgcolor="C0C0C0">
		  Apellido y Nombre: '.$_POST["apellido"].'<br><br>
		  Empresa: '.$_POST["empresa"].'<br><br>
		  Email: '.$_POST["email"].'<br><br>
		  Ciudad: '.$_POST["ciudad"].'<br><br>
		  Pais: '.$_POST["pais"].'<br><br>
		  Telefono: '.$_POST["telefono"].'<br><br>
		  Comentarios: '.$_POST["comentarios"].'<br><br>
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