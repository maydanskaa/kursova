<?php
session_start(); // Початок сесії для зберігання та використання даних сесії
require_once 'connect.php';

// Перевіряємо, чи встановлено параметр пошуку
if (isset($_GET['search'])) {
    // Очищаємо пошуковий ввід, щоб запобігти ін’єкції SQL
    $searchTerm = mysqli_real_escape_string($connect, $_GET['search']);

    // Будуємо запит для пошуку
    $queryNazva = "SELECT v.name, s.model, s.id, s.img, s.soc, s.display, s.display_type, s.ram, s.rom, s.battery, s.diagonal, s.weight, s.gsm, s.os, s.cam_r1, s.cam_r2, s.cam_r3, s.cam_r4, s.cam_f1, s.cam_f2, s.price 
                    FROM smartphone s 
                    INNER JOIN vendor_list v ON s.vendor = v.id_vendor 
                    WHERE CONCAT(v.name,' ', s.model) LIKE '%$searchTerm%'";

    // Зберігаємо змінений запит у сеансі для подальшого використання
    $_SESSION['querry'] = $queryNazva;

    // Переспрямовуємо назад до index.php із пошуковим параметром
    header('Location: ../index.php');
    exit();
} else {
    // Якщо параметр пошуку не встановлено, переспрямуємо на index.php
    header('Location: ../index.php');
    exit();
}
?>
