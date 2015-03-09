<?php
require_once('./administrar.php');
require_once('./class/footer.php');

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
	$footer = (new Footer)->buscar();

	if (isset($_GET["guardar"])){
		if ($_FILES["background"] != null){
			guardarImagen($_FILES["background"], './footer/background.png');
		}
		if ($_FILES["background1"] != null){
			guardarImagen($_FILES["background1"], './footer/background1.png');
		}
		if ($_FILES["background2"] != null){
			guardarImagen($_FILES["background2"], './footer/background2.png');
		}
		if ($_FILES["background3"] != null){
			guardarImagen($_FILES["background3"], './footer/background3.png');
		}		
		$footer->actualizar($_POST["texto1"], $_POST["link1"], $_POST["texto2"], $_POST["link2"], $_POST["texto3"], $_POST["link3"], $_POST["newsletter"], $_POST["colorHr"]);
	}
	
	$html["footer"] = $footer;
}


?>