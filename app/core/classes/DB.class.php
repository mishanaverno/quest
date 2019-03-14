<?php
abstract class DB 
{	
	public static $cfg;
	public static function init()
	{	
		require_once CONFIG_PATH.'db.config.php';
		self::$cfg = (object) $config;
		
	}
	private function connect()
	{	
		$cfg = self::$cfg;
		$mysqli = new mysqli($cfg->host,$cfg->user,$cfg->password,$cfg->db_name);
		return $mysqli;
	}
	public function makeQuery($query)
	{
		$mysqli = self::connect();
		$res = $mysqli->query($query);
		if($res && $res->num_rows){
			$row = $res->fetch_all(MYSQLI_ASSOC);
		}else{
			$row = false;
		}
		$mysqli->close();
		return $row;
	}
}