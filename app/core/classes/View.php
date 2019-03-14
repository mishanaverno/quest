<?php
namespace app\core\classes;
use app\core\classes\Singleton;

class View extends Singleton
{
	protected static $instance;
	protected static $chunks = [];
	protected static $snippets = [];
	protected static $html = '';
	protected static $vars = [];


	public function setTemplate($name){
		$file = VIEW_PATH.'templates'.DS.$name.'.tpl';
		if(file_exists($file)){
			$tpl = file_get_contents($file);
			preg_match_all('/#(.*)#/', $tpl, $matches);
		}
		self::$chunks = $matches[1];
		return $this;
	}
	public function prepareTemplate(){
		foreach (self::$chunks as $key => $value) {
			if($value[0] === '$'){

			}else{
				self::$html .= file_get_contents(VIEW_PATH.'chunks'.DS.$value.'.html');
			}
		}
		
		return $this;
	}
	public function display()
	{
		echo self::$html;
	}
	
}