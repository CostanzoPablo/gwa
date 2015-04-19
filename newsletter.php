<?php

if (isset($_POST["email"]) AND $_POST["email"] != NULL){
	$message = '<html>
	<body bgcolor="FFFFFF">
	  Agregar al newsletter a: '.$_POST["email"].'
	  <br><br>
	  Saludos<br>
	  <br>	
	</body>
	</html>';

	// Add the content headers
	$headers  = 'MIME-Version: 1.0' . "\r\n";
	$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

	$headers .= 'To: '.$html["footer"]->newsletter.' <'.$html["footer"]->newsletter.'>' . "\r\n";
	$headers .= 'From: '.$html["footer"]->newsletter.' <'.$html["footer"]->newsletter.'>' . "\r\n";

	mail($html["footer"]->newsletter, 'Newsletter - ', $message, $headers);

}else{
	$html["error"] = 'Completar el campo e-mail !';
}

?>