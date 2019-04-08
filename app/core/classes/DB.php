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
	public function select($tableName = false, $fields = '*', $where = '',  $limit = '', $orderBy = ''){
		if(!$tableName) return false;
		if($where !== ''){
			$where = 'WHERE '.$where;
		}
		if($limit !== ''){
			$limit = 'LIMIT '.$limit;
		}
		if($orderBy !== ''){
			$orderBy = 'ORDER BY '.$orderBy;
		}
		$res = self::$mysqli->query("
				SELECT
				$fields
				FROM
				$tableName
				$where
				$orderBy
				$limit
			");
		if(self::$mysqli->errno > 0) return false;
		$data = $res->fetch_all(MYSQLI_ASSOC);
		if(empty($data)) return false;
		return $data;
	}
	public function insert($tableName = false, $fieldsValues = []){
		if(!$tableName || empty($fieldsValues)) return false;
		$fields = [];
		$values = [];
		foreach ($fieldsValues as $key => $value) {
			$fields[] = $key;
			$values[] = is_string($value) ? $value : $value;
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
	public function update($tableName = false, $fieldsValues = [], $where = false){

		if(!$tableName || empty($fieldsValues) || !$where) return false;
		$update = [];
		foreach ($fieldsValues as $key => $value) {
			$update[] = $key.'='.$value;
		}
		
		$update = implode(', ',$update);
		self::$mysqli->query("
			UPDATE $tableName 
			SET $update 
			WHERE $where; 
			");
		if(self::$mysqli->errno > 0) return false;
		return self::$mysqli->affected_rows;
	}
	public function delete($tableName = false, $where = false){
		if(!$tableName || !$where) return false;
		self::$mysqli->query("
			DELETE FROM $tableName
			WHERE $where
			");
		if(self::$mysqli->errno > 0) return false;
		return self::$mysqli->affected_rows;
	}

}