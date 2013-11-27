<?php
  include "check_admin_rules.php";
  if(isset($_GET['id'])) {
      include "connect_db.php";
      $id = trim($_GET['id']);
      if ($id == "") {
        echo "<script>alert('Вы не выбрали матч');</script>";
        echo '<meta http-equiv="refresh" content="0;URL=../chat.php">';
      } else {
        $query = sprintf("DELETE FROM messages WHERE id=%s", $id);
        mysql_query($query);
        echo '<meta http-equiv="refresh" content="0;URL=../chat.php">';
      }
    } else echo '<meta http-equiv="refresh" content="0;URL=../chat.php">';
?>