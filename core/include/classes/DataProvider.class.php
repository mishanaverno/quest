<?php 
abstract class DataProvider
{
	public static function get($modelname, $where = null)
	{	
		$model = self::loadModel($modelname);
		if ($model){
			$fields = [];
			foreach ($model->fields as $k => $v) {
				$fields[] = $v['dbfield'].' AS '.$k;
				unset($model->fields[$k]['dbfield']);
			}
			$query = "SELECT ".implode(', ',$fields)." FROM ".$model->tablename." ";
			if ($where) $query .= $where;
			$response = DB::makeQuery($query);
			if($response){
				$result = self::composeResponse($response, $model);
			}else{
				$result = false;
			}  
		}else{
			 $result = false;;
		}
		return $result;
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
	private static function constructQuery($model, $where)
	{

	}
	private static function composeResponse($response, $model)
	{	
		$headers = $model->fields;
		unset($model->fields);
		$data = (object) ['headers'=>$headers, 'rows' => $response];
		$result = ['model' => $model,'data'=>$data];
		return $result;
		
	}
}