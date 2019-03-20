<?php 
namespace app\core\classes\ORM\base;

class BooleanTableField extends TableField{
	function __construct($name){
		parent::__construct($name);
		return $this;
	}
	public function setValue($value){
		$this->value = (boolean) $value;
		return $this;
	}
	public function prepareValue($value = false){
		if(!$value) $value = (int) $this->value;
		return $value;
	}
}