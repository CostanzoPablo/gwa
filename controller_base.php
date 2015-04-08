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
	case 'general':
		include('./general.php');
		echo $twig->render('general.html', $html);
		break;	
	case 'slider':
		include('./slider.php');
		echo $twig->render('slider.html', $html);
		break;		
	case 'footer':
		include('./footer.php');
		echo $twig->render('footer.html', $html);
		break;	
	case 'newsletter':
		include('./newsletter.php');
		echo $twig->render('newsletter.html', $html);
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
		echo $twig->render('modulos.html', $html);
		break;
}
?>