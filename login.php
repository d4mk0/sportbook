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
        <div id="page_title">Авторизация на спортивном портале</div>
        <table id="register_table">
          <form action="auth.php" method="post">
            <tr><td>Логин:</td><td><input type="text" name="login" /></td></tr>
            <tr><td>Пароль:</td><td><input type="password" name="password" /></td></tr>
            <tr><td colspan="2" align="center"><button type="submit">Войти</button></td></tr>
          </form>
        </table>
        
      </div>
      <?php include 'blocks/footer.php' ?>
    </div>
  </body>
</html>