<?php
class Model
{
	public static $mysqliPublic; // статическая переменная, куда будем писать наш коннект

	/* Открываем соединение с БД, если БД и таблицы нет, то создаем
	БД - из констант
	Таблица - image */
	public function __construct() {
		$mysqli = mysqli_connect(DB_HOST, DB_USER, DB_PASS); //, DB_NAME
		if ($mysqli) {
    	    echo "Не удалось подключиться к MySQL: " . mysqli_connect_error();

            $queryCreateDB = "CREATE DATABASE IF NOT EXISTS " . DB_NAME;
            $res = mysqli_query($mysqli, $queryCreateDB);
            $mysqli->select_db(DB_NAME);
            $queryCreateTable = "CREATE TABLE IF NOT EXISTS `image` ( `id` INT(11) NOT NULL AUTO_INCREMENT COMMENT 'Идентификатор', 
			`image` BLOB NOT NULL COMMENT 'Картинка', `password` VARCHAR(255) DEFAULT NULL COMMENT 'Пароль',  
			PRIMARY KEY (id)) ENGINE = INNODB AUTO_INCREMENT = 1 CHARACTER SET utf8 COLLATE utf8_general_ci;";
            $res = mysqli_query($mysqli, $queryCreateTable);
            self::$mysqliPublic = $mysqli;
        }
	}

	public function __destruct() {
		self::$mysqliPublic->close();	
   	}

	/* Запускает на выполнение один или несколько запросов, перечисленных через точку с запятой. */
	public function multiquery_data($sql=null) {
 		if (!$result =self::$mysqliPublic->multi_query($sql)) { 
 			echo "Error function multiquery_data: " . self::$mysqliPublic->error."<br>"; 
 		};
 		return $result;
	}

	/* Выполняет запрос query к базе данных.
	Функционально, использование этой функции идентично последовательному вызову функции mysqli_real_query(), 
	а затем mysqli_use_result() или mysqli_store_result(). 
	*/
	public function query_data($sql=null,$param=null) {
 		if (!$result =self::$mysqliPublic->query($sql,$param)) { 
 			echo "Error function query_data: " . self::$mysqliPublic->error."<br>"; 
 		};
 		return $result;
	}

	/* Выполняет одиночный запрос к базе данных, результаты которого можно получить или использовать функциями mysqli_store_result() или mysqli_use_result(). */
	public function realquery_data($sql=null) {
 		if (!$result =self::$mysqliPublic->real_query($sql)) { 
 			echo "Error function realquery_data: " . self::$mysqliPublic->error."<br>"; 
 		};
 	return $result;
	}
	

}