<?php
class Conectar{
	protected $db;

	public function __construct() {
		try{
    		//$this->db = new PDO('mysql:socket=/var/mysql/mysql.sock;host=localhost;dbname=???;charset=utf8', '???', '???');
    		$this->db = new PDO('mysql:host=192.168.0.61;dbname=dbname;charset=utf8', 'userdb', 'passdb');
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