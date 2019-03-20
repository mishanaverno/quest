<?php
namespace app\core\classes\ORM\base;

class StringTableField extends TableField{
	function __construct($name){
		parent::__construct($name);
		return $this;
	}
	public function setValue($value){
		$this->value = (string) $value;
		return $this;
	}
	public function prepareValue($value = false){
		if(!$value) $value = $this->value;
		return '\''.$value.'\'';
	}
}