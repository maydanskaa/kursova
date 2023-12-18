<?php
session_start(); // Розпочинаємо сесію для зберігання та використання даних сесії
if (!isset($_SESSION['user'])) { //Перевіряємо, чи у сесії користувач авторизований
    header('Location: ../login.php'); //Якщо ні, то переправляємо на сторінку login.php
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Профіль</title>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <!-- Шрифт Awesome -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css">
    <!-- Google шрифт -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap">
    <link rel="stylesheet" href="/css/login.css">
</head>
<!-- Визначення класу для тегу <body> в залежності від рівня дозволу користувача -->
<body class="<?php if ($_SESSION['user']['permission'] == "admin") {
                    echo ("bodya");
                } ?>">
    <div class="container">
        <div class="row">
            <div class="col-md-12 order-md-1">
                <h4 class="mb-3 text-center mt-5">Profile</h4>
                <!-- Форма для редагування імені, логіну, імейлу, дозволу профілю -->
                <form class="needs-validation" novalidate="">
                        <div class="mb-3">
                            <label for="Name">Name:</label>
                            <input type="text" class="form-control" id="Name" placeholder="<?= $_SESSION['user']['name'] ?>" value="" required="">
                        </div>
                        <div class="mb-3">
                            <label for="login">Login:</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">@</span>
                                </div>
                                <input type="text" class="form-control" id="login" placeholder="<?= $_SESSION['user']['login'] ?>" required="">
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="email">Email:</label>
                            <input type="email" class="form-control" id="email" placeholder="<?= $_SESSION['user']['email'] ?>">
                        </div>
                        <div class="mb-3">
                            <label for="permission">Permission:</label>
                            <input type="text" class="form-control" id="permission" placeholder="<?= $_SESSION['user']['permission'] ?>" required="">
                        </div>
                        <hr class="mb-4">
                    </form>
                <!-- Виведення кнопки "Log out" -->
                    <a class='btn btn-primary btn-lg btn-block' href='includes/logout.php'>Log out</a>
                <!-- PHP-блок, який перевіряє, чи користувач має рівень дозволу "admin". Якщо так, то виводяться дві кнопки: "Add smartphone" і "Edit smartphone" -->
                    <?php if ($_SESSION['user']['permission'] == "admin") {
                        echo ("<a class='btn btn-primary btn-lg btn-block greenbtn' href='addmobile.php'>Add smartphone</a>");
                        echo ("<a class='btn btn-primary btn-lg btn-block redbtn' href='includes/editmobile.php'>Edit smartphone</a>");
                    } ?>
            </div>
        </div>
    </div>
</body>
</html>
