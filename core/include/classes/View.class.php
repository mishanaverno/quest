<?php
abstract class View
{
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
}