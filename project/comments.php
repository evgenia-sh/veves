<?php 
require "db.php";
$id=$_GET['id'];

$data = $_POST;
$comments=$data['comments'];

$connection = new mysqli($host, $db_user, $db_pass, $db_name);
if($connection->connect_error){
    echo("Ошибка: " . $connection->connect_error);
}


if(isset($_POST['add_com'])) {
	$errors = array();
	echo ' '.$id.' ';
	/*if(trim($data['comments']) == '') {
		$errors[] = "Вы ничего не ввели";
	}
	if (mb_strlen($data['comments']) < 2){
		$errors[] = "Недопустимая длина пароля (от 2 до 8 символов)";
	}*/
	if(empty($errors)) {
		echo ' '.$comments.' ';
		mysqli_query($connection, "INSERT INTO `articles` (`comments`) VALUES ('$comments') WHERE `articles`.`id` = '$id' ");
			
		echo '<br><div style="color: green; ">Вы отправили коментарий!</div><br>';

		} else {
			// array_shift() извлекает первое значение массива array и возвращает его, сокращая размер array на один элемент. 
			echo '<br><div style="color: red; ">' . array_shift($errors). '</div><br>';
		}				
}

	
	
	
	
?>