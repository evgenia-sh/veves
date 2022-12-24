<?php require"db.php"?>

<?php 
$user = R::findOne('users', 'id=?', array($_SESSION['user']->id));
		
		
		$id = $_GET["id"];
		$connection = mysqli_connect($host, $db_user, $db_pass, $db_name);
		if(!$connection){
			echo "Ошибка подключения к бд!";
		}	
		mysqli_query($connection, "DELETE FROM `articles` WHERE `articles`.`id` = '$id'");

		header('Location: user.php');
	
?>