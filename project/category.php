<?php require"db.php"?>
<?php require "header.php"?>
<?php $cat=$_GET['name_category'];?>


<html>
<head>
	<link rel="stylesheet" href="css/style.css">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
	<title><? echo $cat; ?></title>
</head>
<body>


<div class="container page">
<br>
<h2 class=" blog-header-logo text-dark"><? echo $cat; ?></h2>
<br>

<div class="d-flex flex-wrap ">

<?php

	//$cat=$_POST['search'];
	
	//print_r ($cat);	
	$connection = new mysqli($host, $db_user, $db_pass, $db_name);
	if($connection->connect_error){
		echo("Ошибка: " . $connection->connect_error);
	}	
		$sql=("SELECT * FROM `articles` WHERE `name_category` = '$cat'");
		//print_r ($sql);	
		$row = $connection->query($sql);	
		while($result = $row->fetch_assoc()){
			echo'			

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
		  
	
';}
?>
</div>
</div>	



<?php require "footer.php" ?>
</body>
</html>