<?php
include('./class/usuario.php');

$usuario = (new Usuario)->buscarPorMail($_POST["formIdentificarseMail"]);
if ($usuario->id == null){
	$html["identificarse"] = 'Error, E-mail o Clave incorrecta';
}else{
	if ($usuario->clave == $_POST["formIdentificarseClave"]){
		$_SESSION["usuario"] = $usuario->id;
		$html["identificarse"] = 'ok';
	}else{
		$html["identificarse"] = 'Error, E-mail o Clave incorrecta';
	}
}
?>