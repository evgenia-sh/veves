<?php require"db.php"?>
<?php require "header.php"?>
<?php 
$user = R::findOne('users', 'id=?', array($_SESSION['user']->id));
?>

<html>
<head>
	<link rel="stylesheet" href="css/style.css">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
	<title>Редактирование статьи</title>
</head>
<body>
<?php


		$art_id=$_GET['id'];
		$connection = mysqli_connect($host, $db_user, $db_pass, $db_name);
		if(!$connection){
			echo "Ошибка подключения к бд!";
		}	
		$art = mysqli_query($connection, "SELECT * FROM `articles` WHERE `id` = '$art_id'");
		$art = mysqli_fetch_assoc($art);
		//print_r ($art);
?>


<div class="container page">
	<br>
	<a class="link-secondary" onclick="history.back(-1); return false;" href="#" value="Назад">
	<svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-arrow-left" viewBox="0 0 16 16">
	<path fill-rule="evenodd" d="M15 8a.5.5 0 0 0-.5-.5H2.707l3.147-3.146a.5.5 0 1 0-.708-.708l-4 4a.5.5 0 0 0 0 .708l4 4a.5.5 0 0 0 .708-.708L2.707 8.5H14.5A.5.5 0 0 0 15 8z"/>
	</svg>
	</a>

	<br><h2 class="mt-5 mb-5">Редактирование статьи</h2>
	
	
	<form action="edit.php" method="POST" enctype="multipart/form-data">
		<input type="hidden" name="id" value="<?= $art['id'] ?>"> 
		<input value="<?= $art['title'] ?>" type="text" name="title" class="form-control" placeholder="Введите название статьи"><br>
		<textarea name="text" class="cols form-control" cols="45" rows="8" maxlength="65525" required="required" style="width: 847px; height: 222px;" placeholder="Введите текст статьи"><?= $art['text'] ?>	</textarea><br>
        <select class="form-select" name="name_category"  required="">
                <option="<?$art['name_category']?>">Новости</option>
				<option>Тренды</option>
				<option>Lifehacks</option>
				<option>Истории</option>
				<option>Интервью</option>
				<option>Другое</option>
              </select><br>	  
		<input type="file" src="<?= $art['image'] ?>" name="image"><br>
		<input class="btn btn-sm btn-dark mt-4" type="submit" value="Сохранить" name="change">
		
	</form>
	
	<?php
$id=$_POST['id'];
$title=$_POST['title'];
$text=$_POST['text'];	
$name_category=$_POST['name_category'];	
$image=$_POST['image'];	


	//header('Location: user.php');
	
	
	
	
// Создаем переменную для сбора данных от пользователя по методу POST
	$data = $_POST;
	
	
	if(isset($data['change'])) {

		// Создаем массив для сбора ошибок
		$errors = array();

		
		// trim — удаляет пробелы (или другие символы) из начала и конца строки
		// Проверка, чтобы не была введена пустая строка

		if(trim($title == '')) {
			$errors[] = "Введите заголовок статьи!";
		}
		
		if(trim($text == '')) {
			$errors[] = "Введите текст статьи!";
		}			
		
		// функция mb_strlen - получает длину строки

		
			$path = 'img/';	
			$types = array('image/jpg', 'image/png', 'image/jpeg');
			// Максимальный размер файла
			$size = 1024*1024*2;
			$upimg = $path . basename($_FILES['image']['name']);
			// Обработка запроса

			// Проверяем тип файла
			
			if (!in_array($_FILES['image']['type'], $types)){
				$errors[] = "Запрещённый тип файла!";
			}
			
			// Проверяем размер файла
			if ($_FILES['image']['size'] > $size){
				$errors[] = "Слишком большой размер файла!";
			}
			
			// Загрузка файла и вывод сообщения
			if (!@copy($_FILES['image']['tmp_name'], $path . $_FILES['image']['name'])){
				$errors[] = ('Что-то пошло не так');
			}
			
	
		if(empty($errors)) {
			
		$image=$path . $_FILES['image']['name'];
			
				mysqli_query($connection, "UPDATE `articles` SET `title` = '$title', `text` = '$text', `name_category` = '$name_category',  `image` = '$image' WHERE `articles`.`id` = '$id' ");
			
			echo '<br><div style="color: green; ">Статья успешно изменена!</div>';
			//sleep(2);
			//header('Location: user.php');
			//exit;

		} else {
			// array_shift() извлекает первое значение массива array и возвращает его, сокращая размер array на один элемент. 
			echo '<br><div style="color: red; ">' . array_shift($errors). '</div>';
		}
		
	}
	
	?>
	
	

	
	
	
	
	
	
	

</div>

<?php require "footer.php" ?>
</body>
</html>