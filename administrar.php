<?php
require_once('./class/usuario.php');

$html["error"] = '';

$usuario = (new Usuario)->buscarPorId($_SESSION["usuario"]);
if ($usuario->id == null){
	$html["error"] = 'Se perdio la sesion. Volver a identificarse';
}
?>