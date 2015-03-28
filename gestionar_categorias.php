<?php
require_once('./administrar.php');
require_once('./class/categoria.php');
require_once('./class/modulo.php');
include_once('./class/imagen.php');

if ($html["error"] == null){
	$html["padres"] = (new Categoria)->listarCompleto();
	$html["padresPrincipales"] = (new Categoria)->listarPadres();

	if (isset($_GET["gestionar_categoria"])){
		$categoria = (new Categoria)->buscarPorId($_GET["gestionar_categoria"]);
		if ($categoria->nombre == null){
			$html["error"] = 'Error, no se encuentra la categoria';
		}else{
			$html["categoria"] = $categoria;
			if (isset($_GET["eliminarPDF"])){
				unlink($_GET["eliminarPDF"]);
			}
			if (isset($_GET["editarPDF"])){
				for($i=0; $i<count($_FILES['pdfs']['name']); $i++) {
				  //Get the temp file path
				  $tmpFilePath = $_FILES['pdfs']['tmp_name'][$i];

				  //Make sure we have a filepath
				  if ($tmpFilePath != ""){
				    //Setup our new file path
				    if (!file_exists('pdf')) {
		    			mkdir('pdf', 0777, true);
					}
					if (!file_exists('pdf/'.$_GET["editarPDF"])) {
		    			mkdir('pdf/'.$_GET["editarPDF"], 0777, true);
					}					
				    $newFilePath = './pdf/'.$_GET["editarPDF"].'/'.$_FILES['pdfs']['name'][$i];

				    //Upload the file into the temp dir
				    if(move_uploaded_file($tmpFilePath, $newFilePath)) {
				    	//ok
				    }
				  }
				}
			}

			if (isset($_GET["eliminarImagenGaleria"])){
				$imagen = (new Imagen)->buscarPorModuloConImagen($_GET["eliminarImagenGaleria"], $_GET["imagen"]);
				if ($imagen->id != null){//crear	
					$imagen->eliminar();
				}
				unlink($_GET["imagen"]);
			}			
			if (isset($_GET["actualizar_nombreYpadre"])){
				if ($_POST["nombre"] == null){ 
					$html["error"] = 'Error. Completar el campo nombre';
				}else{
					//actualizar...
					$categoria->editarNombre($_POST["nombre"]);
					$categoria->editarPadre($_POST["padre"]);
					$categoria->editarColorFondo($_POST["rgb"]);
					$categoria->editarOrden($_POST["orden"]);
					$categoria->editarContacto($_POST["contacto"]);
				}
			}


			if (isset($_GET["editarImagenGaleria"])){
				//buscar si existe descripcion para la $_GET["imagen"] de la galeria $_GET["editarGaleria"]
				$imagen = (new Imagen)->buscarPorModuloConImagen($_GET["editarImagenGaleria"], $_GET["imagen"]);
				if ($imagen->id == null){//crear	
					$imagen = (new Imagen)->nuevo($_GET["editarImagenGaleria"], $_GET["imagen"], $_POST["titulo"], $_POST["descripcion"], $_POST["red"], $_POST["green"], $_POST["blue"]);
				}else{//editarla
					$imagen->editarImagen($_GET["editarImagenGaleria"], $_GET["imagen"], $_POST["titulo"], $_POST["descripcion"], $_POST["red"], $_POST["green"], $_POST["blue"]); 
				}
			}
			if (isset($_GET["editarGaleria"])){
				$modulo = (new Modulo)->buscarPorId($_GET["editarGaleria"]);
				$modulo->orden($_POST["orden"]);
				for($i=0; $i<count($_FILES['imagenes']['name']); $i++) {
				  //Get the temp file path
				  $tmpFilePath = $_FILES['imagenes']['tmp_name'][$i];

				  //Make sure we have a filepath
				  if ($tmpFilePath != ""){
				    //Setup our new file path
				    if (!file_exists('modulos')) {
		    			mkdir('modulos', 0777, true);
					}
					if (!file_exists('modulos/'.$modulo->id)) {
		    			mkdir('modulos/'.$modulo->id, 0777, true);
					}					
				    $newFilePath = './modulos/'.$modulo->id.'/'.$_FILES['imagenes']['name'][$i];

				    //Upload the file into the temp dir
				    if(move_uploaded_file($tmpFilePath, $newFilePath)) {
				    	//ok
				    }
				  }
				}
			}
			if (isset($_GET["agregarGaleria"])){
				$nuevoModulo = (new Modulo)->nuevo($categoria->id, '', '', '', '', '', $_POST["orden"], '', '', '');
				for($i=0; $i<count($_FILES['imagenes']['name']); $i++) {
				  //Get the temp file path
				  $tmpFilePath = $_FILES['imagenes']['tmp_name'][$i];

				  //Make sure we have a filepath
				  if ($tmpFilePath != ""){
				    //Setup our new file path
				    if (!file_exists('modulos')) {
		    			mkdir('modulos', 0777, true);
					}
					if (!file_exists('modulos/'.$nuevoModulo->id)) {
		    			mkdir('modulos/'.$nuevoModulo->id, 0777, true);
					}					
				    $newFilePath = './modulos/'.$nuevoModulo->id.'/'.$_FILES['imagenes']['name'][$i];

				    //Upload the file into the temp dir
				    if(move_uploaded_file($tmpFilePath, $newFilePath)) {
				    	//ok
				    }
				  }
				}
			}
			if (isset($_GET["agregarModulo"])){
				$nuevoModulo = (new Modulo)->nuevo($categoria->id, $_POST["titulo"], $_POST["alineacion"], $_POST["anchoTexto"], $_POST["anchoVideo"], $_POST["altoVideo"], $_POST["orden"], $_POST["texto"], $_POST["video"], $_POST["colorHr"]);
				if ($_FILES["imagen"] != null){
					$nuevoModulo->guardarImagen($_FILES["imagen"], $_POST["anchoImagen"], $_POST["altoImagen"]);
				}
			}
			if (isset($_GET["editarModulo"])){
				$editarModulo = (new Modulo)->buscarPorId($_GET["editarModulo"]);
				$editarModulo->actualizar($_POST["titulo"], $_POST["alineacion"], $_POST["anchoTexto"], $_POST["anchoVideo"], $_POST["altoVideo"], $_POST["orden"], $_POST["texto"], $_POST["video"], $_POST["colorHr"], $_POST["anchoImagen"], $_POST["altoImagen"]);
				if ($_FILES["imagen"] != null){
					unlink($editarModulo->imagen);
					$editarModulo->guardarImagen($_FILES["imagen"], $_POST["anchoImagen"], $_POST["altoImagen"]);
				}
			}
			if (isset($_GET["eliminarModulo"])){			
				$eliminarModulo = (new Modulo)->buscarPorId($_GET["eliminarModulo"]);
				unlink($eliminarModulo->imagen);
				$eliminarModulo->eliminar();
			}
			$html["modulos"] = (new Modulo)->buscarPorCategoria($categoria->id);
			if (isset($_GET["eliminarCategoria"])){			
				$eliminarModulos = (new Modulo)->buscarPorCategoria($categoria->id);
				foreach ($eliminarModulos as $key => $value) {
					$eliminarModulo = (new Modulo)->buscarPorId($value["id"]);
					unlink($eliminarModulo->imagen);
					$eliminarModulo->eliminar();
				}
				$categoria->eliminar();
				$html["categoria"] = null;
				$html["padres"] = (new Categoria)->listarCompleto();
			}			
			
		}
	}
}
?>