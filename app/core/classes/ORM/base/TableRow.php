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
			if(!isset($this->fields[$fieldname])) return $this;
			if(!($this->fields[$fieldname] instanceof IdTableField)) 
				$this->fields[$fieldname]->setValue($value);
		return $this;
	}
	public function changeFieldValue($fieldname = false, $value = ''){
		if($fieldname)
			if(!isset($this->fields[$fieldname])) return $this;
			if(!($this->fields[$fieldname] instanceof IdTableField)) 
				$this->fields[$fieldname]->changeValue($value);
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
	public function new($data = []){
		foreach ($data as $key => $value) {
			if($key == 'id') return false;
			else $this->changeFieldValue($key,$value);
		}
		return $this;
	}

	public function save(){
		
		$fieldsValues = [];
		foreach ($this->fields as $key => $field) {
			if($field->isRequire() && $field->getValue() == '')
				return false;
			if($field instanceof IdTableField) continue;
			if($field->isChanged()){
				$fieldsValues[$field->getName()] = $field->prepareValue();
			}
		}
		$db = DB::getInstance();
		$db->connect();
		switch ($this->InDB){
			case true:
			$where = 'id='.$this->getFieldValue('id');
			$res = $db->update($this->tableName, $fieldsValues, $where);
			if(!$res) return false;
			break;
			case false:
			$res = $db->insert($this->tableName, $fieldsValues);
			if(!$res) return false;
			$this->InDB = true;
			$this->setId($res);
			break;
			default:
			break;
		}
		$db->disconnect();
		return $this;
	}
	public function delete(){
		$where = 'id='.$this->getFieldValue('id');
		$db = DB::getInstance();
		$db->connect();
		$res = $db->delete($this->tableName, $where);
		$db->disconnect();
		if($res) return false;
		else return $this;
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