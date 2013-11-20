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
        <div id="page_title">Регистрация на спортивном портале</div>
        <table id="register_table">
          <form action="blocks/register_user.php" method="post">
            <tr><td>Логин:</td><td><input type="text" name="login" /></td></tr>
            <tr><td>Пароль:</td><td><input type="password" name="password" /></td></tr>
            <tr><td>Имя:</td><td><input type="text" name="firstname" /></td></tr>
            <tr><td>Фамилия:</td><td><input type="text" name="lastname" /></td></tr>
            <tr><td>E-mail:</td><td><input type="email" name="email" /></td></tr>
            <tr><td>Дата рождения:</td><td><input type="date" name="birthday" /></td></tr>
            <tr><td colspan="2" align="center"><button type="submit">Регистрация</button></td></tr>
          </form>
        </table>
        
      </div>
      <?php include 'blocks/footer.php' ?>
    </div>
  </body>
</html>