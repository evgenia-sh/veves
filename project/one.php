<?php require"db.php"?>
<?php require "header.php"?>
<?php
$id = $_GET["id"];
?>
<html>
<head>
	<link rel="stylesheet" href="css/style.css">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
	<title>Статья</title>
</head>
<body>

<?php
$connection = new mysqli($host, $db_user, $db_pass, $db_name);
if($connection->connect_error){
    die("Ошибка: " . $connection->connect_error);
}
$sql = "SELECT * FROM articles WHERE id=$id";
$result = $connection->query($sql);	
$row = $result->fetch_assoc()
?>

<div class="container mt-4 page">

	<br>
	<a class="link-secondary" onclick="history.back(-1); return false;" href="#" value="Назад">
	<svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-arrow-left" viewBox="0 0 16 16">
	<path fill-rule="evenodd" d="M15 8a.5.5 0 0 0-.5-.5H2.707l3.147-3.146a.5.5 0 1 0-.708-.708l-4 4a.5.5 0 0 0 0 .708l4 4a.5.5 0 0 0 .708-.708L2.707 8.5H14.5A.5.5 0 0 0 15 8z"/>
	</svg>
	</a>
<div class="pricing-header p-3 pb-md-4 mx-auto text-center">
      <h1 class="display-4 fw-normal"><?php echo $row["title"]; ?></h1>
	  <br>
      <a href ="category.php?name_category=<?php echo $row["name_category"]; ?>"><button class="btn btn-dark"><?php echo $row["name_category"]; ?></button></a>
	  </div>
<br>
	<div align="right" class="mb-4">
	<strong class="aut "><?php echo $row["name_user"]; ?></strong> · <small class="dat"><?php echo $row["date"]; ?></small>
	</div>
		
		<a class="" href="#">
		  <img src="<?php echo $row["image"]; ?>" class=" mb-5 w-100 sizeone2 sizeone" alt="...">
		  </a>
		 


<p><?php echo nl2br( $row["text"]); ?></p>



<br><hr><h1 class="mt-4">Комментарии<h1><br>
<form  class="mb-3" action="" method="POST">

<textarea value="" name="comments" class="cols form-control" cols="45" rows="8" maxlength="65525" required="required" style="width: 1250px; height: 120px;" placeholder="Напишите комментарий">
	</textarea>
	<input class="btn btn-sm btn-dark mt-2" type="submit" value="Отправить" name="add_com">
</form>	

	
	
</div>

<?php require "footer.php" ?>
</body>
</html>