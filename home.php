<?php
include_once('./class/categoria.php');

$html["categorias"] = (new Categoria)->listarPadres();

?>