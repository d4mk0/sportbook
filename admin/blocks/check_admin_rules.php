<?php
  function access_denied() {
    echo "<script>alert('У вас недостаточно привелегий');</script>";
    echo '<meta http-equiv="refresh" content="0;URL=../index.php">';
    die();
  }
  include "connect_db.php";
  if(isset($_COOKIE['sportbook_shash'])) {
    $query = sprintf("SELECT is_admin FROM users WHERE secret_hash='%s'", $_COOKIE['sportbook_shash']);
    $result = mysql_query($query);
    if(mysql_num_rows($result) == 0) access_denied();
    $row = mysql_fetch_array($result);
    if(!$row['is_admin']) access_denied();
  } else access_denied();
?>