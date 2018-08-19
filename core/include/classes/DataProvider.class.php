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
			$query = "SELECT ".implode(', ',$fields)." FROM ".$model->tablename;
			if ($where) $query .= ' WHERE '.$where;
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
	public static function update($modelname = null, $where = null)
	{
		$model = self::loadModel($modelname);
		if($model && $where){
			$fields = [];
			foreach(GETP::get() as $k => $v){
				if(isset($model->fields[$k]) && $model->fields[$k]['dbreadonly'] !== true){
					if ($model->fields[$k]['type'] === 'text')
						$v = '\''.$v.'\'';
					$fields[] = $k.'='.$v;
				}
			}
			$query = 'UPDATE '.$model->tablename.' SET '.implode(', ', $fields).' WHERE '.$where;
			$response = DB::makeQuery($query);
			PHP::vd($response);
			if($response !== false){
				$result = true;
			}else{
				$result = false;
			}
		}else{
			$result = false;
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
	private static function composeResponse($response, $model)
	{	
		$headers = $model->fields;
		unset($model->fields);
		$data = (object) ['headers'=>$headers, 'rows' => $response];
		$result = ['model' => $model,'data'=>$data];
		return (object) $result;
		
	}
}