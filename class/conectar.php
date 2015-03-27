<?php
class Conectar{
	protected $db;

	public function __construct() {
		try{
    		//$this->db = new PDO('mysql:socket=/var/mysql/mysql.sock;host=localhost;dbname=???;charset=utf8', '???', '???');
    		$this->db = new PDO('mysql:host=localhost;dbname=gwa;charset=utf8', 'gwa', 'gwa2015gwa');
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