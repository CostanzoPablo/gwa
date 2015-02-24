<?php
require_once('./administrar.php');
require_once('./class/categoria.php');

$_GET["gestionar_categoria"] = '';

if ($html["error"] == null){
	$html["padresPrincipales"] = (new Categoria)->listarPadres();

	if (isset($_GET["crear"])){
		$categoria = (new Categoria)->buscarPorNombre($_POST["nombre"]);
		if ($categoria->nombre != null){
			$html["error"] = 'Ya existe un categoria con el nombre indicado';
		}else{
			if ($_POST["nombre"] == null){ 
				$html["error"] = 'Error. Completar el campo nombre';
			}else{
				$categoria = (new Categoria)->nuevo($_POST["nombre"], $_POST["padre"], $_POST["red"], $_POST["green"], $_POST["blue"]);
				$_GET["gestionar_categoria"] = $categoria->id;
			}
		}
	}
}	
?>