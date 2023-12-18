<?php
session_start(); // Розпочинаємо сесію для зберігання та використання даних сесії
require_once 'includes/connect.php'; // Підключаємо скрипт для з'єднання з базою даних
$link = $connect; // Встановлюємо з'єднання з базою даних
// Формуємо SQL-запит для отримання даних про смартфони
$queryNazva = "SELECT v.name, s.model, s.id, s.img, s.soc, s.display, s.display_type, s.ram, s.rom, s.battery, s.diagonal, s.weight, s.gsm, s.os, s.cam_r1, s.cam_r2, s.cam_r3, s.cam_r4, s.cam_f1, s.cam_f2, s.price FROM smartphone s INNER JOIN vendor_list v ON s.vendor = v.id_vendor";
// Перевірка наявності запиту в сесії та його використання
if (isset($_SESSION['querry'])) {
    $queryNazva = $_SESSION['querry'];
    unset($_SESSION['querry']);
}
$resultNazva = mysqli_query($link, $queryNazva); // Виконання SQL-запиту
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width" initial-scale=1.0>
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Система з вибору мобільних пристроїв</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <!-- Шрифт Awesome -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css">
    <!-- Google шрифт -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap">
    <link rel="stylesheet" href="/css/main.css">
</head>
<body>
<header>
    <div class="d-flex flex-column flex-md-row align-items-center p-3 px-md-4 mb-3 bg-white border-bottom shadow-sm">
        <h5 class="my-0 mr-md-auto font-weight-normal"><a href="/"><img style="text-align: center;max-width: 40%;" src="./img/logo.jpeg" alt="Logo"></a></h5> <!-- Встановлення логотипу -->
        <div class="md-form active-purple-4 col-lg-4">
            <form style="display:flex;align-items: center; gap: 15px" action="/includes/search.php" method="GET"> <!-- Встановлення форми для пошуку -->
                <input style="display:inline-block;" class="form-control" type="text" placeholder="What phone are you looking for?" aria-label="Search" name="search">
                <button type="submit" class="btn btn-primary">Search</button> <!-- Визначення кнопки для відправки форми з пошуком -->
            </form>
        </div>
        <nav class="my-2 my-md-0 mr-md-3">
            <a class="p-2 text-dark" href="comparison.php">Comparison</a> <!-- Визначення посилання на сторінку порівняння  -->
            <a class="p-2 text-dark" href="bookmarks.php">Bookmarks</a> <!-- Визначення посилання на сторінку закладок  -->
        </nav>
        <!-- Умова для відображення посилання на профіль або кнопки для входу -->
        <?php
        if (isset($_SESSION['user'])) {
            echo ("<a class='btn btn-outline-primary col-lg-1' href='profile.php'>Account(" . $_SESSION['user']['name'] . ")</a>");
        } else {
            echo ("<a class='btn btn-outline-primary col-lg-1' href='login.php'>Sign in</a>");
        }
        ?>
    </div>
