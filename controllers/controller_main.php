<?php

/* Контроллер, получаем даные по всем изображениям,
затем передаем их на соотвтетствующее представление
*/
class Controller_Main extends Controller
{
	function __construct()	{
		$this->model = new Model_Main();
		$this->view = new View();
	}
	
	function action_index()	{	
		$data = $this->model->loadAllImage();
		$this->view->generate('main_view.php', 'site_template.php',$data);
	}
}