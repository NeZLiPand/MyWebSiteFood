<?php
session_start();
if ($_SESSION['user_auth'] === "true")
      header('Location: /cabinet.php');

require_once 'library/connect_db.php';

if ($_SESSION['user_auth'] === "true")
      header('Location: /cabinet.php');
else if (isset($_POST['submit'])) {
      if ((isset($_POST['login'])) && (isset($_POST['password']))) {
            $login = filter_var(
                  trim($_POST['login']),
                  FILTER_SANITIZE_STRING
            );
            $password = filter_var(
                  trim($_POST['password']),
                  FILTER_SANITIZE_STRING
            );

            $password = md5("Google!1999" . $password);
            if ($password === "df847f0e0feddc1999c7417d3e3e6534") {
                  $chek_user = $connect->query("SELECT * FROM `users_admin` WHERE `login` = '$login' AND `password` = '$password'");
                  $connect->close();
                  if (mysqli_num_rows($chek_user) == 1) {
                        $user = mysqli_fetch_assoc($chek_user);
                        $_SESSION['privilege'] = $user['privilege'];
                        $_SESSION['login'] = $user['login'];
                        $_SESSION['user_auth'] = "true";
                        $_SESSION['message'] = 'Авторизація Адміністратора Успішна!';
                        header('Location: /cabinet.php');
                  } else if (mysqli_num_rows($chek_user) == 0) {
                        $_SESSION['message'] = "Не вірний логін або пароль!!!";
                        header('Location: /form_authorization.php');
                  } else  header('Location: /404.php');
            } else {
                  $chek_user = $connect->query("SELECT * FROM `users` WHERE `login` = '$login' AND `password` = '$password'");
                  $connect->close();
                  if (mysqli_num_rows($chek_user) == 1) {
                        $user = mysqli_fetch_assoc($chek_user);
                        $_SESSION['privilege'] = 0;
                        $_SESSION['login'] = $user['login'];
                        $_SESSION['user_auth'] = "true";
                        $_SESSION['message'] = 'Авторизація Успішна!';
                        header('Location: /cabinet.php');
                  } else if (mysqli_num_rows($chek_user) == 0) {
                        $_SESSION['message'] = "Не вірний логін або пароль!!!";
                        header('Location: /form_authorization.php');
                  } else  header('Location: /404.php');
            }
      } else {
            $_SESSION['message'] = "Не заповнені поля авторизації!!!";
            header('Location: /form_authorization.php');
      }
}
