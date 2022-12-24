<?php session_start() ?>
<html lang="ru">
<link rel="preconnect" href="https://fonts.googleapis.com"><link rel="preconnect" href="https://fonts.gstatic.com" crossorigin><link href="https://fonts.googleapis.com/css2?family=Rubik+Mono+One&display=swap" rel="stylesheet">
<link rel="stylesheet" href="css/style.css">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
	
		
	<header class="header blog-header lh-1 py-2 ">
	<div class="container">

			<div class="row flex-nowrap justify-content-between align-items-center border-bottom">
				<div class="col-4 pt-1">
					<a class="link-secondary" href="#">Design</a>
				</div>
				<div class="col-4 text-center">
					<h1 class="mt-1"><a class="blog-header-logo text-dark" href="index.php">Veves</a></h1>
				</div>
				<div class="col-4 d-flex justify-content-end align-items-center">
					<a class="link-secondary" href="search.php" aria-label="Search">
					
						<svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" class="mx-3" role="img" viewBox="0 0 24 24">
						<title>Search</title><circle cx="10.5" cy="10.5" r="7.5"></circle><path d="M21 21l-5.2-5.2"></path></svg>
					</a>
					
						<?php if(!isset($_SESSION['user'])) : ?>
						<a class="btn btn-sm btn-outline-dark" href="login.php">Войти</a>
						<? elseif(isset($_SESSION['user'])): ?>
						
						<a href="user.php"><svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" class="bi bi-person-circle " viewBox="0 0 16 16">
  <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0z"/>
  <path fill-rule="evenodd" d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8zm8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1z"/>
</svg></a>
						<? endif; ?>
				</div>
			</div>


  <div class=" container zznav-scroller py-1 mb-2">
  
    <nav class="nav d-flex justify-content-between mt-1">
		<a class="cate p-2 " href="index.php">#Актуальное</a>
		<a class="cate p-2 " href="category.php?name_category=Новости">Новости</a>
		<a class="cate p-2 " href="category.php?name_category=Тренды">Тренды</a>
		<a class="cate p-2 " href="category.php?name_category=Lifehacks">Lifehacks</a>
		<a class="cate p-2 " href="category.php?name_category=Истории">Истории</a>
		<a class="cate p-2 " href="category.php?name_category=Интервью">Интервью</a>
		<a class="cate p-2 " href="category.php?name_category=Другое">Другое</a>

    </nav>
  </div>

</div>
</header>
</html>