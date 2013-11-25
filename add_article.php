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
        <div id='page_title'>Добавление статьи на спортивный портал</div>
        <table id="register_table">
          <form action="blocks/add_article.php" method="post">
            <tr><td>Заголовок:</td><td><input type="text" name="title" size='65'/></td></tr>
            <tr><td>Описание:</td><td><textarea name="description" cols='50' rows='3'></textarea></td></tr>
            <tr><td>Текст:</td><td><textarea name="text" cols='50' rows='5'></textarea></td></tr>
            <tr><td colspan="2" align="center"><button type="submit">Добавить</button></td></tr>
          </form>
        </table>
      <?php include 'blocks/footer.php' ?>
    </div>
  </body>
</html>