<?php
include_once('./class/conectar.php');

function agregarCategorias($categorias, $categoriasAux, $camino){
	foreach ($categoriasAux as $key => $value) {
		$categoriasAux[$key]["camino"] = $camino;
		$categorias[] = $categoriasAux[$key];
		if ($categoriasAux[$key]["hijas"] != NULL){
			$categorias = agregarCategorias($categorias, $categoriasAux[$key]["hijas"], $camino.'->'.$categoriasAux[$key]["nombre"]);
		}
	}
	return $categorias;
}

function cmp($a, $b){
    if ($a["hijas"] == $b["hijas"]) {
        return 0;
    }
    return ($a["hijas"] > $b["hijas"]) ? -1 : 1;
}

class Categoria extends Conectar{
	public $id, $nombre, $padre, $baja, $red, $blue, $green;

    public function __construct() {
    	$pdo = new Conectar();
		$this->db = $pdo->db;
    }


	public function buscarPorId($id_categoria){
		$query = $this->db->prepare("SELECT * FROM categorias WHERE id = :id");		
		$query->execute(array(':id' => $id_categoria));
		foreach ($query->fetchAll() as $row){
			$this->id = $row["id"];
			$this->nombre = $row["nombre"];
			$this->padre = $row["padre"];
			$this->baja = $row["baja"];
			$this->red = $row["red"];
			$this->green = $row["green"];
			$this->blue = $row["blue"];
		}			
		return $this;
	}

	public function buscarPorNombre($nombre_categoria){
		$query = $this->db->prepare("SELECT * FROM categorias WHERE id = :id");		
		$query->execute(array(':nombre' => $nombre_categoria));
		foreach ($query->fetchAll() as $row){
			$this->id = $row["id"];
			$this->nombre = $row["nombre"];
			$this->padre = $row["padre"];
			$this->baja = $row["baja"];
		}			
		return $this;
	}

	public function editarNombre($nuevoNombre){
		$query = $this->db->prepare("UPDATE categorias SET nombre = :nombre WHERE id = '$this->id'");		
		$query->execute(array(':nombre' => $nuevoNombre));
		$this->nombre = $nuevoNombre;
		return $this;
	}

	public function editarPadre($nuevoPadre){
		$query = $this->db->prepare("UPDATE categorias SET padre = :padre WHERE id = '$this->id'");		
		$query->execute(array(':padre' => $nuevoPadre));
		$this->padre = $nuevoPadre;
		return $this;
	}

	public function editarColorFondo($red, $green, $blue){
		$query = $this->db->prepare("UPDATE categorias SET red = :red, green = :green, blue = :blue WHERE id = '$this->id'");		
		$query->execute(array(':red' => $red, ':green' => $green, ':blue' => $blue));
		$this->padre = $nuevoPadre;
		$this->red = $red;
		$this->green = $green;
		$this->blue = $blue;
		return $this;
	}

	public function nuevo($nombre, $padre, $red, $green, $blue){
		$sql = "INSERT INTO categorias (nombre, padre, red, green, blue) VALUES (:nombre, :padre, :red, :green, :blue)";
		$query = $this->db->prepare( $sql );
		$query->execute(array(':nombre'=>$nombre, ':padre'=>$padre, 'red'=>$red, 'green'=>$green, 'blue'=>$blue));		
		$this->id = $this->db->lastInsertId();
		$this->nombre = $nombre;
		$this->padre = $padre;
		$this->red = $red;
		$this->green = $green;		
		$this->blue = $blue;
		return $this;
	}

	public function eliminar(){
		$this->db->exec("DELETE FROM categorias WHERE id = '$this->id'");	
	}

	public function listarPadres(){
		$categorias = null;
		$query = $this->db->prepare("SELECT * FROM categorias WHERE padre = :padre AND baja = :baja");		
		$query->execute(array(':padre' => 0, ':baja' => 0));
		foreach ($query->fetchAll() as $row){
			$row["hijas"] = $this->dameHijas($row["id"]);
			$categorias[] = $row;
		}			
		return $categorias;
	}

	public function dameHijas($unPadre){
		$categorias = null;
		$query = $this->db->prepare("SELECT * FROM categorias WHERE padre = :padre");		
		$query->execute(array(':padre' => $unPadre));
		foreach ($query->fetchAll() as $row){
			$row["hijas"] = $this->dameHijas($row["id"]);
			$categorias[] = $row;
		}			
		return $categorias;
	}

	public function listarCompleto(){
		$categoriasAux = $this->listarPadres();
		usort($categoriasAux, "cmp");
		if ($categoriasAux){
			foreach ($categoriasAux as $key => $value) {
				$categoriasAux[$key]["camino"] = '';
				$categorias[] = $categoriasAux[$key];
				if ($categoriasAux[$key]["hijas"] != NULL){
					$categorias = agregarCategorias($categorias, $categoriasAux[$key]["hijas"], $categoriasAux[$key]["nombre"]);
				}
			}
		}

		return $categorias;
	}
}
?>