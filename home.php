<?php
include_once('./class/categoria.php');

$html["categorias"] = (new Categoria)->listarPadres();

$_GET["categoria"] = $html["categorias"][0]["id"];

echo $_GET["categoria"];
include('./modulos.php');
?>