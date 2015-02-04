<?php
include_once('./home.php');
include_once('./class/modulo.php');

$html["modulos"] = (new Modulo)->buscarPorCategoria($_GET["categoria"]);

?>