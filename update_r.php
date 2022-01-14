<?php
session_start();
if ($_SESSION['privilege'] === "1") {
   require_once 'library/connect_db.php';
   $update_name_r = "";                //Нова назва рецепту
   $update_category_r = "";         //Нова Категорія рецепту
   $update_text_r = "";          //Новий рецепт
   $update_preview_r = "";            //Новий Постер рецепту
   $id_r_for_update  = "";  //Назва рецепту який буде оновлюватись

   $new_file_name = "";         // Початкова назва файлу: Постер
   $new_file_type = "";         // Тип файлу: Постер
   $new_file_tmp_name = "";     // Тимчасове місцезнаходження на сервері файлу: Постер
   $new_file_error = "";        // Помилка при завантаженні фалйлу: Постер
   $new_file_size = "";         // Розмір файлу: Постер
   $file_ext = "";    // 
   $file_actual_ext = "";    // 
   $allowed = "";    // 
   $file_name_new = "";    //
   $file_destination = "";

   // <--Початок-->
   $update_name_r = $_POST['update_name_r'];
   $update_category_r = $_POST['update_category_r'];
   $update_text_r = $_POST['update_text_r'];

   $new_file_name = $_FILES['update_preview_r']['name'];
   $new_file_type = $_FILES['update_preview_r']['type'];
   $new_file_tmp_name = $_FILES['update_preview_r']['tmp_name'];
   $new_file_error = $_FILES['update_preview_r']['error'];
   $new_file_size = $_FILES['update_preview_r']['size'];
   $file_ext = explode('.', $new_file_name);
   $file_actual_ext = strtolower(end($file_ext));
   $allowed = array('jpg', 'jpeg', 'png');
   if (!($update_name_r === "")) {
      if (!($update_category_r === "")) {
         if (!($update_text_r === "")) {
            if (!($new_file_name === "")) {
               if (in_array($file_actual_ext, $allowed)) {
                  if ($new_file_error === 0) {
                     if ($new_file_size < 1200000) {
                        $id_r_for_update = $_SESSION['id_r'];
                        unset($_SESSION['id_r']);
                        // Видаляємо старий постер із серверу перед записом нового
                        $destination_for_delete_old_poster_is_destination = $connect->query("SELECT `poster_destination` FROM `recipes` WHERE `id` = '$id_r_for_update' ");
                        $destination_for_delete_old_poster_is_destination =  mysqli_fetch_assoc($destination_for_delete_old_poster_is_destination);

                        $destination_for_delete_old_poster_is_destination =  $destination_for_delete_old_poster_is_destination['poster_destination'];
                        if (unlink($destination_for_delete_old_poster_is_destination)) {
                           // готуємось до запису нових даних в БД та сервер
                           $file_name_new = uniqid('user_img_', true) . "." . $file_actual_ext;
                           $file_destination = '/OpenServer/domains/Food/img/img_upload_user/' . $file_name_new;
                           //Запис нового Постеру на сервер
                           if (move_uploaded_file($new_file_tmp_name, $file_destination)) {
                              $file_destination = 'img/img_upload_user/' . $file_name_new;
                              //Запис нових данних в БД
                              $connect->query("UPDATE  `recipes` SET `name_r` =  '$update_name_r',`category_r` =  '$update_category_r', `text_r` =  '$update_text_r', `poster_name` =  '$file_name_new ', `poster_destination` =  '$file_destination'  WHERE `id` =  '$id_r_for_update' ");
                              $connect->close();
                              $_SESSION['message'] = "Успішне редагування рецепту!!!";
                              header('Location: /cabinet.php');
                           } else {
                              $_SESSION['message'] = "Помилка при завантаженні нового файлу 'Постер' на сервер!!!";
                              header('Location: /cabinet.php');
                           }
                        } else {
                           $_SESSION['message'] = "Помилка при видаленні файлу 'Постер' з серверу!!!";
                           header('Location: /cabinet.php');
                        }
                     } else {
                        $_SESSION['message'] = "Ваш файл занадто великий, він повинен бути менше ніж 120 MB)!!!";
                        header('Location: /cabinet.php');
                     }
                  } else {
                     $_SESSION['message'] = "Помилка при завантаженні файлу!!!";
                     header('Location: /cabinet.php');
                  }
               } else {
                  $_SESSION['message'] = "Не валідний тип файлу: 'Постер'!!!";
                  header('Location: /cabinet.php');
               }
            } else {
               $id_r_for_update = $_SESSION['id_r'];
               unset($_SESSION['id_r']);
               $connect->query("UPDATE  `recipes` SET `name_r` =  '$update_name_r',`category_r` =  '$update_category_r', `text_r` =  '$update_text_r'  WHERE `id` =  '$id_r_for_update' ");
               $connect->close();
               $_SESSION['message'] = "Успішне редагування рецепту!!!";
               header('Location: /cabinet.php');
            }
         } else {
            $_SESSION['message'] = "Пусте поле самого рецепту!!!";
            header('Location: /cabinet.php');
         }
      } else {
         $_SESSION['message'] = "Пусте поле категоріїї рецепту!!!";
         header('Location: /cabinet.php');
      }
   } else {
      $_SESSION['message'] = "Пусте поле назви рецепту!!!";
      header('Location: /cabinet.php');
   }
} else if ($_SESSION['user_auth'] === "true") {
   $_SESSION['message'] = "Помилка аутинтефікації!!!";
   header('Location: /cabinet.php');
} else {
   $_SESSION['message'] = "Не авторизовані дії!!!";
   header('Location: /form_authorization.php');
}
