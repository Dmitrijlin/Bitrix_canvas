<?php
/* Отображаем перечень картинок */
	foreach($data as $row)
	{
		$str="<a href='#' id=".$row['id']." title='Нажмите что бы открыть для редактирования' onclick='loadCanvasfromDB(this); return false;'>Картинка № ".$row['id']."</a>";
		$str .="<span><input from=".$row['id']." type='text' placeholder='Пароль для редактирования'></span>";
		echo $str."<br>";
	}
	
?>
