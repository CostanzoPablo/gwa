<?php
include_once('./home.php');
include_once('./class/modulo.php');
include_once('./class/imagen.php');

$html["categoria"] = (new categoria)->buscarPorId($_GET["categoria"]);
$html["modulos"] = (new Modulo)->buscarPorCategoria($_GET["categoria"]);

?>