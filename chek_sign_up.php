<?php
session_start();
if ($_SESSION['user_auth'] === "true")
      header('Location: /cabinet.php');
      
require_once 'library/connect_db.php';

if (isset($_POST['submit'])) {
      if ($_POST['login'] !== "") {
            if ($_POST['password'] !== "") {
                  if ($_POST['password_two'] !== "") {
                        $login = filter_var(
                              trim($_POST['login']),
                              FILTER_SANITIZE_STRING
                        );
                        $password = filter_var(
                              trim($_POST['password']),
                              FILTER_SANITIZE_STRING
                        );
                        $password_two = filter_var(
                              trim($_POST['password_two']),
                              FILTER_SANITIZE_STRING
                        );
                        if (mb_strlen($login) < 3) {
                              $_SESSION['message'] = 'Занадто малий логін, логін повинен мати від 3 до 21 символа включно!!!';
                              header('Location: /form_registration.php');
                        } else if (mb_strlen($login) > 21) {
                              $_SESSION['message'] = 'Занадто великий логін, логін повинен мати від 3 до 21 символа включно!!!';
                              header('Location: /form_registration.php');
                        } else if (mb_strlen($password) < 6) {
                              $_SESSION['message'] = 'Занадто маленький пароль, пароль повинен мати від 6 до 32 символів включно!!!';
                              header('Location: /form_registration.php');
                        } else if (mb_strlen($password) > 32) {
                              $_SESSION['message'] = 'Занадто великий пароль, пароль повинен мати від 6 до 32 символів включно!!!';
                              header('Location: /form_registration.php');
                        } else if ($password !== $password_two) {
                              $_SESSION['message'] = 'Вже б зареєструвалися але паролі не співпадають!!!';
                              header('Location: /form_registration.php');
                        } else {
                              //<--Додаємо нового користувача в БД-->
                              $password = md5("Google!1999" . $password);
                              $date_time_y_m_d_add_r = date('Y-m-d H:i:s');
                              $connect->query("INSERT INTO`users` (`id`, `login`, `password`, `date_time_add_user`) VALUES (NULL, '$login', '$password', '$date_time_y_m_d_add_r')");
                              $connect->close();
                              if ($connect) {
                                    $_SESSION['message'] = 'Реєстрація Успішна!';
                                    header('Location: /form_authorization.php');
                              } else {
                                    $_SESSION['message'] = 'Помилка при підключенні до серверу!!!';
                                    header('Location: /form_registration.php');
                              }
                        }
                  } else {
                        $_SESSION['message'] = 'Пусте поле Підтвердження (повторення) паролю!!!';
                        header('Location: /form_registration.php');
                  }
            } else {
                  $_SESSION['message'] = 'Пусте поле Паролю!!!';
                  header('Location: /form_registration.php');
            }
      } else {
            $_SESSION['message'] = 'Пусте поле Логіну!!!';
            header('Location: /form_registration.php');
      }
} else {
      $_SESSION['message'] = 'Заповніть форму!!!';
      header('Location: /form_registration.php');
}
