<?php
	function getImagesForSlider(){
		$images = null;
		foreach (glob('./slider/*.*') as $key => $value) {
			$image["url"] = $value;
			$image["number"] = count($images);
			if (count($images) == 0){
				$image["active"] = 'active';
			}else{
				$image["active"] = '';
			}
			$images[] = $image;
		}	
		return $images;
	}
?>