<?php

class Model_CRUCanvas extends Model
{
	/* Приватная функция, получение последнего значения УРЛА, отделенного через слэш
	
	INPUT:
	$_SERVER['REQUEST_URI'] - URL
	OUTPUT:
	$lastID - последнее значение урла, преобразованное в Integer (предполагается, что это ID)
	*/
	private function GetLastIDformURL() {
		$routes = explode('/', $_SERVER['REQUEST_URI']);
		$lastID = array_pop($routes);
		$lastID=intval($lastID);
		return $lastID;	
	}

	/* Функция сохранения изображения в БД.

	INPUT:
	$GLOBALS['HTTP_RAW_POST_DATA'] - POST данные
	OUTPUT:
	$imageData - содержимое картинка
	$imagePass - пароль (в открытом виде), хотя можно было и MD5
	*/
	public function SaveImage() {
		$imageData=$GLOBALS['HTTP_RAW_POST_DATA'];
		$data = explode("&pass=", $imageData);
		$imageData=$data[0];
		$imagePass=$data[1];
		$sql=sprintf("INSERT INTO image (image,password) VALUES ('%s','%s')",$imageData,$imagePass);
		$this->query_data($sql);
	}

	/* Функция загрузки изображения из БД по текущему ИД (из урла).

	INPUT:
	URL - текущий URL
	OUTPUT:
	$result - JSON данные полученные из массива
	*/
	public function LoadImage() {
		$lastID=$this->GetLastIDformURL();
		if ($lastID>0) {
			$query = "SELECT image,password FROM image WHERE id=".$lastID;
			$ret_query=$this->query_data($query);
			$result=$ret_query->fetch_assoc();
			$result=json_encode($result);
			echo $result;
		} else {
			echo "NO Index";
		}
	}

	/* Функция обновления изображения в БД по текущему ИД (из урла).

	INPUT:
	URL - текущий URL
	*/
	public function UpdateImage() {
		$lastID=$this->GetLastIDformURL();
		if ($lastID>0) {
			$imageData=$GLOBALS['HTTP_RAW_POST_DATA'];
			$data = explode("&pass=", $imageData);
			$imageData=$data[0];
			$imagePass=$data[1];
			$sql=sprintf("UPDATE image SET image ='%s',password='%s' WHERE id = %s",$imageData,$imagePass,$lastID);
			$this->query_data($sql);
		}
	}
}


?>