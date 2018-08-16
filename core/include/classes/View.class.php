<?php
abstract class View
{
	public static $positions = [];
	public static function display($view, $vars = [])
	{
		$file = VIEW_PATH.$view.DS.'index.php';
		if(file_exists($file)){
			foreach ($vars as $k => $v) {
				$$k = $v;
			}
			require $file;
		}else{
			echo 'Не найдено представление - "'.$view.'"';
		}
	}
	public static function part($part, $vars = [])
	{	
		$view = Router::get();
		$file = VIEW_PATH.$view.DS.'parts'.DS.$part.'.php';
		if(file_exists($file)){
			foreach ($vars as $k => $v) {
				$$k = $v;
			}
			require $file;
		}else{
			echo 'Не найдена часть - "'.$part.'"';
		}
	}
	public static function layout($tpl, $vars = [])
	{
		$file = VIEW_PATH.'layout'.DS.$tpl.'.php';
		if(file_exists($file)){
			foreach ($vars as $k => $v) {
				$$k = $v;
			}
			require $file;
		}else{
			echo 'Не найден шаблон - "'.$tpl.'"';
		}	
	}
	public static function constructWidget($properties = []){
		$widget = new Widget($properties->model, $properties->data);
		return $widget;
	}
	public static function addWidgetToPosition($position, $widget)
	{
		self::$positions[$position][] = $widget; 
	}
	public static function constructWidgetOnPosition($position, $properties)
	{
		self::$positions[$position][] = self::constructWidget($properties);
	}
	public static function position($position = null){
		if(isset(self::$positions[$position])){
			foreach (self::$positions[$position] as $k => $v) {
				$v->render();
			}
		}
	}
}