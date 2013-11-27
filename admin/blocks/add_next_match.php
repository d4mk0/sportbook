<?php
  include "check_admin_rules.php";
  include "connect_db.php";
  if(isset($_POST['start_time']) && isset($_POST['opponents']) && isset($_POST['type'])) {
    $start_time = trim($_POST['start_time']);
    $opponents = trim($_POST['opponents']);
    $type = trim($_POST['type']);
    if ($start_time == "" || $opponents == "" || $type == "") {
      echo "<script>alert('Вы ввели не все данные');</script>";
      echo '<meta http-equiv="refresh" content="0;URL=../next_matches.php">';
    } else {
      $query = sprintf("INSERT INTO matches (opponents, start_time, type)
      VALUES ('%s','%s','%s')", $opponents, $start_time, $type);
      mysql_query($query);
      echo '<meta http-equiv="refresh" content="0;URL=../next_matches.php">';
    }
  } else echo '<meta http-equiv="refresh" content="0;URL=../register.php">';
?>