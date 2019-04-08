<?php 
namespace app\core\classes\API;

class Response
{
	public $success = false;
	public $error = 1;
	public static function create(){
		return new self();
	}
	public function succes(){
		$this->success = true;
		$this->error = 0;
		return $this;
	} 
	public function error($er){
		$this->succes = false;
		$this->error = $er;
		return $this;
	} 
	public function data($data = false){
		$this->data = $data;
		return $this;
	}
	public function msg($msg){
		$this->msg = $msg;
		return $this;
	}
	public function printJSON(){
		header('Access-Control-Allow-Origin: *');
		header('Content-Type: application/json');
		echo json_encode($this);
		exit;
	} 
}
