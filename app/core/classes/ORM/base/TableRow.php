<?php 
namespace app\core\classes\ORM\base;
use app\core\classes\ORM\base\IdTableField;
use app\core\classes\DB;

abstract class TableRow
{
	public $InDB = false;
	protected $fields = [];
	protected $tableName;
	function __construct($tableName)
	{
		$this->tableName = $tableName;
	}

	public function setFieldValue($fieldname = false, $value = ''){
		if($fieldname)
			if(!($this->fields[$fieldname] instanceof IdTableField)) 
				$this->fields[$fieldname]->setValue($value);
		return $this;
	}

	protected function setId($value){
		$this->fields['id']->setValue($value);
	}

	public function getFieldValue($fieldname = false){
		return $this->fields[$fieldname]->getValue();
	}

	public function prepareFieldValue($fieldname = false, $value = false){
		if($fieldname)
			if($value)
				return $this->fields[$fieldname]->prepareValue($value);
			else
				return $this->fields[$fieldname]->prepareValue();
	}
	protected function addFields($fields=[]){
		if(is_array($fields))
			foreach ($fields as $key => $value) {
				$this->addField($value);
			}
		return $this;
	}

	protected function addField($field){
		if($field instanceof TableField){
			$this->fields[$field->getName()] = $field;
		}
	}

	public function load($data = []){
		foreach ($data as $key => $value) {
			if($key == 'id') $this->setId($value);
			else $this->setFieldValue($key,$value);
		}
		return $this;
	}

	public function save(){
		$fields = [];
		$values = [];
		
		foreach ($this->fields as $key => $field) {
			
			if(!$field->isNull() && ($field->getValue() === Null && $field->getName() !== 'id'))
				return $this;
			$value = $field->prepareValue();

			if($field instanceof IdTableField) continue;
			$fields[] = $key;
			$values[] = $value;
		}
		$db = DB::getInstance();
		$db->connect();
		switch ($this->InDB){
			case true:
			$update = [];
			for ($i=0; $i < count($fields) ; $i++) { 
				$update[] = $fields[$i]."=".$values[$i];
			}
			$update = implode(', ',$update);
			$where = 'id='.$this->getFieldValue('id');
			$db->makeQuery("
				UPDATE $this->tableName 
				SET $update 
				WHERE $where; 
				");
			break;
			case false:
			$fields = implode(', ',$fields);
			$values = implode(', ',$values);
			$res = $db->makeQuery("INSERT INTO $this->tableName ($fields) VALUES ($values)");
			vd($res);
			break;
			default:
			break;
		}
		$db->disconnect();
		return $this;
	}

	public function getTableName(){
		return $this->tableName;
	}

	public function getFieldsNames(){
		return implode(', ',array_keys($this->fields));
	}
	public function toArray(){
		$arr = [];
		foreach ($this->fields as $key => $field) {
			$arr[$key] = $field->getValue();
		}
		return $arr;
	}
}