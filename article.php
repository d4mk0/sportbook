<?php
  if(isset($_COOKIE['sportbook_shash'])) {
    include "blocks/connect_db.php";
    $query = sprintf("SELECT * FROM users WHERE secret_hash='%s'", $_COOKIE['sportbook_shash']);
    $result = mysql_query($query);
    if(mysql_num_rows($result) == 0) {
      echo '<meta http-equiv="refresh" content="0;URL=register.php">';
      die();
    }
    $query = sprintf("SELECT articles.*, users.firstname,lastname FROM articles, users WHERE articles.user_id=users.id AND articles.id=%s", $_GET['id']);
    $result = mysql_query($query);
    if(mysql_num_rows($result) == 0) {
      echo '<meta http-equiv="refresh" content="0;URL=articles.php">';
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
        <div id='page_title'>Статьи пользователей спортивного портала</div>
          <div class='articles_menu'>
            <span><a href='articles.php'>Все статьи</a></span>
            <span><a href='articles.php?type=top5'>5 самых популярных статей</a><br></span>
            <span><a href='articles.php?type=my'>Мои статьи</a></span>
            <span><a href='add_article.php'>Добавить статью</a></span>
          </div>
        <?php
          $query = sprintf("SELECT articles.*, users.firstname,lastname,login FROM articles, users WHERE articles.user_id=users.id AND articles.id=%s", $_GET['id']);
          
          $result = mysql_query($query);
          $row = mysql_fetch_array($result);
          mysql_query(sprintf("UPDATE articles SET views=%s WHERE id=%s", ++$row['views'], $row['id']));
          printf("
          <div id='article'>
            <div class='title'>%s</div>
            <div class='content'>%s</div>
            <div class='author'>Автор: <a href='profile.php?id=%s'><strong>%s %s</strong> (%s)</a></div>  
            <div class='views'>Просмотрено: %s раз</div>  
            <div class='date'>%s</div>
          </div>
          ", $row['title'], $row['text'], $row['user_id'], $row['lastname'], $row['firstname'], $row['login'],  $row['views'], date("d/m/Y H:i", strtotime($row['created_at'])));
        ?>
      <?php include 'blocks/footer.php' ?>
    </div>
  </body>
</html>