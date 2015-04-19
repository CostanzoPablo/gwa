<?php
include_once('./class/conectar.php');

class Usuario extends Conectar{
	public $id, $mail, $clave;

    public function __construct() {
    	$pdo = new Conectar();
		$this->db = $pdo->db;
    }


	public function buscarPorId($id_usuario){
		$query = $this->db->prepare("SELECT * FROM usuarios WHERE id = :id");		
		$query->execute(array(':id' => $id_usuario));
		foreach ($query->fetchAll() as $row){
			$this->id = $row["id"];
			$this->mail = $row["mail"];
			$this->clave = $row["clave"];
		}			
		return $this;
	}

	public function buscarPorMail($mail_usuario){
		$query = $this->db->prepare("SELECT * FROM usuarios WHERE mail = :mail");		
		$query->execute(array(':mail' => $mail_usuario));
		foreach ($query->fetchAll() as $row){
			$this->id = $row["id"];
			$this->mail = $row["mail"];
			$this->clave = $row["clave"];
		}			
		return $this;
	}

	public function nuevo($mail, $clave){
		$sql = "INSERT INTO usuarios (mail, clave) VALUES (:mail, :clave)";
		$query = $this->db->prepare( $sql );
		$query->execute(array(':mail'=>$mail, ':clave'=>$clave));		
		$this->id = $this->db->lastInsertId();
		$this->mail = $mail;
		$this->clave = $clave;
		return $this;
	}

	public function actualizar($mail, $clave){
		$query = $this->db->prepare("UPDATE usuarios SET mail = :mail, clave = :clave WHERE id = '$this->id'");		
		$query->execute(array(':mail' => $mail, ':clave' => $clave));
		$this->mail = $mail;
		$this->clave = $clave;
		return $this;
	}

	public function eliminar(){
		$this->db->exec("DELETE FROM usuarios WHERE id = '$this->id'");	
	}

}
?>