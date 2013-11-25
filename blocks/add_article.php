<?php
  include "connect_db.php";
  if(isset($_POST['title']) && isset($_POST['description']) && isset($_POST['text'])) {
    if(isset($_COOKIE['sportbook_shash'])) {
      include "connect_db.php";
      $query = sprintf("SELECT * FROM users WHERE secret_hash='%s'", $_COOKIE['sportbook_shash']);
      $result = mysql_query($query);
      if(mysql_num_rows($result) == 0) {
        echo '<meta http-equiv="refresh" content="0;URL=register.php">';
        die();
      }
      $user = mysql_fetch_array($result);
      $title = trim($_POST['title']);
      $description = trim($_POST['description']);
      $text = trim($_POST['text']);
      if ($title == "" || $description == "" || $text == "") {
        echo "<script>alert('Вы ввели не все данные');</script>";
        echo '<meta http-equiv="refresh" content="0;URL=../add_article.php">';
      } else {
        $query = sprintf("INSERT INTO articles (title, description, text, user_id)
          VALUES ('%s','%s','%s','%s')", $title, $description, $text, $user['id']);
        mysql_query($query);
        echo '<meta http-equiv="refresh" content="0;URL=../articles.php?type=my">';
      }
    }
  } else echo '<meta http-equiv="refresh" content="0;URL=../register.php">';
?>