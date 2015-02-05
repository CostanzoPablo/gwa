<?php
include_once('./class/conectar.php');

class General extends Conectar{
	public $color_fuente_banner;

    public function __construct() {
    	$pdo = new Conectar();
		$this->db = $pdo->db;
    }

	public function buscar(){
		$query = $this->db->prepare("SELECT * FROM general");		
		$query->execute(array());
		foreach ($query->fetchAll() as $row){
			$this->color_fuente_banner = $row["color_fuente_banner"];
		}			
		return $this;
	}

	public function actualizar($color_fuente_banner){
		$query = $this->db->prepare("UPDATE general SET color_fuente_banner = :color_fuente_banner");		
		$query->execute(array(':color_fuente_banner' => $color_fuente_banner));
		$this->color_fuente_banner = $color_fuente_banner;
		return $this;
	}

}
?>