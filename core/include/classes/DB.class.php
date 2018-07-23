<?php
abstract class DB 
{	
	public static $cfg;
	public static function init()
	{	
		$json = json_decode(file_get_contents(CONFIG_PATH.'db.config.json'));
		foreach ($json as $k => $v) {
			self::$cfg->$k = $v;
		}
	}
	private function connect()
	{	
		$cfg = self::$cfg;
		$mysqli = new mysqli($cfg->host,$cfg->user,$cfg->password,$cfg->db_name);
		return $mysqli;
	}
	private function makeQuery($query)
	{
		$mysqli = self::connect();
		$res = $mysqli->query($query);
		$row = $res->fetch_assoc();
		$mysqli->close();
	}
}