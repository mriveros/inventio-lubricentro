<?php
class Database {
	public static $db;
	public static $con;
	function __construct(){
		$this->user="smarthub";$this->pass="dev.mysql.";$this->host="192.168.0.50:3306";$this->ddbb="inventio-aceite";
	}

	function connect(){
		$con = new mysqli($this->host,$this->user,$this->pass,$this->ddbb);
		$con->query("set sql_mode='';");
		return $con;
	}

	public static function getCon(){
		if(self::$con==null && self::$db==null){
			self::$db = new Database();
			self::$con = self::$db->connect();
		}
		return self::$con;
	}
	
}
?>
