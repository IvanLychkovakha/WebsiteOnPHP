<?php
	    //sql.php
	    $server = "localhost"; //Ваш сервер MySQL
	    $user = "root"; //Ваше имя пользователя MySQL
	    $pass = ""; //пароль
			$db = "course_work";
	    $mysql = new mysqli($server, $user, $pass,$db);//соединение с сервером

	    if(!$mysql) { //если не может выбрать базу данных
	        echo "Извините, ошибка :(/>";//Показывает сообщение об ошибке
	        exit(); //Позволяет работать остальным скриптам PHP
	    }
	?>
