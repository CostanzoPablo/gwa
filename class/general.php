<?php
include_once('./class/conectar.php');

class General extends Conectar{
	public $float_logo, $color_fuente_banner, $colorHr, $colorPDF, $fontFace, $colorSubMenu;

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
			$this->colorPDF = $row["colorPDF"];
			$this->facebook = $row["facebook"];
			$this->twitter = $row["twitter"];
			$this->youtube = $row["youtube"];
			$this->fontFace = $row["fontFace"];
			$this->colorSubMenu = $row["colorSubMenu"];
		}			
		return $this;
	}

	public function actualizar($float_logo, $color_fuente_banner, $colorBotonHover, $colorHr, $colorPDF, $facebook, $twitter, $youtube, $fontFace, $colorSubMenu){
		$query = $this->db->prepare("UPDATE general SET float_logo = :float_logo, color_fuente_banner = :color_fuente_banner, colorBotonHover = :colorBotonHover, colorHr = :colorHr, colorPDF = :colorPDF, facebook = :facebook, twitter = :twitter, youtube = :youtube, fontFace = :fontFace, colorSubMenu = :colorSubMenu");		
		$query->execute(array(':float_logo' => $float_logo, ':color_fuente_banner' => $color_fuente_banner, 'colorBotonHover' => $colorBotonHover, 'colorHr' => $colorHr, 'colorPDF' => $colorPDF, 'facebook' => $facebook, 'twitter' => $twitter, 'youtube' => $youtube, 'fontFace' => $fontFace, 'colorSubMenu' => $colorSubMenu));
		$this->float_logo = $float_logo;
		$this->color_fuente_banner = $color_fuente_banner;
		$this->colorBotonHover = $colorBotonHover;		
		$this->colorHr = $colorHr;		
		$this->colorPDF = $colorPDF;		
		$this->facebook = $facebook;		
		$this->twitter = $twitter;		
		$this->youtube = $youtube;				
		$this->fontFace = $fontFace;						
		$this->colorSubMenu = $colorSubMenu;						
		return $this;
	}

}
?>