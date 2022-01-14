<?php
session_start();
if ($_SESSION['user_auth'] === "true")
      header('Location: /cabinet.php');
?>
?>
<!DOCTYPE html>
<html lang="uk">

<head>
      <?php require_once "bloaks/head.php" ?>
      <title>Сторінка реєстрації</title>
</head>

<body>
      <?php require_once "bloaks/header.php" ?>

      <section>
            <div class="container d-flex justify-content-center mt-5">
                  <h1>Форма реєстрації</h1>
            </div>

            <div class="container d-flex justify-content-center">
                  <form action="/chek_sign_up.php" method="post" class="mt-5">
                        
                        <?php if ($_SESSION['message']) : ?>
                              <p class="text-center text-danger">
                                    <?php
                                    echo $_SESSION['message'];
                                    unset($_SESSION['message'])
                                    ?>
                              </p>
                        <?php endif ?>

                        <div class="input-group">
                              <span class="input-group-text"">Придумайте:</span>
                              <input class=" form-control" type="text" name="login" placeholder="логін..">
                        </div>
                        <br>
                        <div class="input-group">
                              <span class="input-group-text"">Придумайте:</span>
                              <input class=" form-control" type="text" name="password" placeholder="пароль..">
                                    <span class="input-group-text"">Повторіть:</span>
                                    <input class=" form-control" type="text" name="password_two" placeholder="пароль..">
                        </div>
                        <br>
                        <button class="btn btn-white btn-outline-success" type="submit" name="submit">Зареєструватися</button>
                        Є аккаунт ?
                        <a class="text-success" href="/form_authorization.php">Увійдіть</a>
                  </form>
            </div>
      </section>

      <?php require_once "bloaks/footer.php" ?>
</body>

</html>