<?php
  if(isset($_COOKIE['sportbook_shash'])) {
    include "blocks/connect_db.php";
    $query = sprintf("SELECT * FROM users WHERE secret_hash='%s'", $_COOKIE['sportbook_shash']);
    $result = mysql_query($query);
    if(mysql_num_rows($result) == 0) {
      echo '<meta http-equiv="refresh" content="0;URL=register.php">';
      die();
    }
    if(isset($_GET['id'])) {
      $query = sprintf("SELECT * FROM users WHERE id='%s'", $_GET['id']);
      $result = mysql_query($query);
      if(mysql_num_rows($result) == 0) {
        echo '<meta http-equiv="refresh" content="0;URL=profile.php">';
        die();
      }
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
        <div class='articles_menu'>
              <span><a href='articles.php?type=my'>Мои статьи</a></span>
              <span><a href='add_article.php'>Добавить статью</a></span>
            </div>
        <?php
          if(isset($_GET['id'])) $query = sprintf("SELECT * FROM users WHERE id='%s'", $_GET['id']);
          else $query = sprintf("SELECT * FROM users WHERE secret_hash='%s'", $_COOKIE['sportbook_shash']);
          $user = mysql_fetch_array(mysql_query($query));
          $query = sprintf("SELECT * FROM users WHERE secret_hash='%s'", $_COOKIE['sportbook_shash']);
          $current_user = mysql_fetch_array(mysql_query($query));
          $user_status = $user['is_admin'] ? "<td>Роль:</td><td>Администратор</td>" : "<td>Роль:</td><td>Пользователь</td>";
          $admin_buttons = $current_user['is_admin'] ? sprintf("<tr><td><input type='button' value='Дать права администратора' onclick=\"
                if(confirm('Вы уверены, что хотите дать этому пользователю права администратора?'))
                location.href='admin/blocks/give_admin_rules.php?id=%s'\" /></td>
                <td><input type='button' value='Снять права администратора' onclick=\"
                if(confirm('Вы уверены, что хотите убрать у этого пользователя права администратора?'))
                location.href='admin/blocks/give_admin_rules.php?id=%s&remove=true'\" /></td></tr>
                <tr><td colspan='2' align='center'><input type='button' value='Удалить пользователя' onclick=\"
                if(confirm('Вы уверены, что хотите удалить пользователя?')) 
                location.href='admin/blocks/delete_user.php?id=%s'\" /></td></tr>", $user['id'], $user['id'], $user['id']) : "";
          printf("<div id='page_title'>Профиль пользователя %s</div>
          <table id='register_table'>
              <tr><td>Имя:</td><td>%s</td></tr>
              <tr><td>Фамилия:</td><td>%s</td></tr>
              <tr><td>E-mail:</td><td>%s</td></tr>
              <tr><td>Дата рождения:</td><td>%s</td></tr>
              <tr>%s</tr>
              %s
          </table>
          </div>", $user['login'], $user['firstname'], $user['firstname'], $user['email'], $user['birthday'], $user_status, $admin_buttons);
        ?>
      <?php include 'blocks/footer.php' ?>
    </div>
  </body>
</html>