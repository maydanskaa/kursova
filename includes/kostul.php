<?php
    session_start();     // Початок сесії для зберігання та використання даних сесії

// Перевірка, чи відправлено POST-запит із ключем 'test', рівним "xyz"
    if ($_POST['test'] == "xyz") {
        // Знищення змінної сесії 'querry'
        unset( $_SESSION['querry']);
        // Перенаправлення користувача на сторінку index.php
        header('Location: ../index.php');
   }

// Перевірка, чи відправлено POST-запит із ключем 'rmcomp', рівним "xyz"

    if ($_POST['rmcomp'] == "xyz") {
        // Знищення змінної сесії 'comp'
        unset( $_SESSION['comp']);
        // Перенаправлення користувача на сторінку comparison.php
        header('Location: ../comparison.php');
        // Завершення виконання скрипту
        die();
   }
    // Перенаправлення користувача на сторінку index.php за замовчуванням
    header('Location: ../index.php');