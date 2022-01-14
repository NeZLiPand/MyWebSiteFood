<?php
session_start();

if ($_SESSION['user_auth'] !== "true")
   header('Location: /');

require_once 'library/connect_db.php';

$text_r = "";           // Саме рецепт
$category_r = "";       // Категорія рецепту
$name_r = "";           // Назва рецепту
$date_time_y_m_d_add_r = "";    // Дата та час спроби завантаження нового рецепту
$name_user_add_r = "";    // Логін юзера який додає рецепт
$allowed = "";          // Валідні типи файлів зображення для завантаження на сервер

$file_name = "";         // Початкова назва файлу: Постер
$file_type = "";         // Тип файлу: Постер
$file_tmp_name = "";     // Тимчасове місцезнаходження на сервері файлу: Постер
$file_error = "";        // Помилка при завантаженні фалйлу: Постер
$file_size = "";         // Розмір файлу: Постер
$file_ext = "";         // Видаляємо із строки ','
$file_actual_ext = "";    // Кінцева назва файлу: Постер
$file_ext = "";    // 
$file_actual_ext = "";    // 
$allowed = "";    // 
$file_name_new = "";    //

// Обробка данних для завантаження
   $name_r = $_POST['name_r'];
   $text_r = $_POST['text_r'];
   $category_r = $_POST['category_r'];
if ($name_r == "") {
   $_SESSION['message'] = "Поле назви обов'язкове до заповнення!!!";
   header('Location: /cabinet.php');
}
if ($text_r == "") {
   $_SESSION['message'] = "Поле рецепту обов'язкове до заповнення!!!";
   header('Location: /cabinet.php');
}
if ($category_r == "") {
   $_SESSION['message'] = "Поле категорії обов'язкове до заповнення!!!";
   header('Location: /cabinet.php');
}

$name_user_add_r = $_SESSION['login'];
$date_time_y_m_d_add_r = date('Y-m-d H:i:s');

// Обробка файлу:ПОСТЕР

$file_name = $_FILES['preview_r']['name'];
$file_type = $_FILES['preview_r']['type'];
$file_tmp_name = $_FILES['preview_r']['tmp_name'];
$file_error = $_FILES['preview_r']['error'];
$file_size = $_FILES['preview_r']['size'];

// Початок обробки файлу:ПОСТЕР
$file_ext = explode('.', $file_name);
$file_actual_ext = strtolower(end($file_ext));
$allowed = array('jpg', 'jpeg', 'png');

if (in_array($file_actual_ext, $allowed)) {
   if ($file_error === 0) {
      if ($filesize < 1200000) {
         $file_name_new = uniqid('user_img_', true) . "." . $file_actual_ext;
         $file_destination = '/OpenServer/domains/Food/img/img_upload_user/' . $file_name_new;
         if (move_uploaded_file($file_tmp_name, $file_destination)) {
            $file_destination = 'img/img_upload_user/' . $file_name_new;
            $shpt = $connect->query("INSERT INTO `recipes` (`id`, `name_r`, `category_r`, `text_r`, `poster_name`, `poster_destination`, `name_user_add_r`, `date_time_add_r`) VALUES (NULL, '$name_r', '$category_r', '$text_r', '$file_name_new', '$file_destination', '$name_user_add_r', '$date_time_y_m_d_add_r ') ");
            $connect->close();
            if ($shpt) {
               $_SESSION['add_new_r'] = "success";
               $_SESSION['message'] = "Додавання рецепту успішне, Вже можете оглянути його на головній сторінці (якщо вона вже відкрита, оновіть її) або через категорії вибрав категорію рецепту який був доданий (якщо вона вже відкрита, оновіть її)!!!";
               header('Location: /cabinet.php');
            } else {
               $_SESSION['message'] = "Додавання рецепту невдале, спробуйте ще раз, або вже пізніше!!!";
               header('Location: /cabinet.php');
            }
         } else {
            $_SESSION['message'] = "Помилка при завантаженні файлу 'Постер' на сервер!!!";
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
