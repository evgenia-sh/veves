<?php
function views_update(){
if($connection->connect_error){
    die("Ошибка: " . $connection->connect_error);
}
global $db;
$db = "UPDATE articles SET views = views + 1 WHERE id = '$id'";
$result = $connection->query($db);	
}

?>