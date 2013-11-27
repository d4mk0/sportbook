<?php
  include "check_admin_rules.php";
  if(isset($_GET['id'])) {
      include "connect_db.php";
      $id = trim($_GET['id']);
      if ($id == "") {
        echo "<script>alert('Вы не выбрали пользователя');</script>";
        echo '<meta http-equiv="refresh" content="0;URL=../index.php">';
      } else {
        $query = sprintf("UPDATE users SET is_admin='%s' WHERE id=%s", (isset($_GET['remove']) ? "0": "1"), $id);
        mysql_query($query);
        echo '<meta http-equiv="refresh" content="0;URL=../../profile.php?id='.$id.'">';
      }
    } else echo '<meta http-equiv="refresh" content="0;URL=../index.php">';
?>