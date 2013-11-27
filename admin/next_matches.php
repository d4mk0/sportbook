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
        <div id='page_title'>Ближайшие события</div>
        <table id="register_table">
          <form action="blocks/add_next_match.php" method="post">
            <tr><td>Время начала:</td><td><input type="datetime-local" name="start_time" /></td></tr>
            <tr><td>Соперники:</td><td><input type='text' name="opponents" size='50' /></td></tr>
            <tr><td>Вид спорта (Лига):</td><td><input type='text' name="type" size='50' /></td></tr>
            <tr><td colspan="2" align="center"><button type="submit">Добавить</button></td></tr>
          </form>
        </table>
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
              <a href='blocks/delete_next_match.php?id=%s'>Удалить</a>
            </div>
            ", date("d/m/Y H:i", strtotime($row['start_time'])), $row['opponents'], $row['type'], $row['id']);
          }
        ?>
        </div>
      <?php include '../blocks/footer.php' ?>
    </div>
  </body>
</html>