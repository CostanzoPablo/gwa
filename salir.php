<?php
include('./class/usuario.php');
$usuario = (new Usuario)->buscarPorId($_SESSION["usuario"]);
$html['saludo'] = 'Hasta la proxima !'; 
$_SESSION["usuario"] = null;
?>