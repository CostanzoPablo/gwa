<?php
require_once('./administrar.php');
require_once('./class/general.php');

function getExtension($str) {
	$i = strrpos($str,".");
	if (!$i) { return ""; } 

	$l = strlen($str) - $i;
	$ext = substr($str,$i+1,$l);
	return $ext;
}

function guardarImagen($imagen, $ruta){
    $uploadedfile = $imagen['tmp_name'];
    $image = $imagen["name"];
		if ($image){
		$size=filesize($imagen['tmp_name']);
		$filename = stripslashes($imagen['name']);
	    $extension = strtolower(getExtension($filename));
		if (($extension != "jpg") && ($extension != "jpeg") && ($extension != "png") && ($extension != "gif")){
			return 'Solo se permiten formatos JPG, JPEG, PNG y GIF';
		}else{	    
			switch ($extension){
				case 'jpg':
					$src = imagecreatefromjpeg($uploadedfile);
					break;
				case 'jpeg':
					$src = imagecreatefromjpeg($uploadedfile);
					break;
				case 'png':
					$src = imagecreatefrompng($uploadedfile);
					break;
				case 'gif':
					$src = imagecreatefromgif($uploadedfile);
					break;																		
			}
		}
		$tmp_name = $imagen["tmp_name"];
        move_uploaded_file($tmp_name, $ruta);
	}
}		

if ($html["error"] == null){
	$general = (new General)->buscar();

	if (isset($_POST["color_fuente_banner"])){
		if ($_FILES["background"] != null){
			guardarImagen($_FILES["background"], './images/background.png');
		}
		if ($_FILES["banner"] != null){
			guardarImagen($_FILES["banner"], './images/banner.png');
		}	
		if ($_FILES["logo"] != null){
			guardarImagen($_FILES["logo"], './images/logo.png');
		}		
		$general->actualizar($_POST["color_fuente_banner"], $_POST["colorHr"]);
	}
	
	$html["general"] = $general;
}


?>