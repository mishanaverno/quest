<?php 
namespace app\core\classes\ORM\library;
use app\core\classes\ORM\base\StringTableField;
use app\core\classes\ORM\base\NumericTableField;
use app\core\classes\ORM\base\TableRow;
use app\core\classes\ORM\base\IdTableField;
use app\core\classes\ORM\base\BooleanTableField;
use app\core\classes\ORM\base\TokenTableField;

class UserTableRow extends TableRow
{
	function __construct(){
		parent::__construct('users');
		$login = new StringTableField('login');
		$fields = [
			new IdTableField('id'),
			new StringTableField('name'),
			$login->require(),
			new StringTableField('pass'),
			new StringTableField('email'),
			new BooleanTableField('is_admin'),
			new TokenTableField('token')
		];
		$this->addFields($fields);
	}
	public function changeFieldValue($fieldname = false, $value = ''){
		if($fieldname){

			if(!isset($this->fields[$fieldname])) return $this;
			if($this->fields[$fieldname] instanceof IdTableField ||
				$this->fields[$fieldname] instanceof TokenTableField){
				return $this;
			} 
			$this->fields[$fieldname]->changeValue($value);
			if($fieldname == 'login' || $fieldname = 'pass'){
				$this->updateToken();
			}
		}
		return $this;

	}
	protected function updateToken(){
		$login = $this->fields['login']->getValue();
		$pass = $this->fields['pass']->getValue();
		$rand = rand(10000, 99999);
		$token = md5($login.$pass.$rand);
		$this->fields['token']->changeValue($token);
	}
}