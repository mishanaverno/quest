<?php
namespace app\core\classes;

class DB extends Singleton
{	
	protected static $cfg;
	protected static $mysqli;
	protected static $instance;
	public function __construct()
	{	
		if(!self::$cfg){
			self::$cfg = (object) require CONFIG_PATH.'db.config.php';
		}
	}
	public function connect()
	{	
		$cfg = self::$cfg;
		$mysqli = new \mysqli($cfg->host,$cfg->user,$cfg->password,$cfg->db_name);
		self::$mysqli = $mysqli;
		return $this;
	}
	public function disconnect(){
		if(self::$mysqli instanceof \mysqli)
			self::$mysqli->close();
	}
	public function makeQuery($query)
	{
		$mysqli = self::$mysqli;
		$res = $mysqli->query($query);
		if($res){
			$row = $res->fetch_all(MYSQLI_ASSOC);
		}else{
			$row = false;
		}
		return $row;
	}
	public function select($tableName = false, $fields = '*', $where = ''){
		if(!$tableName) return false;
		if($where !== ''){
			$where = 'WHERE '.$where;
		}
		$res = self::$mysqli->query("
				SELECT
				$fields
				FROM
				$tableName
				$where
			");
		if(self::$mysqli->errno > 0) return false;
		return $res->fetch_all(MYSQLI_ASSOC);
	}
	public function insert($tableName = false, $fieldsValues = []){
		if(!$tableName || empty($fieldsValues)) return false;
		$fields = [];
		$values = [];
		foreach ($fieldsValues as $key => $value) {
			$fields[] = $key;
			$values[] = is_string($value) ? '\''.$value.'\'' : $value;
		}

		$fields = implode(',', $fields);
		$values = implode(',', $values);
		$res = self::$mysqli->query("
				INSERT INTO $tableName 
				($fields) 
				VALUES ($values)"
			);
		if(self::$mysqli->errno > 0) return false;
		return self::$mysqli->insert_id;
	}

}