<?php
require "libs/rb-mysql.php"; // Подключаем библиотеку RedBeanPHP

// Подключаемся к БД
R::setup( 'mysql:host=localhost;dbname=magaz','root', '' );

$host='localhost';
$db_name='magaz';
$db_user='root';
$db_pass='';
$driver='mysql';
$charset='utf8';

session_start(); // Создание сессию (автризация)

// Проверка подключения к БД
if(!R::testConnection()) die('Нет подключения в Базе данных');


?>