</header>
<!--<h1><?= $queryNazva ?></h1>-->
<!-- Основний контент сторінки -->
<div class="container">
    <div class="row">
        <!-- Сайдбар для фільтрів -->
        <div class="col-lg-3 borderk">
            <div class='card mb-4 shadow-sm'>
                <div class='card-header'>
                    <h4 class='my-0 font-weight-normal'>Filter</h4>
                </div>
                <div class='card-body'>
                    <div class='column'>
                        <!-- Форма для фільтрації продуктів -->
                        <form class="form-signin" action="/includes/querygen.php" method="post" id="filter">
                            <div class="col-md-12 mb-3">
                                <label for="vendorf">Vendor:</label>
                                <select class="custom-select d-block" name="vendorf" id="vendorf" form="filter">
                                    <option value="default"></option>
                                    <?php
                                    $querry = "SELECT * FROM vendor_list";
                                    $result = mysqli_query($connect, $querry);
                                    while ($row_vendor = mysqli_fetch_array($result)) {
                                        echo ("<option value=" . $row_vendor['id_vendor'] . ">" . $row_vendor['name'] . "</option>");
                                    }
                                    ?>
                                </select>
                            </div>
                            <!-- Випадаючий список для вибору фільтрації за ціною -->
                            <div class="col-md-12 mb-3">
                                <label for="pricef">Order by price:</label>
                                <select class="custom-select d-block" name="pricef" id="pricef" form="filter">
                                    <option value="default"></option>
                                    <option value="asc">Asc</option>
                                    <option value="desc">Desc</option>
                                </select>
                            </div>
                            <!-- Випадаючий список для вибору фільтрації за діагоналлю -->
                            <div class="col-md-12 mb-3">
                                <label for="diagf">Order by diagonal:</label>
                                <select class="custom-select d-block" name="diagf" id="diagf" form="filter">
                                    <option value="default"></option>
                                    <option value="asc">Asc</option>
                                    <option value="desc">Desc</option>
                                </select>
                            </div>
                            <!-- Додавання кнопки "Apply filter" -->
                            <button class="btn btn-primary btn-lg btn-block mb-3" type="submit">Apply filter</button>
                        </form>
                        <!-- Додавання кнопки "Clear filter" -->
                        <form action="/includes/kostul.php" method="post">
                            <input type="hidden" name="test" value="xyz">
                            <button class="btn btn-primary btn-lg btn-block redbtn" type="submit">Clear filter</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- Відображення списку смартфонів -->
        <div class="col-lg-9 borderk">
            <?php
            while ($rowNazva = mysqli_fetch_array($resultNazva)) {
                if ($rowNazva['cam_r2'] != null) {
                    $cam2 = ", " . $rowNazva['cam_r2'] . "mp";
                } else {
                    $cam2 = null;
                }
                if ($rowNazva['cam_r3'] != null) {
                    $cam3 = ", " . $rowNazva['cam_r3'] . "mp";
                } else {
                    $cam3 = null;
                }
                if ($rowNazva['cam_r4'] != null) {
                    $cam4 = ", " . $rowNazva['cam_r4'] . "mp";
                } else {
                    $cam4 = null;
                }
                if ($rowNazva['cam_f2'] != null) {
                    $camf2 = ", " . $rowNazva['cam_f2'] . "mp";
                } else {
                    $camf2 = null;
                }

                $user_id = isset($_SESSION['user']['id']) ? $_SESSION['user']['id'] : NULL;
                // Початок виведення карточки для мобільного пристрою
                echo ("<div class='card mb-4 shadow-sm'>
                <div class='card-header'>
                  <h4 class='my-0 font-weight-normal'>" . $rowNazva['name'] . " " . $rowNazva['model'] . "</h4>
                </div>
                <div class='card-body'>
                <div class='row'>
                <img src='" . $rowNazva['img'] . "' alt=" . $rowNazva['model'] . " class='img-fluid img200'>
                <div class='column  ml-4 mt-2 col-lg-8'>
                  <div class='row d-flex justify-content-between'>
                    <h3 class='card-title pricing-card-title'>" . $rowNazva['ram'] . "/" . $rowNazva['rom'] . " GB</h3>
                    <h3 class='card-title pricing-card-title'>" . $rowNazva['price'] . " UAH</h3>
                    </div>
                    <p>SoC: " . $rowNazva['soc'] . " • Display: " . $rowNazva['diagonal'] . " " . $rowNazva['display_type'] . " " . $rowNazva['display'] . " • Battery: " . $rowNazva['battery'] . " mAh • Weight: " . $rowNazva['weight'] . "g • Mobile networks: " . $rowNazva['gsm'] . " • OS: " . $rowNazva['os'] .
                    " • Rear camera: " . $rowNazva['cam_r1'] . "mp" . $cam2 . $cam3 . $cam4 .
                    " • Selfie camera: " . $rowNazva['cam_f1'] . "mp" . $camf2 .
                    "</p>
                  </div>
                  </div>
                  <div class='d-flex justify-content-around'>
                  <form action='comparison.php' method='POST' class='col-lg-5'>
                    <input type='hidden' value=" . $rowNazva['id'] . " name='id_mob'>
                    <button type='submit' class='btn btn-lg  btn-outline-primary col-lg-12'>Add comparison</button> <!-- Створення кнопки Add comparison яка додає пристрій до списку порівнянь -->
                  </form>
                  <form action='/includes/addbook.php' method='POST' class='col-lg-5'>

                    <input type='hidden' value=" . $user_id . " name='id_user'>
                    <input type='hidden' value=" . $rowNazva['id'] . " name='id_mob'>
                    <button type='submit' class='btn btn-lg btn btn-primary col-lg-12'>Add bookmarks</button> <!-- Створення кнопки Add bookmarks яка додає пристрій до закладок -->
                  </form>
                </div>
                 
                </div>
              </div>");
            }
            ?>
        </div>

    </div>
</div>
<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</body>
</html>
