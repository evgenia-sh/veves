<?php require "header.php" ?>
<head>
	<link rel="stylesheet" href="css/style.css">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
	<title>Форма регистрации</title>
</head>
<body>

	<div class="container mt-4 page">
		<div align="center">
			<form action="signup.php" method="POST">
				<br>
					<h2>Форма регистрации</h2>
					<br>
					<br>
					
					
					
					
					
					
					<input type="email" class="form-control" name="email" id="email" placeholder="Введите email"><br>
					<input type="text" class="form-control" name="name" id="name" placeholder="Введите имя" required><br>
					<input type="text" class="form-control" name="surname" id="surname" placeholder="Введите фамилию" required><br>
					
					<div class="input-group has-validation">
					<span class="input-group-text">@</span>
					<input type="text" class="form-control" name="username" id="username" placeholder="Придумайте username" required="">
					<div class="invalid-feedback">
					Username обязателен!
					</div>
					</div>
					<br>
					<input type="password" class="form-control" name="password" id="password" placeholder="Введите пароль"><br>
					<input type="password" class="form-control" name="password_2" id="password_2" placeholder="Повторите пароль"><br>
<?php 
	require "db.php";	
	// Создаем переменную для сбора данных от пользователя по методу POST
	$data = $_POST;
	if(isset($data['do_signup'])) {

		// Создаем массив для сбора ошибок
		$errors = array();
		// trim — удаляет пробелы (или другие символы) из начала и конца строки
		// Проверка, чтобы не была введена пустая строка
		if(trim($data['email']) == '') {
			$errors[] = "Введите Email!";
		}

		if(trim($data['name']) == '') {
			$errors[] = "Введите Имя!";
		}

		if(trim($data['surname']) == '') {
			$errors[] = "Введите фамилию!";
		}
		if(trim($data['username']) == '') {
			$errors[] = "Введите username!";
		}

		if($data['password'] == '') {
			$errors[] = "Введите пароль!";
		}

		if($data['password_2'] != $data['password']) {
			$errors[] = "Пароли не совпадают!";
		}
		
		// функция mb_strlen - получает длину строки
		if (mb_strlen($data['password']) < 2 || mb_strlen($data['password']) > 8){
			$errors[] = "Недопустимая длина пароля (от 2 до 8 символов)";
		}

		// проверка на правильность написания Email
		if (!preg_match("/[0-9a-z_]+@[0-9a-z_^\.]+\.[a-z]{2,3}/i", $data['email'])) {
			$errors[] = 'Неверно введен е-mail';		
		}

		// Проверка на уникальность email
		if(R::count('users', "email = ?", array($data['email'])) > 0) {
			$errors[] = "Пользователь с таким e-mail уже существует!";
		}
		if(R::count('users', "username = ?", array($data['username'])) > 0) {
			$errors[] = "Пользователь с таким username уже существует!";
		}


		if(empty($errors)) {
			// Все проверено, регистрируем
			// Создаем таблицу users
			
			$user = R::dispense('users');

			// добавляем в таблицу записи
			$user->email = $data['email'];
			$user->name = $data['name'];
			$user->surname = $data['surname'];
			$user->username = $data['username'];

			// Хешируем пароль
			$user->password = password_hash($data['password'], PASSWORD_DEFAULT);

			// Сохраняем таблицу
			R::store($user);
			echo '<br><div style="color: green; ">Вы успешно зарегистрированы! Можете <a href="login.php">авторизоваться</a>.</div><br>';

		} else {
			// array_shift() извлекает первое значение массива array и возвращает его, сокращая размер array на один элемент. 
			echo '<br><div style="color: red; ">' . array_shift($errors). '</div><br>';
		}
	}
?>

							<button class="btn btn-sm btn-dark w-100"  name="do_signup" type="submit">Создать аккаунт</button>
							<br>
							<br>
							
							<small> Уже есть аккаунт? <a href="login.php">Войти</a></small>
							
							<p><?php if($showError){ echo showError($errors); } ?></p>
						</form>
						
					</div>
					
					<br>

		</div>
	<?php require "footer.php" ?>
</body>
</html>
