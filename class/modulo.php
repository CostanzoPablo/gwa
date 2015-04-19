<?php
include_once('./class/conectar.php');

function getExtension($str) {
         $i = strrpos($str,".");
         if (!$i) { return ""; } 

         $l = strlen($str) - $i;
         $ext = substr($str,$i+1,$l);
         return $ext;
}

class Modulo extends Conectar{
	public $id, $titulo, $alineacion, $anchoTexto, $anchoImagen, $anchoVideo, $orden, $texto, $imagen, $video, $colorHr;

    public function __construct() {
    	$pdo = new Conectar();
		$this->db = $pdo->db;
    }


	public function buscarPorId($id_modulo){
		$query = $this->db->prepare("SELECT * FROM modulos WHERE id = :id");		
		$query->execute(array(':id' => $id_modulo));
		foreach ($query->fetchAll() as $row){
			$this->id = $row["id"];
			$this->titulo = $row["titulo"];
			$this->alineacion = $row["alineacion"];
			$this->anchoTexto = $row["anchoTexto"];
			$this->anchoImagen = $row["anchoImagen"];
			$this->anchoVideo = $row["anchoVideo"];
			$this->orden = $row["orden"];
			$this->texto = $row["texto"];
			$this->imagen = $row["imagen"];
			$this->video = $row["video"];
			$this->colorHr = $row["colorHr"];
		}			
		return $this;
	}

	public function buscarPorCategoria($id_categoria){
		$modulos = null;
		$query = $this->db->prepare("SELECT * FROM modulos WHERE categoria = :categoria ORDER by orden ASC");		
		$query->execute(array(':categoria' => $id_categoria));
		foreach ($query->fetchAll() as $row){
			if ($row["alineacion"] == null){
				$directory = './modulos/'.$row["id"].'/';
				$images = glob($directory . "*.*");
				foreach($images as $image){
					$imageAdapter["image"] = $image;
					$imageAdapter["imagen"] = (new Imagen)->buscarPorModuloConImagen($row["id"], $image);
					$row["imagenes"][] = $imageAdapter;
				}		
			}
			$modulos[] = $row;
		}			
		return $modulos;
	}

	public function nuevo($categoria, $titulo, $alineacion, $anchoTexto, $anchoVideo, $altoVideo, $orden, $texto, $video, $colorHr){
		$sql = "INSERT INTO modulos (categoria, titulo, alineacion, anchoTexto, anchoVideo, altoVideo, orden, texto, video, colorHr) VALUES (:categoria, :titulo, :alineacion, :anchoTexto, :anchoVideo, :altoVideo, :orden, :texto, :video, :colorHr)";
		$query = $this->db->prepare( $sql );
		$query->execute(array(':categoria'=>$categoria, ':titulo'=>$titulo, ':alineacion'=>$alineacion, ':anchoTexto'=>$anchoTexto, ':anchoVideo'=>$anchoVideo, ':altoVideo'=>$altoVideo, ':orden'=>$orden, ':texto'=>$texto, ':video'=>$video, ':colorHr'=>$colorHr));		
		$this->id = $this->db->lastInsertId();
		$this->titulo = $titulo;
		$this->alineacion = $alineacion;
		$this->anchoTexto = $anchoTexto;
		$this->anchoVideo = $anchoVideo;
		$this->altoVideo = $altoVideo;
		$this->orden = $orden;
		$this->texto = $texto;
		$this->imagen = $imagen;
		$this->video = $video;		
		$this->colorHr = $colorHr;				
		return $this;
	}

	public function orden($orden){
		$query = $this->db->prepare("UPDATE modulos SET orden = :orden WHERE id = '$this->id'");		
		$query->execute(array(':orden'=>$orden));
		$this->orden = $orden;

		return $this;
	}

	public function actualizar($titulo, $alineacion, $anchoTexto, $anchoVideo, $altoVideo, $orden, $texto, $video, $colorHr, $anchoImagen, $altoImagen){
		$query = $this->db->prepare("UPDATE modulos SET titulo = :titulo, alineacion = :alineacion, anchoTexto = :anchoTexto, anchoVideo = :anchoVideo, altoVideo = :altoVideo, orden = :orden, texto = :texto, video = :video, colorHr = :colorHr, anchoImagen = :anchoImagen, altoImagen = :altoImagen WHERE id = '$this->id'");		
		$query->execute(array(':titulo'=>$titulo, ':alineacion'=>$alineacion, ':anchoTexto'=>$anchoTexto, ':anchoVideo'=>$anchoVideo, ':altoVideo'=>$altoVideo, ':orden'=>$orden, ':texto'=>$texto, ':video'=>$video, ':colorHr'=>$colorHr, ':anchoImagen'=>$anchoImagen, ':altoImagen'=>$altoImagen));
		$this->titulo = $titulo;
		$this->alineacion = $alineacion;
		$this->anchoTexto = $anchoTexto;
		$this->anchoVideo = $anchoVideo;
		$this->altoVideo = $altoVideo;
		$this->orden = $orden;
		$this->texto = $texto;
		$this->imagen = $imagen;
		$this->video = $video;		
		$this->colorHr = $colorHr;	
		$this->anchoImagen = $anchoImagen;
		$this->altoImagen = $altoImagen;
		return $this;
	}

	public function eliminar(){
		$this->db->exec("DELETE FROM modulos WHERE id = '$this->id'");	
	}

	public function guardarImagen($imagen, $anchoImagen, $altoImagen){
	    $uploadedfile = $imagen['tmp_name'];
	    $image = $imagen["name"];
  		if ($image){
			$size=filesize($imagen['tmp_name']);
			$filename = stripslashes($imagen['name']);
		    $extension = strtolower(getExtension($filename));
 			if (($extension != "jpg") && ($extension != "jpeg") && ($extension != "png") && ($extension != "gif")){
				return 'Solo se permiten formatos JPG, JPEG, PNG y GIF';
			}else{	    
				switch ($extension){
					case 'jpg':
						$src = imagecreatefromjpeg($uploadedfile);
						break;
					case 'jpeg':
						$src = imagecreatefromjpeg($uploadedfile);
						break;
					case 'png':
						$src = imagecreatefrompng($uploadedfile);
						break;
					case 'gif':
						$src = imagecreatefromgif($uploadedfile);
						break;																		
				}
			}
				
			$nombreNuevo = time().'.jpg';
			list($width,$height)=getimagesize($uploadedfile);

			if ($width > $height){
				$newwidth = 1000;
				$newheight = ($height / $width) * $newwidth;
			}else{
				$newheight = 1000;
				$newwidth = ($width / $height) * $newheight;
			}

			$tmp = imagecreatetruecolor ($newwidth, $newheight);
			imagecopyresampled($tmp, $src, 0, 0, 0, 0, $newwidth, $newheight, $width, $height);
			if (!file_exists('modulos')) {
    			mkdir('modulos', 0777, true);
			}
			$filename = 'modulos/'.$nombreNuevo;
			
			$this->imagen = $filename;
			$this->anchoImagen = $anchoImagen;
			$this->altoImagen = $altoImagen;			
			$query = $this->db->prepare("UPDATE modulos SET imagen = :imagen, anchoImagen = :anchoImagen, altoImagen = :altoImagen WHERE id = '$this->id'");		
			$query->execute(array(':imagen'=>$this->imagen, ':anchoImagen'=>$this->anchoImagen, ':altoImagen'=>$this->altoImagen));


			imagejpeg($tmp, $filename);						
			imagedestroy($tmp);	
			
			return 'ok';
		}
	}
}
?>