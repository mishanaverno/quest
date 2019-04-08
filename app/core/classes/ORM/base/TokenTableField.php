<?php
namespace app\core\classes\ORM\base;
use app\core\classes\ORM\base\StringTableField;

class TokenTableField extends StringTableField{
	function __construct($name){
		parent::__construct($name);
		$this->system();
		$this->require();
		return $this;
	}

}