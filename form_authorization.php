<?php
session_start();
if ($_SESSION['user_auth'] === "true")
      header('Location: /cabinet.php');
?>
<!DOCTYPE html>
<html lang="uk">

<head>
      <?php require_once "bloaks/head.php" ?>
      <title>Сторінка авторизації</title>
</head>

<body>
      <?php require_once "bloaks/header.php" ?>

      <section>
            <div class="container d-flex justify-content-center mt-5">
                  <h1>Форма Авторизації</h1>
            </div>
            <div class="container d-flex justify-content-center">
                  <form action="/chek_get_in.php" method="POST" class="needs-validation mt-5" novalidate>
                        <?php if ($_SESSION['message'] == 'Реєстрація Успішна!') : ?>
                              <p class="text-center text-success">
                                    <?php
                                    echo $_SESSION['message'];
                                    unset($_SESSION['message'])
                                    ?>
                              </p>
                        <?php elseif ($_SESSION['message']) : ?>
                              <p class="text-center text-danger">
                                    <?php
                                    echo $_SESSION['message'];
                                    unset($_SESSION['message'])
                                    ?>
                              </p>
                        <?php endif ?>
                        <div class="input-group">
                              <span class="input-group-text"">Введіть:</span>
                              <input type=" text" class="form-control" name="login" id="login_auth" placeholder="логін..">
                                    <input type=" text" class="form-control" name="password" id="password_auth" placeholder="пароль..">
                        </div>
                        <br>
                        <button class="btn btn-white btn-outline-success" type="submit" name="submit">Увійти</button>
                        Немає аккаунта ?
                        <a class="text-success" href="/form_registration.php">Зареєструйтесь</a>
                  </form>
            </div>
      </section>

      <?php require_once "bloaks/footer.php" ?>
</body>

</html>