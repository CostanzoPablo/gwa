<?php
include_once('./class/conectar.php');

class General extends Conectar{
	public $float_logo, $color_fuente_banner, $colorHr;

    public function __construct() {
    	$pdo = new Conectar();
		$this->db = $pdo->db;
    }

	public function buscar(){
		$query = $this->db->prepare("SELECT * FROM general");		
		$query->execute(array());
		foreach ($query->fetchAll() as $row){
			$this->float_logo = $row["float_logo"];
			$this->color_fuente_banner = $row["color_fuente_banner"];
			$this->colorBotonHover = $row["colorBotonHover"];
			$this->colorHr = $row["colorHr"];
			$this->facebook = $row["facebook"];
			$this->twitter = $row["twitter"];
			$this->google = $row["google"];
		}			
		return $this;
	}

	public function actualizar($float_logo, $color_fuente_banner, $colorBotonHover, $colorHr, $facebook, $twitter, $google){
		$query = $this->db->prepare("UPDATE general SET float_logo = :float_logo, color_fuente_banner = :color_fuente_banner, colorBotonHover = :colorBotonHover, colorHr = :colorHr, facebook = :facebook, twitter = :twitter, google = :google");		
		$query->execute(array(':float_logo' => $float_logo, ':color_fuente_banner' => $color_fuente_banner, 'colorBotonHover' => $colorBotonHover, 'colorHr' => $colorHr, 'facebook' => $facebook, 'twitter' => $twitter, 'google' => $google));
		$this->float_logo = $float_logo;
		$this->color_fuente_banner = $color_fuente_banner;
		$this->colorBotonHover = $colorBotonHover;		
		$this->colorHr = $colorHr;		
		$this->facebook = $facebook;		
		$this->twitter = $twitter;		
		$this->google = $google;				
		return $this;
	}

}
?>