<?php
session_start(); // Розпочинаємо сесію для зберігання та використання даних сесії
require_once 'connect.php';
if (!isset($_SESSION['user'])) { //Перевіряємо, чи у сесії користувач авторизований
    header('Location: ../login.php'); //Якщо ні, то переправляємо на сторінку login.php
}

// Перевіряємо, чи передані дані POST
if (isset($_POST)) {
    // Отримуємо значення id_user та id_mob з POST-запиту
    $user = $_POST['id_user'];
    $mob = $_POST['id_mob'];

    // Перевірка, чи існує закладка користувача для вибраного мобільного пристрою
    $querry = "SELECT * FROM bookmarks WHERE id_users = $user";
    $res = mysqli_query($connect,$querry);
    while($row = mysqli_fetch_array($res)){
        // Якщо закладка вже існує, перенаправляємо користувача на головну сторінку та припиняємо виконання скрипта
        if($row['bookmark_id'] == $mob){
            header('Location: ../index.php');
            die();
        }
    }
    // Вставка нового запису в таблицю закладок
    $querry = "INSERT INTO `kursova`.`bookmarks` (`id_users`, `bookmark_id`) VALUES ($user, $mob)";
    mysqli_query($connect, $querry);

    // Перенаправлення користувача на головну сторінку після додавання закладки
    header('Location: ../index.php');
}