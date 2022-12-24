<?php require"db.php"?>
<?php require "header.php"?>

<?php 
$user = R::findOne('users', 'id=?', array($_SESSION['user']->id));
$admin=$user->admin;

?>
<html>
<head>
	<link rel="stylesheet" href="css/style.css">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
	<script src="js/scripts.js" defer></script>
	<title><? echo $user->name, "&nbsp", $user->surname ?></title>
</head>
<body>

<div class="container mt-4">



<div class="container page">





<?if($user): ?>
    <h1 class="mt-4"><? echo $user->name, "&nbsp", $user->surname ?></h1>
    <p class="lead">@<? echo $user->username ?><code class="small"></code> </p>
		
		<h5 class="mb-5" ><?if($admin == 1){
		echo 'Статус: автор';
		}else{ 
		echo 'Статус: читатель';}?><h5>
		
		<button type="button" class="btn section__button section__button1 btn-outline-dark mb-2">Выйти</button>
	<?else: 
		header('Location: login.php');
	endif; ?>



		<div class="modal modal1">
			<div class="modal__main">
				<h2 class="modal__title">Потверждение</h2>
		  
				<div class="modal__container">
					<p>Вы уверены, что хотите выйти?</p>
				</div>

				<a href="logout.php"><button class="modal__btn">Да</button></a>
				<button class="modal__close">&#10006;</button>
			</div>
			<button class="modal__close">&#10006;</button>
		</div>
		
		
	
	
	
<?php
if($admin == 1){	
echo'
	
	<h2 class="mt-5 mb-5">Мои статьи:</h2>
	
	<a href="addpost.php"><button type="button" class="btn btn-outline-dark mb-4">Добавить статью</button><a/>
';}
?>
	
	<div class="d-flex flex-wrap ">
<?php	
	$search=$user->username;
	$connection = new mysqli($host, $db_user, $db_pass, $db_name);
	if($connection->connect_error){
		die("Ошибка: " . $connection->connect_error);
	}
	$sql = "SELECT * FROM articles WHERE `username` LIKE '%$search%' ORDER BY id DESC";
	$result = $connection->query($sql);	
	while($row = $result->fetch_assoc()){
		echo' 
		
	
		<div class=" card cardo mb-3 ">
			<a href="one.php?id='.$row["id"].'"><img src="'.$row["image"].'" class=" card-img-top fitin" width="100%" height="225" ></a>
			<div class="card-body">
				<strong class="d-inline-block mb-3 mr-5 text-primary">'. $row["name_category"].'</strong>
				·
				<small class="text-muted text-align: right">'. $row["date"].'</small>
				<a class="arctitle" href="one.php?id='.$row["id"].'"><h3 class="mb-0">'.$row["title"].'</h3></a>
				<div class="d-flex justify-content-between align-items-center">
					<div class="d-flex justify-content-between align-items-center mt-4">
						<div class="btn-group">
							<a href="edit.php?id='.$row["id"].'"><button type="button" class="btn btn-sm btn-outline-dark">Редактировать</button></a>
							<a href="delete.php?id='.$row["id"].'"><button type="button" name="del" class="btn btn-sm btn-outline-dark">Удалить</button></a>		  
						</div>

					</div>
					</div>
				</div>
			</div>	 
	

	
	';}
?>
		</div>
</div>
</div>



<?php require "footer.php" ?>
</body>
</html>