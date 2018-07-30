<?php 
abstract class DataProvider
{
	public static function get($modelname, $where = null)
	{	
		$model = self::loadModel($modelname);
		if ($model){
			$fields = [];
			foreach ($model->fields as $k => $v) {
				$fields[] = $k.' AS '.$v['dbfield'];
			}
			$query = "SELECT ".implode(', ',$fields)." FROM ".$model->tablename." ";
			if ($where) $query .= $where;
		}
		return DB::makeQuery($query);
	}
	public static function loadModel($modelname)
	{
		$file = MODEL_PATH.ucfirst($modelname).'.model.php';
		if(file_exists($file)){
			require $file;
			return $model;
		}else{
			return false;
		}
	}
}