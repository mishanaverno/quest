<?php 
namespace app\core\classes\ORM\base;

class TableField
{
	protected $name;
	protected $value;
	protected $null;
	protected $type;
	function __construct($name){
		$this->name = $name;
	}
	public function setValue($value){
		$this->value = $value;
		return $this;
	}
	public function getValue($value){
		return $this->value;
	}
}