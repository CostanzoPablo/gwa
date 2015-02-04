<?php
class Conectar{
	protected $db;

	public function __construct() {
    	$this->db = new PDO('mysql:host=localhost;dbname=gwa;charset=utf8', 'gwa', 'gwa2015gwa');
    }	

    public function getConnection(){
    	return $this->db;
    }
}
?>