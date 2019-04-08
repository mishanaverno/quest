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
		$where = $by.'='.$row->prepareFieldValue($by,$id);
		$res = DB::getInstance()->select($tableName, $fields, $where);
		
		if(!$res) return false;
		$row->load($res[0]);
		$row->InDB = true;
		return $row;
	}
	public function getCollection($class, $where = '', $limit = '', $orderBy = ''){
		if(!class_exists($class)) return $this;
		$row = new $class();
		if(!($row instanceof TableRow)) return $this;
		$res = DB::getInstance()->select($row->getTableName(), $row->getFieldsNames(), $where, $limit, $orderBy);
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