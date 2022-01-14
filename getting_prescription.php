<?php
session_start();

$db_name_r = "";
$db_all_r = "";

if ($_SESSION['privilege'] == "1") {
      if ($_POST['db_name_r'] !== "") {
            $db_name_r = $_POST['db_name_r'];
            require_once 'library/connect_db.php';
            $db_all_r = $connect->query("SELECT `id`, `name_r`, `text_r`,`category_r` FROM `recipes` WHERE `name_r` = '$db_name_r' ");
            $connect->close();
            if (mysqli_num_rows($db_all_r) == 1) {
                  $db_all_r = mysqli_fetch_assoc($db_all_r);
                  $_SESSION['id_r'] = $db_all_r['id'];
                  $_SESSION['name_r'] = $db_all_r['name_r'];
                  $_SESSION['text_r'] = $db_all_r['text_r'];
                  $_SESSION['category_r'] = $db_all_r['category_r'];
                  $_SESSION['message'] = "Отримання рецепту на редагування успішне!";
                  header('Location: /cabinet.php');
            } else if (mysqli_num_rows($db_all_r) == 0) {
                  $_SESSION['message'] = "Не знайшлось такого рецепта!!!";
                  header('Location: /cabinet.php');
            }
      } else {
            $_SESSION['message'] = "Помилка вибору рецепту для отримання!!!";
            header('Location: /cabinet.php');
      }
} else if ($_SESSION['user_auth'] === "true") {
      $_SESSION['message'] = "Помилка аутинтефікації!!!";
      header('Location: /cabinet.php');
} else {
      $_SESSION['message'] = "Не авторизовані дії!!!";
      header('Location: /form_authorization.php');
}
