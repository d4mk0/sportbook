<?php
  include "connect_db.php";
  if(isset($_POST['login']) && isset($_POST['password']) &&isset($_POST['firstname'])
  && isset($_POST['lastname']) && isset($_POST['email']) && isset($_POST['birthday'])) {
    $login = trim($_POST['login']);
    $pass = trim($_POST['password']);
    $encrypred_password = md5($pass);
    $firstname = trim($_POST['firstname']);
    $lastname = trim($_POST['lastname']);
    $email = trim($_POST['email']);
    $birthday = trim($_POST['birthday']);
    if ($login == "" || $pass == "" || $firstname == "" || $lastname == "" || $email == "" || $birthday == "") {
      echo "<script>alert('Вы ввели не все данные');</script>";
      echo '<meta http-equiv="refresh" content="0;URL=../register.php">';
    } else {
      if((mysql_num_rows(mysql_query(sprintf("SELECT id FROM users WHERE login='%s'", $login))) == 1)) {
        echo "<script>alert('Пользователь с таким именем пользователя уже существует');</script>";
        echo '<meta http-equiv="refresh" content="0;URL=../register.php">';
      } else {
        $query = sprintf("INSERT INTO users (login, encrypted_password, firstname,
        lastname, email, birthday) VALUES ('%s','%s','%s','%s','%s','%s')",
        $login, $encrypred_password, $firstname, $lastname, $email, $birthday);
        mysql_query($query);
        echo '<meta http-equiv="refresh" content="0;URL=../index.php">';
      }
    }
  } else echo '<meta http-equiv="refresh" content="0;URL=../register.php">';
?>