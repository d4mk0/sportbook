<?php
  include "connect_db.php";
  if(isset($_POST['message'])) {
    if(isset($_COOKIE['sportbook_shash'])) {
      include "connect_db.php";
      $query = sprintf("SELECT * FROM users WHERE secret_hash='%s'", $_COOKIE['sportbook_shash']);
      $result = mysql_query($query);
      if(mysql_num_rows($result) == 0) {
        echo '<meta http-equiv="refresh" content="0;URL=register.php">';
        die();
      }
      $user = mysql_fetch_array($result);
      $message = trim($_POST['message']);
      if ($message == "") {
        echo "<script>alert('Вы ввели текст сообщения');</script>";
        echo '<meta http-equiv="refresh" content="0;URL=../chat.php">';
      } else {
        $query = sprintf("INSERT INTO messages (text, user_id)
          VALUES ('%s','%s')", $message, $user['id']);
        mysql_query($query);
        echo '<meta http-equiv="refresh" content="0;URL=../chat.php">';
      }
    }
  } else echo '<meta http-equiv="refresh" content="0;URL=../register.php">';
?>