<?php 
namespace app\core\classes\ORM\library;
use app\core\classes\ORM\base\StringTableField;
use app\core\classes\ORM\base\NumericTableField;
use app\core\classes\ORM\base\TableRow;
use app\core\classes\ORM\base\IdTableField;
use app\core\classes\ORM\base\BooleanTableField;

class BookTableRow extends TableRow
{
	function __construct(){
		parent::__construct('books');
		$title = new StringTableField('title');
		$fields = [
			new IdTableField('id'),
			$title->require(),
			new StringTableField('annotation'),
			new NumericTableField('pages'),
			new StringTableField('thumb'),
			new NumericTableField('user_id'),
			new BooleanTableField('in_library')
		];
		$this->addFields($fields);
	}
}