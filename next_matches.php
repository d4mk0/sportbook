<?php
  if(isset($_COOKIE['sportbook_shash'])) {
    include "blocks/connect_db.php";
    $query = sprintf("SELECT * FROM users WHERE secret_hash='%s'", $_COOKIE['sportbook_shash']);
    $result = mysql_query($query);
    if(mysql_num_rows($result) == 0) {
      echo '<meta http-equiv="refresh" content="0;URL=register.php">';
      die();
    }
  } else {
    echo '<meta http-equiv="refresh" content="0;URL=register.php">';
    die();
  }
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8" />
    <link rel="stylesheet" href="css/style.css" />
    <title>Спорт! Спорт! Спорт!</title>
  </head>
  <body>
    <div id="base_block">
      <?php include 'blocks/header.php' ?>
      <div id="content">
        <div id='page_title'>Ближайшие события</div>
        <div id='matches'>
        <?php
          $query = "SELECT * FROM matches WHERE start_time > NOW() ORDER BY start_time LIMIT 10";
          $result = mysql_query($query);
          while ($row = mysql_fetch_array($result)) {
            printf("
            <div class='match'>
              <div class='date'>%s</div>
              <div class='opponents'>%s</div>
              <div class='type'>%s</div>
            </div>
            ", date("d/m/Y H:i", strtotime($row['start_time'])), $row['opponents'], $row['type']);
          }
        ?>
        </div>
      <?php include 'blocks/footer.php' ?>
    </div>
  </body>
</html>