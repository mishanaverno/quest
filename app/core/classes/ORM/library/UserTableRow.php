<?php 
namespace app\core\classes\ORM\library;
use app\core\classes\ORM\base\StringTableField;
use app\core\classes\ORM\base\NumericTableField;
use app\core\classes\ORM\base\TableRow;
use app\core\classes\ORM\base\IdTableField;
use app\core\classes\ORM\base\BooleanTableField;

class UserTableRow extends TableRow
{
	function __construct(){
		parent::__construct('users');
		$login = new StringTableField('login');
		$is_admin = new BooleanTableField('is_admin');
		$fields = [
			new IdTableField('id'),
			new StringTableField('name'),
			$login->null(false),
			new StringTableField('pass'),
			new StringTableField('email'),
			$is_admin->null(false)
		];
		$this->addFields($fields);
	}
}