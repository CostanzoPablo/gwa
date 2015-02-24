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
			$this->colorHr = $row["colorHr"];
		}			
		return $this;
	}

	public function actualizar($color_fuente_banner, $colorHr){
		$query = $this->db->prepare("UPDATE general SET color_fuente_banner = :color_fuente_banner, colorHr = :colorHr");		
		$query->execute(array(':color_fuente_banner' => $color_fuente_banner, 'colorHr' => $colorHr));
		$this->color_fuente_banner = $color_fuente_banner;
		$this->colorHr = $colorHr;		
		return $this;
	}

}
?>