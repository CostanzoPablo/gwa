<?php
include_once('./class/conectar.php');

class Footer extends Conectar{
	public $texto1, $texto2, $texto3, $link1, $link2, $link3, $background, $background1, $background2, $background3, $newsletter, $colorHr;

    public function __construct() {
    	$pdo = new Conectar();
		$this->db = $pdo->db;
    }

	public function buscar(){
		$query = $this->db->prepare("SELECT * FROM footer");		
		$query->execute(array());
		foreach ($query->fetchAll() as $row){
			$this->texto1 = $row["texto1"];
			$this->texto2 = $row["texto2"];
			$this->texto3 = $row["texto3"];
			$this->link1 = $row["link1"];
			$this->link2 = $row["link2"];
			$this->link3 = $row["link3"];
			$this->newsletter = $row["newsletter"];
			$this->colorHr = $row["colorHr"];
			if (file_exists('./footer/background.png')){
				$this->background = './footer/background.png';
			}else{
				$this->background = null;
			}
			if (file_exists('./footer/background1.png')){
				$this->background1 = './footer/background1.png';
			}else{
				$this->background1 = null;
			}
			if (file_exists('./footer/background2.png')){
				$this->background2 = './footer/background2.png';
			}else{
				$this->background2 = null;
			}			
			if (file_exists('./footer/background3.png')){
				$this->background3 = './footer/background3.png';
			}else{
				$this->background3 = null;
			}
		}			
		return $this;
	}

	public function actualizar($texto1, $link1, $texto2, $link2, $texto3, $link3, $newsletter, $colorHr){
		$query = $this->db->prepare("UPDATE footer SET texto1 = :texto1, texto2 = :texto2, texto3 = :texto3, link1 = :link1, link2 = :link2, link3 = :link3, newsletter = :newsletter, colorHr = :colorHr");		
		$query->execute(array(':texto1' => $texto1, ':texto2' => $texto2, 'texto3' => $texto3, 'link1' => $link1, 'link2' => $link2, 'link3' => $link3, 'newsletter' => $newsletter, 'colorHr' => $colorHr));
		$this->texto1 = $texto1;
		$this->texto2 = $texto2;
		$this->texto3 = $texto3;
		$this->link1 = $link1;
		$this->link2 = $link2;
		$this->link3 = $link3;
		$this->newsletter = $newsletter;
		$this->colorHr = $colorHr;		
		return $this;
	}

}
?>