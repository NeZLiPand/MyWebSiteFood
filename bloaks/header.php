<header class="p-1 bg-dark text-white">
      <div class="container">
            <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">
                  <ul class="nav col-12 col-lg-auto me-lg-auto justify-content-center mb-md-0">
                        <li><a href="/index.php" class="nav-link px-2 text-white">Головна</a></li>
                        <li class="nav-link px-2 text-white">|</li>
                        <li><a href="/about.php" class="nav-link px-2 text-white">Про цей проект</a></li>
                        <li class="nav-link px-2 text-white">|</li>
                        <li><a href="/communication.php" class="nav-link px-2 text-white">Зв'язок</a></li>
                  </ul>
                  <li class="nav-link px-2 text-white">
                        <?php echo $_SESSION['login'] ?>
                  </li>
                  <div class="text-end">
                        <?php if ($_SESSION['user_auth'] === "true") : ?>

                              <a class="btn btn-light btn-outline-success text-dark ms-3" href="/cabinet.php">Кабінет</a>
                              <a class="btn btn-light btn-outline-success text-dark ms-3" href="/chek_get_out.php">Вийти</a>
                        <?php else : ?>
                              <a class="btn btn-light btn-outline-success text-dark ms-3" href="/form_authorization.php">Увійти</a>
                              <a class="btn btn-light btn-outline-success text-dark ms-3" href="/form_registration.php">Реєстрація</a>
                        <?php endif; ?>
                  </div>
            </div>
</header>
<br>