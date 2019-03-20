<?php 
namespace app\core\classes;
use app\core\classes\ORM\base\TableRow;

class DataProvider
{
	public function getOne($id, $class, $by = 'id'){
		if(!class_exists($class)) return $this;
		$row = new $class();
		if(!($row instanceof TableRow)) return $this;
		$tableName = $row->getTableName();
		$fields = $row->getFieldsNames();
		$where = 'WHERE '.$by.'='.$row->prepareFieldValue($by,$id);
		$res = DB::getInstance()->makeQuery("SELECT $fields from $tableName $where");
		if(!$res){
			$res = [];
		}else{
			$res = $res[0];
		}
		if(empty($res)) return false;
		
		$row->load($res);

		$row->InDB = true;
		return $row;
	}
	public function getCollection($class, $by = []){
		if(!class_exists($class)) return $this;
		$row = new $class();
		if(!($row instanceof TableRow)) return $this;
		$tableName = $row->getTableName();
		$fields = $row->getFieldsNames();
		$where = '';
		if(is_array($by) && !empty($by)){
			$where = 'WHERE ';
			foreach ($by as $key => $value) {

			}
		}
		$res = DB::getInstance()->makeQuery("SELECT $fields from $tableName $where");
		if(!$res){
			$res = [];
		}
		$collection = [];
		foreach($res as $key => $value){
			$row = new $class();
			$row->load($value);
			$row->InDB = true;
			$collection[] = $row;
		}	
		return $collection;
	}
	public function connect(){
		DB::getInstance()->connect();
		return $this;
	}
	public function disconnect(){
		DB::getInstance()->disconnect();
		return $this;
	}
}