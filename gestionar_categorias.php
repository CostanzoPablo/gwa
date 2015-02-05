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