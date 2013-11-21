<header>
  <?php
  include "blocks/connect_db.php";
  if (isset($_COOKIE['sportbook_shash'])) {
    $query = sprintf("SELECT lastname, firstname FROM users WHERE secret_hash='%s'", $_COOKIE['sportbook_shash']);
    $result = mysql_query($query);
    if (mysql_num_rows($result) == 1) {
      $user = mysql_fetch_array($result);
      printf("<div id='user_welcome_message'>Мы рады вас снова видеть: %s %s</div>
        <div id='control_buttons'>
          <a href='index.php'>Главная</a>
          <a href='profile.php'>Профиль</a>
          <a href='auth.php?logout=true'>Выход</a>
        </div>", $user['lastname'], $user['firstname']);
    }
  } else echo "<div id='auth'>Вы можете <a href='register.php'>Зарегистрироваться</a> или <a href='login.php'>Войти</a></div>";
  ?>
</header>