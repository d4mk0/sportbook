<?php include "blocks/check_admin_rules.php" ?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8" />
    <link rel="stylesheet" href="../css/style.css" />
    <title>Спорт! Спорт! Спорт!</title>
  </head>
  <body>
    <div id="base_block">
      <?php include 'blocks/header.php' ?>
      <div id="content">
        <div id='page_title'>Статьи пользователей спортивного портала</div>
        <table id='t_article'>
          <thead>
            <th>Время публикации</th>
            <th>Название</th>
            <th>Автор</th>
            <th>Просмотров</th>
          </thead>
        <?php
          $articles_on_page = 10;
          if($_GET['page'] > 0) $page = $_GET['page'];
          else $page = 1;
          $result = mysql_query("SELECT count(id) FROM articles");
          $row_count = mysql_fetch_array($result);
          $count = $row_count['count(id)'];
          $query = sprintf("SELECT articles.*, users.firstname,lastname,login FROM articles, users WHERE articles.user_id=users.id ORDER BY articles.id DESC LIMIT %s
            OFFSET %s", $articles_on_page, ($page-1)*$articles_on_page);
          $count = $count-($page-1)*$articles_on_page;
          $result = mysql_query($query);
          while ($row = mysql_fetch_array($result)) {
            printf("
              <tr>
                <td>%s</td>
                <td><a href='../article.php?id=%s'>%s</a></td>
                <td><a href='../profile.php?id=%s'><strong>%s %s (%s)</strong></a></td>
                <td>%s</td>
                <td><input type='button' value='Удалить' onclick=\"if(confirm('Вы уверены, что хотите удалить эту статью?')) location.href='blocks/delete_article.php?id=%s'\" /></td>
              </tr>
            ", date("d/m/Y H:i", strtotime($row['created_at'])), $row['id'], $row['title'], $row['user_id'], $row['lastname'], $row['firstname'], $row['login'], $row['views'], $row['id']);
          }
          $count_pages = $row_count['count(id)'] == $articles_on_page ? $row_count['count(id)']/$articles_on_page : $row_count['count(id)']/$articles_on_page+1;
          if($count_pages >= 2){
            echo "<div class='pages'>Страницы: ";
            for($i = 1; $i <= $count_pages; $i++) {
              if($i != $page) printf("<span><a href='articles.php?page=%s'>%s</a></span>", $i, $i);
              else printf("<span>%s</span>", $i);
            }
            echo "</div>";
          }
        ?>
      </table>
      <?php include '../blocks/footer.php' ?>
    </div>
  </body>
</html>