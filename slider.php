<?php
require_once('./administrar.php');

$html["images"] = getImagesForSlider();

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
        move_uploaded_file($tmp_name, $ruta.time().'.'.$extension);
	}
}		

if ($html["error"] == null){

	if (!file_exists('slider')) {
		mkdir('slider', 0777, true);
	}

	if ($_FILES["slider"] != null){
		guardarImagen($_FILES["slider"], './slider/');
		$html["images"] = getImagesForSlider();
	}	

	if ($_GET["eliminar"]){
		$eliminar = false;
		foreach ($html["images"] as $key => $value) {
			if ($value["url"] == $_GET["eliminar"]){
				unlink($value["url"]);
			}
		}
		$html["images"] = getImagesForSlider();
	}

	

}


?>