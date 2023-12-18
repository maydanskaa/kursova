<?php
    session_start(); // Початок сесії для зберігання та використання даних сесії
    require_once 'connect.php';

// Отримання логіну та паролю з форми авторизації.

    $login = $_POST['login'];
    $password = $_POST['password'];

// Хешування паролю за допомогою алгоритму SHA-1.

    $password = sha1($password);
// Перевірка існування користувача з введеними логіном та паролем у базі даних.
    $check_user = mysqli_query($connect,"SELECT * FROM `users` WHERE `login` = '$login' AND `password` = '$password'");
// Якщо користувач знайдений у базі даних:
    if (mysqli_num_rows($check_user) > 0 ) {

        $user = mysqli_fetch_assoc($check_user);

        // Збереження даних користувача у сесії для подальшого використання.

        $_SESSION['user'] = [
            "id" => $user['id'],
            "name" => $user['name'],
            "login" => $user['login'],
            "email" => $user['email'],
            "permission" => $user['permission']
        ];

        // Перенаправлення користувача на головну сторінку.

        header('Location: ../index.php');
    }else{

        // Якщо користувач не знайдений, встановлення повідомлення про помилку та перенаправлення на сторінку входу.

        $_SESSION['message'] = "Password or Login error";
        header('Location: ../login.php');
    }