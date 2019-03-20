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
		foreach (self::$chunks as $key => &$value) {
			if($value[0] === '$'){
				$value = $this->parseSnippet($value);
			}else{
				$value = $this->parseChunk($value);
			}
		}
		
		return $this;
	}
	private function parseChunk($name = false)
	{
		if($name){
			$html = file_get_contents(VIEW_PATH.'chunks'.DS.$name.'.html');
			preg_match_all('/{(.*)}/', $html, $matches);
			foreach ($matches[0] as $key => $value){
				if (isset(self::$vars[$matches[1][$key]])){
					$html = str_replace($value, self::$vars[$matches[1][$key]] , $html);
				}
			}
			return $html;
		}
	}
	private function parseSnippet($name = false){
		if($name){
			ob_start();
			require_once VIEW_PATH.'snippets'.DS.substr($name, 1).'.php';;
			$html = ob_get_contents();
			ob_end_clean();
			return $html;
		}
	}
	public function display()
	{
		foreach (self::$chunks as $key => $value){
			echo $value;
		} 
	}
	public function assignVar($name = false,$value = ''){
		if($name){
			self::$vars[$name] = $value;
		}
		return $this;
	}
}