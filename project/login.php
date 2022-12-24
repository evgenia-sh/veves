<?php require "header.php"?>
<head>
	<link rel="stylesheet" href="css/style.css">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
	<script src="js/scripts.js" defer></script>
	<title>Авторизация</title>
</head>
<body>
<div class="container mt-4 page">
		<div align="center">
		<form action="login.php" method="POST">
			<br>
			<h2 class="title-login">Авторизация</h2>
			<br>
			<br>
			<input type="text" class="form-control" name="email" id="email" placeholder="Введите e-mail" required><br>
			<input type="password" class="form-control" name="password" id="pass" placeholder="Введите пароль" required><br>
<?php 
	require "db.php"; 
	$data = $_POST;

	if(isset($data['do_login'])) { 

	 $errors = array();
	 // Проводим поиск по email в таблице users
	 $user = R::findOne('users', 'email = ?', array($data['email']));
	 if($user) {
		// Если email существует, тогда проверяем пароль
		if(password_verify($data['password'], $user->password)) {
			// Все верно, создаем сессию
			$_SESSION['user'] = $user;
			// Редирект на главную страницу
			header('Location: index.php');
		} else {
		$errors[] = 'Пароль введен неверно!';
		}
	 } else {
		$errors[] = 'Пользователь не найден!';
	 }
	if(!empty($errors)) {
			echo '<br><div style="color: red; ">' . array_shift($errors). '</div><br>';
		}
	}
?>


			<button class="btn btn-sm btn-dark w-100 " name="do_login" type="submit">Авторизоваться</button>
			<br>
			<br>
			<small>Ещё нет аккаунта? <a href="signup.php">Зарегистрироваться</a></small>
			</div>
		</form>
		<br>
	</div>
	
	
	
<?php require "footer.php" ?>
</body>
</html>