<?php
session_start();
require_once 'library/connect_db.php';
?>
<!DOCTYPE html>
<html lang="uk">

<head>
    <?php require_once "bloaks/head.php" ?>

    <title>Головна</title>
</head>
 
<body>
    <?php require_once "bloaks/header.php" ?>
    <div class="container d-flex justify-content-center mt-5">
        <?php if ($_SESSION['message']) : ?>
            <p class="message">
                <?php
                echo $_SESSION['message'];
                unset($_SESSION['message'])
                ?>
            </p>
        <?php endif ?>
    </div>

    <section>

        <div class="container mt-3 mb-5 ms-5 me-5">
            <h2 class="text-center">Рецепти</h2>
        </div>

        <div class="container mt-5 mb-5 ms-5 me-5 bg-light">
            <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">
                <?php

                $amount_r = $connect->query("SELECT count(*) FROM `recipes`");
                $amount_r2 = mysqli_fetch_assoc($amount_r);
                $amount_r = $amount_r2['count(*)'];
                $amount_r = 1 * $amount_r;
                $everything_about_recipe = $connect->query("SELECT * FROM `recipes`");
                while ($all_r = mysqli_fetch_assoc($everything_about_recipe)) {
                    $array_name_r[] = $all_r['name_r'];
                    $array_category_r[] = $all_r['category_r'];
                    $array_text_r[] = $all_r['text_r'];
                    $array_poster_destination[] = $all_r['poster_destination'];
                    $array_name_user_add_r[] = $all_r['name_user_add_r'];
                    $array_poster_name[] = $all_r['poster_name'];
                    $array_date_time_add_r[] = $all_r['date_time_add_r'];
                }
                $connect->close();
                for ($i = 0; $i < $amount_r; $i++) : ?>
                    <div class="col">
                        <div class="card shadow-lg">
                            <img src="<?php echo $array_poster_destination[$i] ?>" class="rounded-circle img-thumbnail border-0" alt="">
                            <div class="card-body">
                                <p class="h4 card-text text-center">
                                    <strong>
                                        <em>
                                            <?php echo $array_name_r[$i]; ?>
                                        </em>
                                    </strong>
                                </p>
                                <p class="text-center">
                                    <?php echo  $array_category_r[$i] ?>
                                </p class="card-text text-center">
                                <label for="text">Рецепт:</label>
                                <p name="text">
                                    <?php echo $array_text_r[$i] ?>
                                </p>
                                <div class="d-flex justify-content-between align-items-center">

                                    <small class="text-muted">
                                        <?php echo $array_date_time_add_r[$i] ?>
                                    </small>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endfor ?>

            </div>
        </div>
    </section>

    <?php require_once "bloaks/footer.php" ?>
</body>

</html>