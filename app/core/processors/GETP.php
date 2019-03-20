<?php 
namespace app\core\processors;
use app\core\classes\Singleton;

class GETP extends Singleton
{
	protected static $instance = '';
	protected static $data;

	function __construct()
	{
		self::$data = [];
		foreach ($_GET as $key => $value) {
			$this->add($key, $value);	
		}
	}
	public function get($key = false){
		if ($key){
			if(is_array($key)){
				$array = [];
				foreach ($key as $k => $v) {
					if(isset(self::$data[$v]))
						$array[$v] = self::$data[$v];
				}
				return $array;
			}
			if(isset(self::$data[$key])) {
				return self::$data[$key];
			}	
		} 
		else return false; 
	}
	private function add($key,$value){
		$value = strip_tags($value);
		self::$data[$key] = $value;
	}
}