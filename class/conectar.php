<?php
class Conectar{
	protected $db;

	public function __construct() {
		try{
    		//$this->db = new PDO('mysql:socket=/var/mysql/mysql.sock;host=192.168.0.59;dbname=symbelmyne;charset=utf8', 'symbelmyne', 'symbelmyne2015');
    		$this->db = new PDO('mysql:socket=/var/mysql/mysql.sock;host=localhost;dbname=gwa;charset=utf8', 'gwa', 'gwa2015gwa');
		}
	    catch (PDOException $e){
	    	echo 'Connection failed: ' . $e->getMessage();
	    }    
    }	

    public function getConnection(){
    	return $this->db;
    }
}
?>