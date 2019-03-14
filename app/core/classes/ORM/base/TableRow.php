<?php 
namespace app\core\classes\ORM\base;
use app\core\classes\ORM\base\TableField;

class TableRow
{
	private $fields = [];
	function __construct(){

	}
	public addField($field){
		if($field instanceof TableField){
			$fields[] = $field;
		}
	}
}