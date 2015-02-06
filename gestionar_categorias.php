<?php
require_once('./administrar.php');
require_once('./class/categoria.php');
require_once('./class/modulo.php');

if ($html["error"] == null){
	$html["padres"] = (new Categoria)->listarCompleto();
	$html["padresPrincipales"] = (new Categoria)->listarPadres();

	if (isset($_GET["gestionar_categoria"])){
		$categoria = (new Categoria)->buscarPorId($_GET["gestionar_categoria"]);
		if ($categoria->nombre == null){
			$html["error"] = 'Error, no se encuentra la categoria';
		}else{
			$html["categoria"] = $categoria;
			if (isset($_GET["actualizar_nombreYpadre"])){
				if ($_POST["nombre"] == null){ 
					$html["error"] = 'Error. Completar el campo nombre';
				}else{
					//actualizar...
					$categoria->editarNombre($_POST["nombre"]);
					$categoria->editarPadre($_POST["padre"]);
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
				$nuevoModulo = (new Modulo)->nuevo($categoria->id, '', '', '', '', '', $_POST["orden"], '', '');
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
				$nuevoModulo = (new Modulo)->nuevo($categoria->id, $_POST["titulo"], $_POST["alineacion"], $_POST["anchoTexto"], $_POST["anchoVideo"], $_POST["altoVideo"], $_POST["orden"], $_POST["texto"], $_POST["video"]);
				if ($_FILES["imagen"] != null){
					$nuevoModulo->guardarImagen($_FILES["imagen"], $_POST["anchoImagen"], $_POST["altoImagen"]);
				}
			}
			if (isset($_GET["editarModulo"])){
				$editarModulo = (new Modulo)->buscarPorId($_GET["editarModulo"]);
				$editarModulo->actualizar($_POST["titulo"], $_POST["alineacion"], $_POST["anchoTexto"], $_POST["anchoVideo"], $_POST["altoVideo"], $_POST["orden"], $_POST["texto"], $_POST["video"]);
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