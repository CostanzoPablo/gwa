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
	public $id, $nombre, $padre, $rgb, $orden, $contacto, $pdfs;

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
			$this->rgb = $row["rgb"];
			$this->orden = $row["orden"];
			$this->contacto = $row["contacto"];
			$directory = './pdf/'.$row["id"].'/';
			$pdfs = glob($directory . "*.*");
			foreach($pdfs as $pdf){
				$pdfAdapter["pdf"] = $pdf;
				$pdfAdapter["nombre"] = basename($pdf);
				$this->pdfs[] = $pdfAdapter;
			}					
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
			$this->orden = $row["orden"];
			$this->contacto = $row["contacto"];
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

	public function editarColorFondo($rgb){
		$query = $this->db->prepare("UPDATE categorias SET rgb = :rgb WHERE id = '$this->id'");		
		$query->execute(array(':rgb' => $rgb));
		$this->rgb = $rgb;
		return $this;
	}

	public function editarOrden($orden){
		$query = $this->db->prepare("UPDATE categorias SET orden = :orden WHERE id = '$this->id'");		
		$query->execute(array(':orden' => $orden));
		$this->orden = $orden;
		return $this;
	}

	public function editarContacto($contacto){
		$query = $this->db->prepare("UPDATE categorias SET contacto = :contacto WHERE id = '$this->id'");		
		$query->execute(array(':contacto' => $contacto));
		$this->contacto = $contacto;
		return $this;
	}

	public function nuevo($nombre, $padre, $rgb){
		$sql = "INSERT INTO categorias (nombre, padre, rgb, orden) VALUES (:nombre, :padre, :rgb, :orden)";
		$query = $this->db->prepare( $sql );
		$query->execute(array(':nombre'=>$nombre, ':padre'=>$padre, 'rgb'=>'0', 'orden'=>'0'));		
		$this->id = $this->db->lastInsertId();
		$this->nombre = $nombre;
		$this->padre = $padre;
		$this->rgb = '0';
		$this->orden = '0';
		return $this;
	}

	public function eliminar(){
		$this->db->exec("DELETE FROM categorias WHERE id = '$this->id'");	
	}

	public function listarPadres(){
		$categorias = null;
		$query = $this->db->prepare("SELECT * FROM categorias WHERE padre = :padre ORDER by orden ASC");		
		$query->execute(array(':padre' => 0));
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