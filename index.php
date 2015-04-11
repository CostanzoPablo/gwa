<?php
	session_start();
	ini_set('display_errors', true);
	//error_reporting(E_ALL);

	require_once './vendor/autoload.php';
	Twig_Autoloader::register();
	
	$loader = new Twig_Loader_Filesystem('./templates');
	$twig = new Twig_Environment($loader, array(
	    //'cache' => './cache',
	    'cache' => false,
	));

	include_once('./funciones.php');

	require_once('./class/general.php');
	$html["general"] = (new General)->buscar();

	require_once('./class/footer.php');
	$html["footer"] = (new Footer)->buscar();
	
	include('./controller_base.php');
?>