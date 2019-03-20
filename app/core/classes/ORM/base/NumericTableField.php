<?php 
namespace app\core\classes\ORM\base;

class NumericTableField extends TableField{
	function __construct($name){
		parent::__construct($name);
		return $this;
	}
	public function setValue($value){
		$this->value = (float) $value;
		return $this;
	}
}