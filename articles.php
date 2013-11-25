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
        <div id='page_title'>Статьи пользователей спортивного портала</div>
          <div class='articles_menu'>
            <span><a href='articles.php'>Все статьи</a></span>
            <span><a href='articles.php?type=top5'>5 самых популярных статей</a><br></span>
            <span><a href='articles.php?type=my'>Мои статьи</a></span>
            <span><a href='add_article.php'>Добавить статью</a></span>
          </div>
        <?php
          if($_GET['type'] == 'top5') {
            $query = "SELECT articles.*, users.firstname,lastname FROM articles, users WHERE articles.user_id=users.id ORDER BY articles.views DESC LIMIT 5";
          } else {
            if($_GET['type'] == 'my') {
              $query = sprintf("SELECT * FROM users WHERE secret_hash='%s'", $_COOKIE['sportbook_shash']);
              $user = mysql_fetch_array(mysql_query($query));
              $query = sprintf("SELECT articles.*,users.firstname,lastname FROM articles, users WHERE articles.user_id=%s AND articles.user_id=users.id ORDER BY articles.id DESC", $user['id']);
            } else {
              $articles_on_page = 5;
              if($_GET['page'] > 0) $page = $_GET['page'];
              else $page = 1;
              $result = mysql_query("SELECT count(id) FROM articles");
              $row_count = mysql_fetch_array($result);
              $count = $row_count['count(id)'];
              $query = sprintf("SELECT articles.*, users.firstname,lastname FROM articles, users WHERE articles.user_id=users.id ORDER BY articles.id DESC LIMIT %s
                OFFSET %s", $articles_on_page, ($page-1)*$articles_on_page);
              $count = $count-($page-1)*$articles_on_page;
            }
          }
          $result = mysql_query($query);
          while ($row = mysql_fetch_array($result)) {
            printf("
            <div class='article'>
              <div class='date'>%s</div>
              <div class='title'><a href='article.php?id=%s'>%s</a></div>
              <div class='description'>%s</div>
              <div class='author'>Автор: <a href='profile.php?id=%s'><strong>%s %s</strong></a></div>  
              <div class='views'>Просмотрено: %s раз</div>  
              <div class='read_more'><a href='article.php?id=%s'>Читать полностью →</a></div>
            </div>
            ", date("d/m/Y H:i", strtotime($row['created_at'])), $row['id'], $row['title'], $row['description'], $row['user_id'], $row['lastname'], $row['firstname'], $row['views'], $row['id']);
          }
          if ($_GET['type'] != 'top5' && $_GET['type'] != 'my') {
            $count_pages = $row_count['count(id)'] == $articles_on_page ? $row_count['count(id)']/$articles_on_page : $row_count['count(id)']/$articles_on_page+1;
            if($count_pages >= 2){
              echo "<div class='pages'>Страницы: ";
              for($i = 1; $i <= $count_pages; $i++) {
                if($i != $page) printf("<span><a href='articles.php?page=%s'>%s</a></span>", $i, $i);
                else printf("<span>%s</span>", $i);
              }
              echo "</div>";
            }
          }
        ?>
      <?php include 'blocks/footer.php' ?>
    </div>
  </body>
</html>