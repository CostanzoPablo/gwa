<?php
$html["seccion"] = $_GET["seccion"];
$html["usuario"] = $_SESSION["usuario"];
switch($_GET["seccion"]){
	case 'categorias':
		include('./modulos.php');
		echo $twig->render('modulos.html', $html);			
		break;			
	case 'identificarse':
		include('./identificarse.php');
		echo json_encode($html);
		break;	
	case 'administrar':
		include('./administrar.php');
		echo $twig->render('administrar.html', $html);
		break;		
	case 'nueva_categoria':
		include('./nueva_categoria.php');
		if ($_GET["gestionar_categoria"] == null){
			echo $twig->render('nueva_categoria.html', $html);
		}else{
			include('./gestionar_categorias.php');
			echo $twig->render('gestionar_categorias.html', $html);			
		}
		break;	
	case 'gestionar_categorias':
		include('./gestionar_categorias.php');
		echo $twig->render('gestionar_categorias.html', $html);			
		break;							
	case 'salir':
		include('./salir.php');
		echo $twig->render('salir.html', $html);
		break;							
	default:
		include('./home.php');
		$html['variable'] = 'mensaje'; 
		echo $twig->render('home.html', $html);
		break;
}
?>