<?php
include_once('./home.php');
include_once('./class/modulo.php');
include_once('./class/imagen.php');

$html["categoria"] = (new categoria)->buscarPorId($_GET["categoria"]);

if ($html["categoria"]->orden == 0){
	$html["images"] = getImagesForSlider();
}

$html["modulos"] = (new Modulo)->buscarPorCategoria($_GET["categoria"]);

?>