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
            <th>id</th>
            <th>Дата регистрации</th>
            <th>Логин</th>
            <th>Дата рождения</th>
            <th>E-mail</th>
            <th>Администатор</th>
          </thead>
        <?php
          $users_on_page = 10;
          if($_GET['page'] > 0) $page = $_GET['page'];
          else $page = 1;
          $result = mysql_query("SELECT count(id) FROM articles");
          $row_count = mysql_fetch_array($result);
          $count = $row_count['count(id)'];
          $query = sprintf("SELECT * FROM users LIMIT %s OFFSET %s", $users_on_page, ($page-1)*$users_on_page);
          $count = $count-($page-1)*$users_on_page;
          $result = mysql_query($query);
          while ($row = mysql_fetch_array($result)) {
            printf("
              <tr>
                <td>%s</td>
                <td>%s</td>
                <td><a href='../profile.php?id=%s'>%s</a></td>
                <td>%s</td>
                <td>%s</td>
                <td>%s</td>
                <td></td>
              </tr>
            ", $row['id'], date("d/m/Y H:i", strtotime($row['created_at'])),
              $row['id'], $row['login'], date("d/m/Y", strtotime($row['birthday'])),
              $row['email'], ($row['is_admin'] ? "Да" : "Нет"));
          }
          $count_pages = $row_count['count(id)'] == $users_on_page ? $row_count['count(id)']/$users_on_page : $row_count['count(id)']/$users_on_page+1;
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