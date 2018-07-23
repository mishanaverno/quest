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