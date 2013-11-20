<?
  include "connect_db.php";
  if(isset($_POST['login']) && isset($_POST['password']) &&isset($_POST['firstname'])
  && isset($_POST['lastname']) && isset($_POST['email']) && isset($_POST['birthday'])) {
    $login = trim($_POST['login']);
    $pass = md5(trim($_POST['password']));
    $firstname = trim($_POST['firstname']);
    $lastname = trim($_POST['lastname']);
    $email = trim($_POST['email']);
    $birthday = trim($_POST['birthday']);
    $query = sprintf("INSERT INTO users (login, encrypted_password, firstname,
    lastname, email, birthday) VALUES ('%s','%s','%s','%s','%s','%s')",
    $login, $pass, $firstname, $lastname, $email, $birthday);
    mysql_query($query);
    echo '<meta http-equiv="refresh" content="0;URL=../index.php?registered=true">';
  } else echo '<meta http-equiv="refresh" content="0;URL=../register.php">';
?>