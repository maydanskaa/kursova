<?php
// Змінні для підключення до бази даних
    $host = '127.0.0.1';
    $database = 'kursova';
    $user = 'root';
    $password = 'qwerty123';

// Встановлення з'єднання з базою даних
    $connect = mysqli_connect($host, $user, $password, $database);

    // Перевірка успішності підключення

    if (!$connect) {
        // У випадку невдалого підключення виводимо повідомлення та припиняємо виконання скрипту
        // У випадку невдалого підключення виводимо повідомлення та припиняємо виконання скрипту
        die('Error database connection');
    }