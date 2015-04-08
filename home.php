<?php
include_once('./class/categoria.php');

$html["categorias"] = (new Categoria)->listarPadres();

if (!(isset($_GET["categoria"]))){
	function getImagesForSlider(){
		$images = null;
		foreach (glob('./slider/*.*') as $key => $value) {
			$image["url"] = $value;
			$image["number"] = count($images);
			if (count($images) == 0){
				$image["active"] = 'active';
			}else{
				$image["active"] = '';
			}
			$images[] = $image;
		}	
		return $images;
	}

	$html["images"] = getImagesForSlider();
	
	$_GET["categoria"] = $html["categorias"][0]["id"];
	include('./modulos.php');
}
?>