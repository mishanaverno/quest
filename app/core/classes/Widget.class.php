<?php
/**
 * 
 */
class Widget
{
	function __construct($model, $data)
	{	
		foreach ($model as $k => $v) {
			$this->$k = $v;
		}
		$this->data = $data;
	}
	public function render(){
		$file = VIEW_PATH.'templates'.DS.$this->template.'.wtpl.php';
		if(file_exists($file)){
			$headers = $this->data->headers;
			$rows = $this->data->rows;
			$title = $this->title;
			$modelname = $this->name;
			require $file;
		}else{
			echo 'Шаблон виджета не найден';
		}
	}
}