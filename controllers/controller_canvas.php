<?php
/* Контроллер для работы с изображением
Методы:
index - Сохранение (по умолчанию);
load - Загрузка
update - Обновление
*/
class Controller_Canvas extends Controller {
	function __construct() {
		$this->model = new Model_CRUCanvas();
	}
	
	function action_index()	{
		$data = $this->model->SaveImage();		
	}

	function action_load() {
		$data = $this->model->LoadImage();	
	}

	function action_update() {
		$data = $this->model->UpdateImage();	
	}
}
