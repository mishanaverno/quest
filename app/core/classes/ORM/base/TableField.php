<?php 
namespace app\core\classes\ORM\base;

abstract class TableField
{
	protected $name;
	protected $value;
	protected $public = true;
	protected $require = false;
	protected $visible = true;
	protected $system = false;
	protected $changed = false;
	function __construct($name){
		$this->name = $name;
		return $this;
	}
	public function setValue($value){
		$this->value = $value;
		return $this;
	}
	public function changeValue($value){
		$this->setValue($value);
		$this->changed = true;
		return $this;
	}
	public function isChanged(){
		return $this->changed;
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
	public function isRequire(){
		return $this->require;
	}
	public function require($value = true){
		$this->require = (bool) $value;
		return $this;
	}
	public function isSystem(){
		return $this->system;
	}
	public function system(){
		$this->system = true;
		return $this;
	}
}