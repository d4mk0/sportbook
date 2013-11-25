<?php
  include "blocks/connect_db.php";
  if(isset($_POST['login']) && isset($_POST['password'])) {
    $login = trim($_POST['login']);
    $encrypted_password = md5(trim($_POST['password']));
    $query = sprintf("SELECT * FROM users WHERE login='%s' AND encrypted_password='%s'", $login, $encrypted_password);
    $result = mysql_query($query);
    if((mysql_num_rows($result) == 0)) {
      echo "<script>alert('Uncorrect login and/or password');</script>";
      echo '<meta http-equiv="refresh" content="0;URL=login.php">';
    } else {
      $row = mysql_fetch_array($result);
      $str = $row['login']+$row['encrypted_password']+$row['email']+time();
      $hash = md5($str);
      $query = sprintf("UPDATE users SET secret_hash='%s' WHERE login='%s'", $hash, $login);
      mysql_query($query);
      setcookie("sportbook_shash", $hash);
      echo '<meta http-equiv="refresh" content="0;URL=index.php">';
    }
  } else if(isset($_GET['logout'])) {
      setcookie("sportbook_shash", "", time()-3600);
    echo '<meta http-equiv="refresh" content="0;URL=index.php">';
  } else echo '<meta http-equiv="refresh" content="0;URL=autorization.php">';

?>