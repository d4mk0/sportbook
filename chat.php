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
        <div id='page_title'>Чат для пользователей спортивного портала</div>
          <div class='articles_menu'>
            <span><a href='chat.php'>Обновить</a></span>
          </div>
          <table id="register_table">
            <tr><td colspan="2" align="center">Добавление сообщения</td></tr>
            <form action="blocks/add_message.php" method="post">
              <tr><td>Введите сообщение:</td><td><textarea  name="message" cols="39" rows="3"></textarea></td></tr>
              <tr><td colspan="2" align="center"><button type="submit">Отправить</button></td></tr>
            </form>
          </table>
        <div id="messages">
        <?php
          $messages_on_page = 20;
          if($_GET['page'] > 0) $page = $_GET['page'];
          else $page = 1;
          $result = mysql_query("SELECT count(id) FROM messages");
          $row_count = mysql_fetch_array($result);
          $count = $row_count['count(id)'];
          $query = sprintf("SELECT messages.*, users.firstname,lastname,login FROM messages, users WHERE messages.user_id=users.id ORDER BY messages.id DESC LIMIT %s
            OFFSET %s", $messages_on_page, ($page-1)*$messages_on_page);
          $count = $count-($page-1)*$messages_on_page;
          $result = mysql_query($query);
          while ($row = mysql_fetch_array($result)) {
            printf("
            <div class='message'>
              <span class='author'><a href='profile.php?id=%s'><strong>%s %s</strong> (%s)</a></span>
              <span class='date'>%s</span>: 
              <span class='description'>%s</span>
            </div>
            ", $row['user_id'], $row['lastname'], $row['firstname'], $row['login'], date("d/m/Y H:i", strtotime($row['created_at'])), $row['text']);
          }
          if ($_GET['type'] != 'top5' && $_GET['type'] != 'my') {
            $count_pages = $row_count['count(id)'] == $messages_on_page ? $row_count['count(id)']/$messages_on_page : $row_count['count(id)']/$messages_on_page+1;
            if($count_pages >= 2){
              echo "<div class='pages'>Страницы: ";
              for($i = 1; $i <= $count_pages; $i++) {
                if($i != $page) printf("<span><a href='chat.php?page=%s'>%s</a></span>", $i, $i);
                else printf("<span>%s</span>", $i);
              }
              echo "</div>";
            }
          }
        ?>
        </div>
      <?php include 'blocks/footer.php' ?>
    </div>
  </body>
</html>