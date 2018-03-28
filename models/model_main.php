<?php

class Model_Main extends Model
{
	/* Получить список всех рисунков и записать их в массив, 
	для дальнейшего использования в представлении
	
	OUTPUT:
	$data - массив с данными
	*/
	public function loadAllImage() {
		$query = "SELECT id,image,password FROM image";
		$ret_query=$this->query_data($query);
		$data = array();
		while ($result = $ret_query->fetch_assoc()) {
			$data[] = $result;		
    	}
		return $data;
	}

}


?>