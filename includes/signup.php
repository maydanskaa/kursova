<?php
    session_start(); // Початок сесії для зберігання та використання даних сесії
    require_once 'connect.php';

// Отримання даних з форми реєстрації.

    $full_name = $_POST['full_name'];
    $login = $_POST['login'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $password_confirm = $_POST['password_confirm'];

// Перевірка співпадіння введених паролів.
    if ($password === $password_confirm) {
        // Хешування паролю за допомогою алгоритму SHA-1.
        $password = sha1($password);

        // Додавання нового користувача у базу даних.

        mysqli_query($connect,"INSERT INTO `users` (`id`, `name`, `login`, `email`, `password`, `permission`,`bookmark`) VALUES (NULL, '$full_name', '$login', '$email', '$password', 'user','0')");
        // Встановлення повідомлення про успішну реєстрацію та перенаправлення на сторінку входу.
        $_SESSION['message'] = "Registration done";
        header('Location: ../login.php');
    }else{
        // Встановлення повідомлення про невідповідність паролів та перенаправлення на сторінку реєстрації.
        $_SESSION['message'] = "Password not confirmed";
        header('Location: ../register.php');
    }
?>

