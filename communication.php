<?php
session_start();
?>
<!DOCTYPE html>
<html lang="uk">

<head>
      <?php require_once "bloaks/head.php" ?>

      <title>Зв'язок</title>
</head>

<body>
      <?php require_once "bloaks/header.php" ?>

      <section>
            <div class="container mt-5">
                  <h3>Контактна форма</h3><br>
                  <form action="/chek_communication.php" method="POST">
                        <input type="email" name="email" placeholder="Введіть ваш Email" class="form-control"><br>
                        <textarea name="message" class="form-control" placeholder="Введіть ваше повідомлення"></textarea><br>
                        <button type="submit" name="send" class="btn btn-success">Відправити</button>
                  </form>
            </div>
      </section>

      <?php require_once "bloaks/footer.php" ?>
</body>

</html>