<?php 
namespace app\core\classes\ORM\base;

abstract class TableField
{
	protected $name;
	protected $value;
	protected $public = true;
	protected $null = true;
	function __construct($name){
		$this->name = $name;
		return $this;
	}
	public function setValue($value){
		$this->value = $value;
		return $this;
	}
	public function getValue(){
		return $this->value;
	}
	public function getName(){
		return $this->name;
	}
	public function prepareValue($value = false){
		if(!$value) $value = $this->value;
		return $value;
	}
	public function isNull(){
		return $this->null;
	}
	public function null($value){
		$this->null = (bool) $value;
		return $this;
	}
}