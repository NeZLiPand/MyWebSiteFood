<?php
session_start();
if ($_SESSION['user_auth'] !== "true")
    header('Location: /');
require_once 'library/connect_db.php';
?>
<!DOCTYPE html>
<html lang="uk">

<head>
    <?php require_once "bloaks/head.php" ?>
    <title>Мій кабінет</title>
</head>

<body class="bg-light">
    <?php require_once "bloaks/header.php" ?>

    <h4 class="text-center text-success">
        <?php if ($_POST['privilege'] == 1) :
            echo $_SESSION['message'];
            unset($_SESSION['message']);
        elseif ($_SESSION['message']) :
            echo ($_SESSION['message']);
            unset($_SESSION['message']);
        endif ?>
    </h4>
    <section>

        <!-- Контейнер Форм -->
        <div class="row container-fluid row-cols-1 row-cols-2 g-2">

            <!-- Додавання рецепту -->
            <div class="col container bg-light border-top border-bottom mt-3 mb-3 ">

                <div class="container d-flex justify-content-center mt-3 mb-3">
                    <h2>Додавання рецепту</h2>
                </div>

                <div class="row">
                    <form action="/add_new_r.php" method="post" enctype="multipart/form-data">
                        <div class="mb-3">
                            <div class=" input-group">
                                <span class="input-group-text"">
                  <svg xmlns=" http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pen" viewBox="0 0 16 16">
                                    <path d="m13.498.795.149-.149a1.207 1.207 0 1 1 1.707 1.708l-.149.148a1.5 1.5 0 0 1-.059 2.059L4.854 14.854a.5.5 0 0 1-.233.131l-4 1a.5.5 0 0 1-.606-.606l1-4a.5.5 0 0 1 .131-.232l9.642-9.642a.5.5 0 0 0-.642.056L6.854 4.854a.5.5 0 1 1-.708-.708L9.44.854A1.5 1.5 0 0 1 11.5.796a1.5 1.5 0 0 1 1.998-.001zm-.644.766a.5.5 0 0 0-.707 0L1.95 11.756l-.764 3.057 3.057-.764L14.44 3.854a.5.5 0 0 0 0-.708l-1.585-1.585z" />
                                    </svg>
                                </span>
                                <textarea name="name_r" class="form-control" aria-label="With textarea" placeholder="Назва рецепту.." style="height: 150px"></textarea>
                            </div>
                        </div>

                        <div class="mb-3">
                            <div class=" input-group">
                                <span class="input-group-text"">
                  <svg xmlns=" http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-bookmark-dash" viewBox="0 0 16 16">
                                    <path fill-rule="evenodd" d="M5.5 6.5A.5.5 0 0 1 6 6h4a.5.5 0 0 1 0 1H6a.5.5 0 0 1-.5-.5z" />
                                    <path d="M2 2a2 2 0 0 1 2-2h8a2 2 0 0 1 2 2v13.5a.5.5 0 0 1-.777.416L8 13.101l-5.223 2.815A.5.5 0 0 1 2 15.5V2zm2-1a1 1 0 0 0-1 1v12.566l4.723-2.482a.5.5 0 0 1 .554 0L13 14.566V2a1 1 0 0 0-1-1H4z" />
                                    </svg>
                                </span>
                                <label class="input-group-text" for="category_r">Категорія вашого рецепту:
                                </label>
                                <select class="form-select" name="category_r">
                                    <option value=""></option>
                                    <option value="Перше блюдо">Перше блюдо</option>
                                    <option value="Друге блюдо">Друге блюдо</option>
                                    <option value="Десерт">Десерт</option>
                                    <option value="Салат">Салат</option>
                                    <option value="Напій">Напій</option>
                                    <option value="Випічка">Випічка</option>
                                    <option value="Тісто">Тісто</option>
                                    <option value="Піца">Піца</option>
                                    <option value="Консервація">Консервація</option>
                                </select>
                            </div>
                        </div>

                        <div class="mb-3">
                            <div class=" input-group">
                                <span class="input-group-text"">
                  <svg xmlns=" http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pen" viewBox="0 0 16 16">
                                    <path d="m13.498.795.149-.149a1.207 1.207 0 1 1 1.707 1.708l-.149.148a1.5 1.5 0 0 1-.059 2.059L4.854 14.854a.5.5 0 0 1-.233.131l-4 1a.5.5 0 0 1-.606-.606l1-4a.5.5 0 0 1 .131-.232l9.642-9.642a.5.5 0 0 0-.642.056L6.854 4.854a.5.5 0 1 1-.708-.708L9.44.854A1.5 1.5 0 0 1 11.5.796a1.5 1.5 0 0 1 1.998-.001zm-.644.766a.5.5 0 0 0-.707 0L1.95 11.756l-.764 3.057 3.057-.764L14.44 3.854a.5.5 0 0 0 0-.708l-1.585-1.585z" />
                                    </svg>
                                </span>
                                <textarea class="form-control" aria-label="With textarea" name="text_r" placeholder="Сюди опис вашого рецепту.." style="height: 250px"></textarea>
                            </div>
                        </div>

                        <div>
                            <div class=" input-group">
                                <label class="input-group-text" for="preview_r">Постер</label>
                                <span class="input-group-text"">
                  <svg xmlns=" http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-file-earmark-image" viewBox="0 0 16 16">
                                    <path d="M6.502 7a1.5 1.5 0 1 0 0-3 1.5 1.5 0 0 0 0 3z" />
                                    <path d="M14 14a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V2a2 2 0 0 1 2-2h5.5L14 4.5V14zM4 1a1 1 0 0 0-1 1v10l2.224-2.224a.5.5 0 0 1 .61-.075L8 11l2.157-3.02a.5.5 0 0 1 .76-.063L13 10V4.5h-2A1.5 1.5 0 0 1 9.5 3V1H4z" />
                                    </svg>
                                </span>
                                <input class="form-control" type="file" name="preview_r">
                            </div>
                            <div class="container d-flex justify-content-center mt-3">
                                <button class="btn btn-white btn-outline-success" type="submit" name="submit">Додати рецепт</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <!-- Редагування рецепту -->
            <?php if ($_SESSION['privilege'] == 1) : ?>
                <div class="col container bg-light border-top border-bottom mt-3 mb-3">
                    <div class="container d-flex justify-content-center mt-3 mb-3">
                        <h2>Редагування рецепту</h2>
                    </div>
                    <div class="row mb-3">

                        <!-- Відправка назви рецепту для отримання данних на редагування -->
                        <form action="/getting_prescription.php" method="post" enctype="multipart/form-data">
                            <div class="mb-3">
                                <div class=" input-group">
                                    <span class="input-group-text"">
                    <svg xmlns=" http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-bookmark-dash" viewBox="0 0 16 16">
                                        <path fill-rule="evenodd" d="M5.5 6.5A.5.5 0 0 1 6 6h4a.5.5 0 0 1 0 1H6a.5.5 0 0 1-.5-.5z" />
                                        <path d="M2 2a2 2 0 0 1 2-2h8a2 2 0 0 1 2 2v13.5a.5.5 0 0 1-.777.416L8 13.101l-5.223 2.815A.5.5 0 0 1 2 15.5V2zm2-1a1 1 0 0 0-1 1v12.566l4.723-2.482a.5.5 0 0 1 .554 0L13 14.566V2a1 1 0 0 0-1-1H4z" />
                                        </svg>
                                    </span>
                                    <label class="input-group-text" for="db_name_r">Виберіть рецепт:
                                    </label>
                                    <select class="form-select" name="db_name_r">
                                        <option value=""></option>
                                        <?php
                                        $amount_r = $connect->query("SELECT count(*) FROM `recipes`");
                                        $amount_r2 = mysqli_fetch_assoc($amount_r);
                                        $amount_r = $amount_r2['count(*)'];
                                        $amount_r = 1 * $amount_r;
                                        $amount_name_r = $connect->query("SELECT `name_r` FROM `recipes`");
                                        while ($name_r = $amount_name_r->fetch_assoc()) {
                                            $array_name_r[] = $name_r['name_r'];
                                        }
                                        for ($i = 1; $i <= $amount_r; $i++) :
                                        ?>
                                            <option value="<?php echo $array_name_r[$i - 1] ?>">
                                                <?php echo $array_name_r[$i - 1] ?>
                                            </option>
                                        <?php endfor ?>
                                    </select>
                                </div>
                            </div>

                            <div class="container d-flex justify-content-center mb-3">
                                <button class="btn btn-white btn-outline-success" type="submit">Отримати рецепт для редагування</button>
                            </div>

                        </form>

                        <!-- Саме редагування рецепту -->
                        <div>
                            <form action="/update_r.php" method="post" enctype="multipart/form-data">
                                <div class="mb-3">
                                    <div class=" input-group">
                                        <span class="input-group-text"">
                  <svg xmlns=" http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pen" viewBox="0 0 16 16">
                                            <path d="m13.498.795.149-.149a1.207 1.207 0 1 1 1.707 1.708l-.149.148a1.5 1.5 0 0 1-.059 2.059L4.854 14.854a.5.5 0 0 1-.233.131l-4 1a.5.5 0 0 1-.606-.606l1-4a.5.5 0 0 1 .131-.232l9.642-9.642a.5.5 0 0 0-.642.056L6.854 4.854a.5.5 0 1 1-.708-.708L9.44.854A1.5 1.5 0 0 1 11.5.796a1.5 1.5 0 0 1 1.998-.001zm-.644.766a.5.5 0 0 0-.707 0L1.95 11.756l-.764 3.057 3.057-.764L14.44 3.854a.5.5 0 0 0 0-.708l-1.585-1.585z" />
                                            </svg>
                                        </span>
                                        <textarea class="form-control" aria-label="With textarea" name="update_name_r"" placeholder=" Зміна назви.." style="height: 150px"><?php if ($_SESSION['name_r']) : echo $_SESSION['name_r'] ?><?php endif;
                                                                                                                                                                                                                                    unset($_SESSION['name_r']); ?></textarea>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <div class=" input-group">
                                        <span class="input-group-text"">
                  <svg xmlns=" http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-bookmark-dash" viewBox="0 0 16 16">
                                            <path fill-rule="evenodd" d="M5.5 6.5A.5.5 0 0 1 6 6h4a.5.5 0 0 1 0 1H6a.5.5 0 0 1-.5-.5z" />
                                            <path d="M2 2a2 2 0 0 1 2-2h8a2 2 0 0 1 2 2v13.5a.5.5 0 0 1-.777.416L8 13.101l-5.223 2.815A.5.5 0 0 1 2 15.5V2zm2-1a1 1 0 0 0-1 1v12.566l4.723-2.482a.5.5 0 0 1 .554 0L13 14.566V2a1 1 0 0 0-1-1H4z" />
                                            </svg>
                                        </span>
                                        <label class="input-group-text" for="update_category_r">Зміна категорії:
                                        </label>
                                        <select class="form-select" name="update_category_r">
                                            <?php if ($_SESSION['category_r']) : ?>
                                                <option value="<?php echo $_SESSION['category_r'] ?>"> <?php echo $_SESSION['category_r'] ?></option>
                                            <?php unset($_SESSION['category_r']);
                                            else : ?>
                                                <option value=""></option>
                                            <?php endif; ?>
                                            <option value="Перше блюдо">Перше блюдо</option>
                                            <option value="Друге блюдо">Друге блюдо</option>
                                            <option value="Десерт">Десерт</option>
                                            <option value="Салат">Салат</option>
                                            <option value="Напій">Напій</option>
                                            <option value="Випічка">Випічка</option>
                                            <option value="Тісто">Тісто</option>
                                            <option value="Піца">Піца</option>
                                            <option value="Консервація">Консервація</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <div class=" input-group">
                                        <span class="input-group-text"">
                  <svg xmlns=" http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pen" viewBox="0 0 16 16">
                                            <path d="m13.498.795.149-.149a1.207 1.207 0 1 1 1.707 1.708l-.149.148a1.5 1.5 0 0 1-.059 2.059L4.854 14.854a.5.5 0 0 1-.233.131l-4 1a.5.5 0 0 1-.606-.606l1-4a.5.5 0 0 1 .131-.232l9.642-9.642a.5.5 0 0 0-.642.056L6.854 4.854a.5.5 0 1 1-.708-.708L9.44.854A1.5 1.5 0 0 1 11.5.796a1.5 1.5 0 0 1 1.998-.001zm-.644.766a.5.5 0 0 0-.707 0L1.95 11.756l-.764 3.057 3.057-.764L14.44 3.854a.5.5 0 0 0 0-.708l-1.585-1.585z" />
                                            </svg>
                                        </span>

                                        <textarea class="form-control" aria-label="With textarea" name="update_text_r" style="height: 250px" placeholder="Зміна рецепту"><?php if ($_SESSION['text_r']) : echo $_SESSION['text_r'] ?><?php endif;
                                                                                                                                                                                                                                    unset($_SESSION['text_r']);
                                                                                                                                                                                                                                    $_FILES['update_preview_r'] = ""; ?></textarea>
                                    </div>
                                </div>

                                <div>
                                    <div class=" input-group">
                                        <label class="input-group-text" for="update_preview_r">Постер</label>
                                        <span class="input-group-text"">
                  <svg xmlns=" http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-file-earmark-image" viewBox="0 0 16 16">
                                            <path d="M6.502 7a1.5 1.5 0 1 0 0-3 1.5 1.5 0 0 0 0 3z" />
                                            <path d="M14 14a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V2a2 2 0 0 1 2-2h5.5L14 4.5V14zM4 1a1 1 0 0 0-1 1v10l2.224-2.224a.5.5 0 0 1 .61-.075L8 11l2.157-3.02a.5.5 0 0 1 .76-.063L13 10V4.5h-2A1.5 1.5 0 0 1 9.5 3V1H4z" />
                                            </svg>
                                        </span>
                                        <input class=" form-control" type="file" name="update_preview_r">
                                    </div>
                                </div>

                                <div class="container d-flex justify-content-center mt-3 mb-3">
                                    <button class="btn btn-white btn-outline-success" type="submit">Змінити рецепт</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            <?php endif ?>
        </div>
            <!-- Видалення рецепту -->
        <?php if ($_SESSION['privilege'] == 1) : ?>
            <div class="container-fluid bg-light border-top border-bottom mt-3 mb-3 ">
                <div class="container d-flex justify-content-center mt-3 mb-3">
                    <h2>Видалення рецептів</h2>
                </div>

                <div class="container-fluid mt-3 mb-3">
                    <table class="table table-hover caption-top">
                        <caption>Дані всіх рецептів</caption>
                        <tr>
                            <th class="table-dark">id</th>
                            <th class="table-dark">name</th>
                            <th class="table-dark">category</th>
                            <th class="table-dark">text</th>
                            <th class="table-dark">name_user_add</th>
                            <th class="table-dark">date_time_add</th>
                            <th class="table-dark"></th>
                        </tr>
                        <?php
                        $everything_about_recipe = $connect->query("SELECT * FROM `recipes`");
                        while ($all_r = mysqli_fetch_assoc($everything_about_recipe)) {
                            $array_id_r[] = $all_r['id'];
                            $array_name_r[] = $all_r['name_r'];
                            $array_category_r[] = $all_r['category_r'];
                            $array_text_r[] = $all_r['text_r'];
                            $array_name_user_add_r[] = $all_r['name_user_add_r'];
                            $array_date_time_add_r[] = $all_r['date_time_add_r'];
                        }
                        $amount_r = $connect->query("SELECT count(*) FROM `recipes`");
                        $amount_r2 = mysqli_fetch_assoc($amount_r);
                        $amount_r = $amount_r2['count(*)'];
                        $amount_r = 1 * $amount_r;
                        $connect->close();
                        for ($i = 0; $i < $amount_r; $i++) : ?>
                            <tr>
                                <td><?php echo $array_id_r[$i] ?></td>
                                <td class="table-active"><?php echo $array_name_r[$i] ?></td>
                                <td><?php echo $array_category_r[$i] ?></td>
                                <td><?php echo $array_text_r[$i] ?></td>
                                <td><?php echo $array_name_user_add_r[$i] ?></td>
                                <td><?php echo $array_date_time_add_r[$i] ?></td>
                                <td><a href="/delete.php?id=<?php echo $array_id_r[$i] ?>">Видалити</a></td>
                            </tr>
                        <?php endfor ?>
                    </table>
                </div>
            </div>
        <?php endif ?>
    </section>
    <?php require_once "bloaks/footer.php" ?>
</body>

</html>