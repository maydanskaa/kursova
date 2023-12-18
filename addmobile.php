<?php
session_start(); // Розпочинаємо сесію для зберігання та використання даних сесії
require_once 'includes/connect.php';

if (!isset($_SESSION['user'])) { //Перевіряємо, чи у сесії користувач авторизований
    header('Location: ../login.php'); //Якщо ні, то переправляємо на сторінку login.php
} elseif ($_SESSION['user']['permission']  != "admin") {
    // // Якщо користувач авторизований, але його рівень дозволу не є "admin", виводимо повідомлення і завершуємо виконання скрипту
    die("<p>You are not admin</p>");
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Додати смартфон</title>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

    <!-- Шрифт Awesome -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css">
    <!-- Google шрифт -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap">
    <link rel="stylesheet" href="/css/login.css">

</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col-md-12 order-md-1 mt-5">
                <!-- Заголовок додавання смартфону -->
                <h4 class="mb-3 text-center">Add smartphone</h4>
                <!-- Форма для додавання смартфону -->
                <form class="needs-validation" novalidate="" id="smartphone" action="includes/addmob.php" method="post" enctype="multipart/form-data">
                    <!-- Ряд для елементів форми -->
                    <div class="row">
                        <!-- Колонка для вибору виробника (vendor) смартфону -->
                        <div class="col-md-3 mb-3">
                            <!-- Випадаючий список для вибору виробника -->
                            <label for="vendor">Vendor:</label>
                            <select class="custom-select d-block" name="vendor" id="vendor" form="smartphone">
                                <?php
                                // Запит до бази даних для отримання списку виробників
                                $querry = "SELECT * FROM vendor_list";
                                $result = mysqli_query($connect, $querry);
                                // Виведення опцій випадаючого списку на основі результатів запиту
                                while ($row_vendor = mysqli_fetch_array($result)) {
                                    echo ("<option value=" . $row_vendor['id_vendor'] . ">" . $row_vendor['name'] . "</option>");
                                }
                                ?>
                            </select>
                        </div>
                        <!-- Колонка  для введення моделі смартфону -->
                        <div class="col-md-3 mb-3">
                            <!-- Мітка для поля вводу моделі смартфону -->
                            <label for="model">Model:</label>
                            <!-- Поле вводу для введення моделі смартфону -->
                            <input type="text" class="form-control" id="model" value="" required name="model" placeholder="Galaxy S7 Edge">
                            <!-- Повідомлення про помилку, яке виводиться, якщо введена модель недійсна -->
                            <div class="invalid-feedback">
                                Valid model is required.
                            </div>
                        </div>
                        <!-- Колонка для введення процесору смартфону -->
                        <div class="col-md-3 mb-3">
                            <!-- Мітка для поля вводу процесору смартфону -->
                            <label for="soc">SoC:</label>
                            <!-- Поле вводу для введення процесору смартфону -->
                            <input type="text" class="form-control" id="soc" value="" required="" name="soc" placeholder="Samsung Exynos 8890">
                            <!-- Повідомлення про помилку, яке виводиться, якщо введений процесор недійсний -->
                            <div class="invalid-feedback">
                                Valid SoC is required.
                            </div>
                        </div>
                        <!-- Колонка  для введення ємності батареї смартфону -->
                        <div class="col-md-3 mb-3">
                            <!-- Мітка для поля вводу ємності батареї смартфону -->
                            <label for="battery">Battery:</label>
                            <!-- Поле вводу для введення ємності батареї смартфону -->
                            <input type="text" class="form-control" id="battery" value="" required="" name="battery" placeholder="3600">
                            <!-- Повідомлення про помилку, яке виводиться, якщо введена ємність недійсна -->
                            <div class="invalid-feedback">
                                Valid battery is required.
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <!-- Колонка  для введення роздільної здатності дисплея смартфону -->
                        <div class="col-md-3 mb-3">
                            <!-- Мітка для поля вводу роздільної здатності дисплея смартфону -->
                            <label for="display">Display resolution:</label>
                            <!-- Поле вводу для введення роздільної здатності дисплея смартфону -->
                            <input type="text" class="form-control" id="display" value="" required="" name="display" placeholder="1440x2560">
                            <!-- Повідомлення про помилку, яке виводиться, якщо введена роздільна здатність дисплея недійсна -->
                            <div class="invalid-feedback">
                                Valid resolution is required.
                            </div>
                        </div>
                        <!-- Колонка  для введення типу дисплея смартфону -->
                        <div class="col-md-3 mb-3">
                            <!-- Мітка для поля вводу типу дисплея смартфону -->
                            <label for="display_type">Display type:</label>
                            <!-- Поле вводу для введення типу дисплея смартфону -->
                            <input type="text" class="form-control" id="display_type" value="" required="" name="display_type" placeholder="AMOLED">
                            <!-- Повідомлення про помилку, яке виводиться, якщо введений тип дисплея недійсний -->
                            <div class="invalid-feedback">
                                Valid type is required.
                            </div>
                        </div>
                        <!-- Колонка  для введення ОП смартфону -->
                        <div class="col-md-1 mb-3">
                            <!-- Мітка для поля вводу ОП смартфону -->
                            <label for="ram">RAM:</label>
                            <!-- Поле вводу для введення ОП смартфону -->
                            <input type="text" class="form-control" id="ram" value="" required="" name="ram" placeholder="4">
                            <!-- Повідомлення про помилку, яке виводиться, якщо введена ОП недійсна -->
                            <div class="invalid-feedback">
                                Valid count ram is required.
                            </div>
                        </div>
                        <!-- Колонка  для введення об'єму пам'яті смартфону -->
                        <div class="col-md-1 mb-3">
                            <!-- Мітка для поля вводу об'єму пам'яті смартфону -->
                            <label for="rom">ROM:</label>
                            <!-- Поле вводу для введення об'єму пам'яті смартфону -->
                            <input type="text" class="form-control" id="rom" value="" required="" name="rom" placeholder="32">
                            <!-- Повідомлення про помилку, яке виводиться, якщо введений об'єм пам'яті недійсний -->
                            <div class="invalid-feedback">
                                Valid count rom is required.
                            </div>
                        </div>
                        <!-- Колонка  для введення ваги смартфону -->
                        <div class="col-md-1 mb-3">
                            <!-- Мітка для поля вводу ваги смартфону -->
                            <label for="weight">Weight:</label>
                            <!-- Поле вводу для введення ваги смартфону -->
                            <input type="text" class="form-control" id="weight" value="" required="" name="weight" placeholder="157">
                            <!-- Повідомлення про помилку, яке виводиться, якщо введена вага недійсна -->
                            <div class="invalid-feedback">
                                Valid count weight is required.
                            </div>
                        </div>
                        <!-- Колонка  для введення діагоналі смартфону -->
                        <div class="col-md-1 mb-3">
                            <!-- Мітка для поля вводу діагоналі смартфону -->
                            <label for="diagonal">Diagonal:</label>
                            <!-- Поле вводу для введення діаоналі смартфону -->
                            <input type="text" class="form-control" id="diagonal" value="" required="" name="diagonal" placeholder="5.5">
                            <!-- Повідомлення про помилку, яке виводиться, якщо введена діагональ недійсна -->
                            <div class="invalid-feedback">
                                Valid diagonal is required.
                            </div>
                        </div>
                        <!-- Колонка  для введення ОС смартфону -->
                        <div class="col-md-2 mb-3">
                            <!-- Мітка для поля вводу ОС смартфону -->
                            <label for="os">OS:</label>
                            <!-- Поле вводу для введення ОС смартфону -->
                            <input type="text" class="form-control" id="os" value="" required="" name="os" placeholder="Android 8">
                            <!-- Повідомлення про помилку, яке виводиться, якщо введена ОС недійсна -->
                            <div class="invalid-feedback">
                                Valid os is required.
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <!-- Колонка  для введення роздільної здатності першої камери смартфону -->
                        <div class="col-md-2 mb-3">
                            <!-- Мітка для поля вводу роздільної здатності першої камери смартфону -->
                            <label for="cam_r1">Main camera:</label>
                            <!-- Поле вводу для введення роздільної здатності першої камери смартфону -->
                            <input type="text" class="form-control" id="cam_r1" value="" required="" name="cam_r1" placeholder="12">
                            <!-- Повідомлення про помилку, яке виводиться, якщо введена роздільна здатність першої камери недійсна -->
                            <div class="invalid-feedback">
                                Valid main camera mp is required.
                            </div>
                        </div>
                        <!-- Колонка  для введення роздільної здатності другої камери смартфону -->
                        <div class="col-md-2 mb-3">
                            <!-- Мітка для поля вводу роздільної здатності другої камери смартфону -->
                            <label for="cam_r2">Second camera:</label>
                            <!-- Поле вводу для введення роздільної здатності другої камери смартфону -->
                            <input type="text" class="form-control" id="cam_r2" value="" required="" name="cam_r2" placeholder="8">
                            <!-- Повідомлення про помилку, яке виводиться, якщо введена роздільна здатність другої камери недійсна -->
                            <div class="invalid-feedback">
                                Valid second camera mp is required.
                            </div>
                        </div>
                        <!-- Колонка  для введення роздільної здатності третьої камери смартфону -->
                        <div class="col-md-2 mb-3">
                            <!-- Мітка для поля вводу роздільної здатності третьої камери смартфону -->
                            <label for="cam_r3">Third camera:</label>
                            <!-- Поле вводу для введення роздільної здатності третьої камери смартфону -->
                            <input type="text" class="form-control" id="cam_r3" value="" required="" name="cam_r3" placeholder="2">
                            <!-- Повідомлення про помилку, яке виводиться, якщо введена роздільна здатність третьої камери недійсна -->
                            <div class="invalid-feedback">
                                Valid third camera mp is required.
                            </div>
                        </div>
                        <!-- Колонка  для введення роздільної здатності 4 камери смартфону -->
                        <div class="col-md-2 mb-3">
                            <!-- Мітка для поля вводу роздільної здатності 4 камери смартфону -->
                            <label for="cam_r4">Fourth camera:</label>
                            <!-- Поле вводу для введення роздільної здатності 4 камери смартфону -->
                            <input type="text" class="form-control" id="cam_r4" value="" required="" name="cam_r4" placeholder="2">
                            <!-- Повідомлення про помилку, яке виводиться, якщо введена роздільна здатність 4 камери недійсна -->
                            <div class="invalid-feedback">
                                Valid fourth camera mp is required.
                            </div>
                        </div>
                        <!-- Колонка  для введення роздільної здатності селфі камери смартфону -->
                        <div class="col-md-2 mb-3">
                            <!-- Мітка для поля вводу роздільної здатності селфі камери смартфону -->
                            <label for="cam_f1">Selfie camera:</label>
                            <!-- Поле вводу для введення роздільної здатності селфі камери смартфону -->
                            <input type="text" class="form-control" id="cam_f1" value="" required="" name="cam_f1" placeholder="5">
                            <!-- Повідомлення про помилку, яке виводиться, якщо введена роздільна здатність селфі камери недійсна -->
                            <div class="invalid-feedback">
                                Valid selfie camera mp is required.
                            </div>
                        </div>
                        <!-- Колонка  для введення роздільної здатності селфі 2 камери смартфону -->
                        <div class="col-md-2 mb-3">
                            <!-- Мітка для поля вводу роздільної здатності селфі 2 камери смартфону -->
                            <label for="cam_f2">Selfie camera:</label>
                            <!-- Поле вводу для введення роздільної здатності селфі 2 камери смартфону -->
                            <input type="text" class="form-control" id="cam_f2" value="" required="" name="cam_f2" placeholder="2">
                            <!-- Повідомлення про помилку, яке виводиться, якщо введена роздільна здатність селфі 2 камери недійсна -->
                            <div class="invalid-feedback">
                                Valid selfie camera mp is required.
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <!-- Ідентично з ціною -->
                        <div class="col-md-2 mb-3">
                            <label for="price">Price:</label>
                            <input type="text" class="form-control" id="price" value="" required="" name="price" placeholder="4000">
                            <div class="invalid-feedback">
                                Valid price is required.
                            </div>
                        </div>
                        <!-- Ідентично з типами мереж -->
                        <div class="col-md-4 mb-3">
                            <label for="gsm">Network types:</label>
                            <input type="text" class="form-control" id="gsm" value="" required="" name="gsm" placeholder="LTE, 3G, 2G">
                            <div class="invalid-feedback">
                                Valid gsm is required.
                            </div>
                        </div>
                        <!-- Ідентично з фото -->
                        <div class="col-md-6 mb-3">
                            <label for="foto">Foto:</label>
                            <input type="file" class="form-control-file" id="foto" value="" required="" name="foto" placeholder="foto">
                            <div class="invalid-feedback">
                                Valid foto is required.
                            </div>
                        </div>
                            
                    </div>
                    <!-- Виведення повідомлення про успішність дії або помилку -->
                    <p><?php echo(isset($_SESSION['message'])); unset($_SESSION['message']); ?></p>
                    <!-- Горизонтальна лінія для відділення блоків у формі -->
                    <hr class="mb-4">
                    <!-- Кнопка для відправлення форми або виконання іншої дії (додавання смартфону) -->
                    <button class="btn btn-primary btn-lg btn-block greenbtn" type="submit">Add</button>
                    <!-- Посилання на домашню сторінку -->
                    <a class="btn btn-primary btn-lg btn-block" href="index.php">Home</a>
                </form>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</body>

</html>