<?php
include_once('./class/conectar.php');

class Imagen extends Conectar{
	public $id, $titulo, $descripcion, $red, $green, $blue;

    public function __construct() {
    	$pdo = new Conectar();
		$this->db = $pdo->db;
    }


	public function buscarPorModuloConImagen($modulo, $imagen){
		$query = $this->db->prepare("SELECT * FROM imagen WHERE imagen = :imagen AND modulo = :modulo");		
		$query->execute(array(':imagen' => $imagen, ':modulo' => $modulo));
		foreach ($query->fetchAll() as $row){
			$this->id = $row["id"];
			$this->titulo = $row["titulo"];
			$this->descripcion = $row["descripcion"];
			$this->red = $row["red"];
			$this->green = $row["green"];
			$this->blue = $row["blue"];
		}			
		return $this;
	}

	public function editarImagen($modulo, $imagen, $titulo, $descripcion, $red, $green, $blue){
		$query = $this->db->prepare("UPDATE imagen SET modulo = :modulo, imagen = :imagen, titulo = :titulo, descripcion = :descripcion, red = :red, green = :green, blue = :blue WHERE id = '$this->id'");		
		$query->execute(array(':modulo' => $modulo, ':imagen' => $imagen, ':titulo' => $titulo, ':descripcion' => $descripcion, ':red' => $red, ':green' => $green, ':blue' => $blue));
		$this->nombre = $nuevoNombre;
		return $this;
	}

	public function nuevo($modulo, $imagen, $titulo, $descripcion, $red, $green, $blue){
		$sql = "INSERT INTO imagen (modulo, imagen, titulo, descripcion, red, green, blue) VALUES (:modulo, :imagen, :titulo, :descripcion, :red, :green, :blue)";
		$query = $this->db->prepare( $sql );
		$query->execute(array(':modulo' => $modulo, ':imagen'=>$imagen, ':titulo'=>$titulo, ':descripcion'=>$descripcion, 'red'=>$red, 'green'=>$green, 'blue'=>$blue));		
		$this->id = $this->db->lastInsertId();
		$this->titulo = $titulo;
		$this->descripcion = $descripcion;
		$this->red = $red;
		$this->green = $green;		
		$this->blue = $blue;
		return $this;
	}

	public function eliminar(){
		$this->db->exec("DELETE FROM imagen WHERE id = '$this->id'");	
	}

}
?>