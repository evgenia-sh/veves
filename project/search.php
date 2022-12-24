<?php require"db.php"?>
<?php require "header.php"?>


<html>
<head>
	<link rel="stylesheet" href="css/style.css">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
	<title>Поиск</title>
</head>
<body>

<div class="container mt-4 page">

<form action="search.php?go" method="POST">
	<div class="input-group mb-3">
		<input type="text"  name="search" class="form-control" placeholder="Поиск" aria-label="Начните вводить" aria-describedby="basic-addon2">
		<button type="submit" name="btn_search" class="btn btn-dark input-group-text">Найти</button>
	</div>			
</form>





<?php 
	$search=$_POST['search'];
	$connection = new mysqli($host, $db_user, $db_pass, $db_name);
	if($connection->connect_error){
		echo("Ошибка: " . $connection->connect_error);
	}
	if(isset($_POST['btn_search'])){
		if(!empty($search)){
			echo '<br> Ваш запрос: <a class="resear">' .$search. '</a><br> <br>';
			$query=$connection->query("SELECT * FROM `articles` WHERE `title` LIKE '%$search%'");
			if(mysqli_num_rows($query)>0){
				while($result=mysqli_fetch_assoc($query)){
						echo' 

<div class="d-flex flex-wrap ">
			<div class="card mb-3 cardo">
				<a href="one.php?id='.$result["id"].'"><img src="'.$result["image"].'" class=" card-img-top fitin" width="100%" height="225" ></a>
				<div class="card-body">
					<strong class="d-inline-block mb-3 mr-5 text-primary">'. $result["name_category"].'</strong>
					·
					<small class="text-muted text-align: right">'. $result["date"].'</small>
					<a class="arctitle" href="one.php?id='.$result["id"].'"><h3 class="mb-0">'.$result["title"].'</h3></a>
					<div class="d-flex justify-content-between align-items-center">
						<p class="card-text mb-3"></p>
					</div>
				</div>
			</div>	  		  
		  
	</div>		
			';}
			}else{
				echo 'Ничего не найдено';
			}
	}else{
		echo 'Вы ничего не ввели';
	}		
}	
?>

</div>



<?php require "footer.php" ?>
</body>
</html>