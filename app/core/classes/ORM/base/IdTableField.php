<?php
namespace app\core\classes\ORM\base;

class IdTableField extends TableField{
	function __construct($name){
		parent::__construct($name);
		return $this;
	}
	
	public function setValue($value){
		$this->value = (int) $value;
		return $this;
	}
}