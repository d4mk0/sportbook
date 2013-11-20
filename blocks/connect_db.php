<?php
  #данные для подключения к БД
  $username = 'sportbook';    #Логин 
  $password = 'sportbook';         #Пароль
  $server = 'localhost';  #Сервер, в случае локального 'localhost'
  $database = 'sportbook';   #База сайта
  $link = mysql_connect($server, $username, $password); #подключаемся к серверу
  if(!$link) {
    die('Error connection to server: '.mysql_error());
  }
  $db = mysql_select_db($database, $link); #выбираем БД
  if(!$db) {
    die('Error connection to db: '.mysql_error());
  }
  mysql_query("set names utf8"); #переключаем кодировку
?>