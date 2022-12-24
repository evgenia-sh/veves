<?php require "db.php" ?>
<?php require "header.php"?>

<html lang="ru">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv=X-UA_Compatible" content="ie=edge">	
	<link rel="preconnect" href="https://fonts.googleapis.com"><link rel="preconnect" href="https://fonts.gstatic.com" crossorigin><link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
	
	<link rel="stylesheet" href="css/style.css">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

	<title>Главная страница</title>
</head>
<body>

<div class="container page">
<div class=" mb-2 ">
	<div id="carouselExampleCaptions" class="carousel slide" data-bs-ride="carousel">

<?php

$connection = new mysqli($host, $db_user, $db_pass, $db_name);
if($connection->connect_error){
    die("Ошибка: " . $connection->connect_error);
}
$sql = "SELECT * FROM articles ORDER BY RAND(id) DESC LIMIT 1";
$result = $connection->query($sql);	
//$row = $result->fetch_assoc();
while($row = $result->fetch_assoc()){
	
	
	
echo '
	  <div class="carousel-inner">
		<div class="carousel-item  active carx">
		<a href="one.php?id='.$row["id"].'"><div class="sizecarusel gradientcar">
		  <img src="'.$row["image"].'" class="d-block w-100 fitin carx" alt="...">
		 </div>
		  <div class="carousel-caption d-none d-md-block">
			<h3>'.$row["title"].'</h3>
			<p>'.$row["date"].'</p>
		  </div>
		</div></a>
';}
?>
	  </div>
	  <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
		<span class="carousel-control-prev-icon" aria-hidden="true"></span>
		<span class="visually-hidden">Previous</span>
	  </button>
	  <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
		<span class="carousel-control-next-icon" aria-hidden="true"></span>
		<span class="visually-hidden">Next</span>
	  </button>
	</div>
</div>


 <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js" integrity="sha384-q2kxQ16AaE6UbzuKqyBE9/u/KzioAlnx2maXQHiDX9d4/zp8Ok3f+M7DPm+Ib6IU" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.min.js" integrity="sha384-pQQkAEnwaBkjpqZ8RU1fF1AKtTcHJwFl3pblpTlHXybJjHpMYo79HY3hIi4NKxyj" crossorigin="anonymous"></script>
	
	


<br>
<h2 class=" blog-header-logo text-dark">#Актуальное</h2>
<br>

<div class="d-flex flex-wrap ">

<?php


$sql = "SELECT * FROM articles ORDER BY id DESC";
$result = $connection->query($sql);	
while($row = $result->fetch_assoc()){
	echo' 


			<div class="card mb-3 cardo">
				<a href="one.php?id='.$row["id"].'"><img src="'.$row["image"].'" class=" card-img-top fitin" width="100%" height="225" ></a>
				<div class="card-body">
					<strong class="d-inline-block mb-3 mr-5 text-primary">'. $row["name_category"].'</strong>
					·
					<small class="text-muted text-align: right">'. $row["date"].'</small>
					<a class="arctitle" href="one.php?id='.$row["id"].'"><h3 class="mb-0">'.$row["title"].'</h3></a>
					<div class="d-flex justify-content-between align-items-center">
						<p class="card-text mb-3"></p>
					</div>
				</div>
			</div>	 		  
		  

		
';}
?>
</div>
</div>	
	



<?php require "footer.php" ?>
</body>
</html>