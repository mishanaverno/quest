<?php
namespace app\core\classes;
use app\core\classes\ORM\library\UserTableRow;

class User 
{
	private $row;
	private $valid = false;
	function __construct($row){
		if($row instanceof UserTableRow){
			$this->valid = true;
			$this->row = $row;
		}
	}
	public function getName(){
		return $this->row->getFieldValue('name');
	}
	private function isValid(){
		return $this->valid;
	}
	public function isAdmin(){
		if(!$this->isValid()) return;
		return  $this->row->getFieldValue('is_admin');
	}
	public function checkPass($pass = ''){
		if(!$this->isValid()) return; 
		$userpass = $this->row->getFieldValue('pass');
		if($userpass == $pass){
			return true;	
		}	
		return false;
	}
	public function login(){
		$_SESSION['authorized'] = true;
		$_SESSION['user'] = $this;
	}
	public function logout(){
		$_SESSION['authorized'] = false;
		$_SESSION['user'] = $this;
	}
} 