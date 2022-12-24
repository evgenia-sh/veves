<?php require"db.php"?>
<?php require "header.php"?>
<?php 
$user = R::findOne('users', 'id=?', array($_SESSION['user']->id));
?>

<html>
<head>
	<link rel="stylesheet" href="css/style.css">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
	<title>Добавление статьи</title>
</head>
<body>

<div class="container page">
	<br>
	<a class="link-secondary" onclick="history.back(-1); return false;" href="#" value="Назад">
	<svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-arrow-left" viewBox="0 0 16 16">
	<path fill-rule="evenodd" d="M15 8a.5.5 0 0 0-.5-.5H2.707l3.147-3.146a.5.5 0 1 0-.708-.708l-4 4a.5.5 0 0 0 0 .708l4 4a.5.5 0 0 0 .708-.708L2.707 8.5H14.5A.5.5 0 0 0 15 8z"/>
	</svg>
	</a>

	<br><h2 class="mt-3 mb-5">Добавление статьи</h2>
	<form  class="mb-3" action="addpost.php" method="POST" enctype="multipart/form-data">
	<input value="<?=$title?>" type="text" name="title" class="form-control" placeholder="Введите название статьи"><br>

	<textarea value="<?=$text?>" name="text" class="cols form-control" cols="45" rows="8" maxlength="65525" required="required" style="width: 847px; height: 222px;" placeholder="Введите текст статьи">
	</textarea><br>

	

        <select class="form-select" name="name_category" required="">
                <option value="">Категория...</option>
                <option>Новости</option>
				<option>Тренды</option>
				<option>Lifehacks</option>
				<option>Истории</option>
				<option>Интервью</option>
				<option>Другое</option>
              </select><br>
			  
		<input type="file" name="image"><br>
	

	
	<?php
// Создаем переменную для сбора данных от пользователя по методу POST
	$data = $_POST;
	$search=$user->username;
	$addname=$user->name;
	$addsurname=$user->surname;
	$fam=$addname.' '.$addsurname;
	$adddate=date("y.m.d");
	
	
	if(isset($data['go_add'])) {

		// Создаем массив для сбора ошибок
		$errors = array();
				
		
		
		// trim — удаляет пробелы (или другие символы) из начала и конца строки
		// Проверка, чтобы не была введена пустая строка
		
		// функция mb_strlen - получает длину строки
		if(trim($data['title']) == '') {
			$errors[] = "Введите заголовок статьи!";
		}
		if(trim($data['text']) == '') {
			$errors[] = "Введите текст статьи!";
		}			
		
		
		if (mb_strlen($data['text']) < 100 ){
			$errors[] = "Статья должна содержать более 100 символов!";
		}
		
		if (mb_strlen($data['title']) < 5){
			$errors[] = "Слишком короткий заголовок!";
		}
		if (mb_strlen($data['title'])>128){
			$errors[] = "Слишком длинный заголовок!";
		}

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
			// Все проверено, регистрируем
			// Создаем таблицу users
			
			$articles = R::dispense('articles');
			$upimg->image;
			
			
			// добавляем в таблицу записи
			$articles->title = $data['title'];
			$articles->text = $data['text'];
			$articles->name_category = $data['name_category'];
			$articles->image = $upimg;
			$articles->username = $search;
			$articles->name_user=$fam;
			$articles->date=$adddate;
			

			/*$sql = "INSERT INTO images VALUES ('$upimg')";
			$query = mysqli_query($sql);
*/

			// Сохраняем таблицу
			R::store($articles);
			echo '<br><div style="color: green; ">Статья опубликована!</div>';
			//sleep(2);
			//header('Location: user.php');
			//exit;

		} else {
			// array_shift() извлекает первое значение массива array и возвращает его, сокращая размер array на один элемент. 
			echo '<br><div style="color: red; ">' . array_shift($errors). '</div>';
		}
		
	} else {
	$title='';
	$text='';
	}
	
	?>
	
	
			<input class="btn btn-sm btn-dark mt-4" type="submit" value="Опубликовать статью" name="go_add">
	</form>
	
	
	
	
	</div>
	


<?php require "footer.php" ?>
</body>
</html>