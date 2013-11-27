<?php
  include "check_admin_rules.php";
  include "connect_db.php";
  if(isset($_GET['id'])) {
    $id = $_GET['id'];
    $query = sprintf("DELETE FROM articles WHERE id=%s", $id);
    mysql_query($query);
  }
  echo '<meta http-equiv="refresh" content="0;URL=../articles.php">';
?>