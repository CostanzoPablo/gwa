<?php
include_once('./class/categoria.php');

$html["categorias"] = (new Categoria)->listarPadres();

if (!(isset($_GET["categoria"]))){
	$html["images"] = getImagesForSlider();
	
	$_GET["categoria"] = $html["categorias"][0]["id"];
	include('./modulos.php');
}
?>