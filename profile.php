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
        <?php
          $query = sprintf("SELECT * FROM users WHERE secret_hash='%s'", $_COOKIE['sportbook_shash']);
          $user = mysql_fetch_array(mysql_query($query));
          printf("<div id='page_title'>Профиль пользователя %s</div>
          <table id='register_table'>
              <tr><td>Имя:</td><td>%s</td></tr>
              <tr><td>Фамилия:</td><td>%s</td></tr>
              <tr><td>E-mail:</td><td>%s</td></tr>
              <tr><td>Дата рождения:</td><td>%s</td></tr>
          </table>
          </div>", $user['login'], $user['firstname'], $user['firstname'], $user['email'], $user['birthday']);
        ?>
      <?php include 'blocks/footer.php' ?>
    </div>
  </body>
</html>