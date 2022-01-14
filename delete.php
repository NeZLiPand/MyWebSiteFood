<?php
session_start();

if ($_SESSION['privilege'] === "1") {
   require_once 'library/connect_db.php';
   $id_r_for_delete = $_GET['id'];
   $destination_for_delete_old_poster_is_destination = $connect->query("SELECT `poster_destination` FROM `recipes` WHERE `id` = '$id_r_for_delete' ");
   $destination_for_delete_old_poster_is_destination =  mysqli_fetch_assoc($destination_for_delete_old_poster_is_destination);

   $destination_for_delete_old_poster_is_destination =  $destination_for_delete_old_poster_is_destination['poster_destination'];
   if (unlink($destination_for_delete_old_poster_is_destination)) {
      $connect->query("DELETE FROM `recipes` WHERE `recipes`.`id` = '$id_r_for_delete'");
      $connect->close();
      $_SESSION['message'] = "Успішне видалення рецепту!!!";
      header('Location: /cabinet.php');
   } else {
      $_SESSION['message'] = "Помилка при видаленні файлу 'Постер' з серверу!!!";
      header('Location: /cabinet.php');
   }
} else if ($_SESSION['user_auth'] === "true") {
   $_SESSION['message'] = "Помилка аутинтефікації!!!";
   header('Location: /cabinet.php');
} else {
   $_SESSION['message'] = "Не авторизовані дії!!!";
   header('Location: /form_authorization.php');
}
