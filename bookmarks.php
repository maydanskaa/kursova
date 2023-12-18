<?php
session_start(); // Розпочинаємо сесію для зберігання та використання даних сесії
require_once 'includes/connect.php'; // Підключаємо файл для встановлення з'єднання з базою даних
// Перевіряємо, чи користувач авторизований
if (isset($_SESSION['user'])) {
  $querry = "SELECT * FROM bookmarks WHERE id_users = " . $_SESSION['user']['id'] . "";


// Видаляємо закладку, якщо вона передана через параметр GET
  if (isset($_GET['bookid'])) {
    //print_r($_GET['bookid']);
    $del = "DELETE FROM `kursova`.`bookmarks` WHERE  `id_users`= " . $_SESSION['user']['id'] . " AND `bookmark_id`= " . $_GET['bookid'] . " LIMIT 1";
    mysqli_query($connect, $del);

  }
  $res = mysqli_query($connect, $querry); // Виконуємо запит до бази даних для отримання списку закладок користувача
} else {
  header('Location: /login.php'); // Якщо користувач не авторизований, перенаправляємо його на сторінку входу
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Закладки</title>

  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

  <!-- Шрифт Awesome -->
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css">
  <!-- Google шрифт -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap">
  <link rel="stylesheet" href="/css/login.css">

</head>
<header>
  <div class="d-flex flex-column flex-md-row align-items-center p-3 px-md-4 mb-3 bg-white border-bottom shadow-sm">
      <!-- Заголовок сторінки з посиланням на головну сторінку -->
    <h5 class="my-0 mr-md-auto font-weight-normal"><a href="/">Вибір мобільних пристроїв</a></h5>
    <div class="md-form active-purple-4 col-lg-4">
        <!-- Форма для пошуку з інтерактивним відображенням (active-purple-4) -->
        <input class="form-control" type="text" placeholder="Search" aria-label="Search">
        <!-- Поле введення для пошуку мобільних пристроїв -->
    </div>
      <!-- Навігаційна панель з посиланням на Порівняння та Закладки -->
    <nav class="my-2 my-md-0 mr-md-3">
        <!-- Посилання на сторінку порівняння мобільних пристроїв -->
        <a class="p-2 text-dark" href="#">Comparison</a>
        <!-- Посилання на сторінку закладок мобільних пристроїв -->
      <a class="p-2 text-dark" href="bookmarks.php">Bookmarks</a>
    </nav>
    <?php
    // Перевірка, чи користувач авторизований
    if (isset($_SESSION['user'])) {
        // Виведення кнопки "Account" із ім'ям авторизованого користувача
      echo ("<a class='btn btn-outline-primary col-lg-1' href='profile.php'>Account(" . $_SESSION['user']['name'] . ")</a>");
    } else {
        // Виведення кнопки "Sign in" для неввійшовших користувачів
      echo ("<a class='btn btn-outline-primary col-lg-1' href='login.php'>Sign in</a>");
    }


    ?>

  </div>
</header>

<div class="container">
  <div class="column">

    <?php
    while ($row = mysqli_fetch_array($res)) {
        // Отримання даних про закладку з бази даних
      $querry1 = "SELECT v.name, s.model, s.img FROM smartphone s INNER JOIN vendor_list v ON s.vendor = v.id_vendor WHERE s.id = " . $row['bookmark_id'] . "";
      $mob = mysqli_fetch_assoc(mysqli_query($connect, $querry1));


      echo ("
                        <div class='card-header mb-3 col-lg-12'>
                        <div class='row d-flex justify-content-around'>
                         <!-- Зображення мобільного пристрою з розміром 30 пікселів та відступом справа -->
                        <img src='" . $mob['img'] . "' alt='' style='width: 30px' class='mr-3'>
                                    <!-- Заголовок з ім'ям та моделлю мобільного пристрою -->
                            <h4 class='my-0 font-weight-normal'>" .
        $mob['name'] . " " . $mob['model'] . "
                            </h4>
                                        <!-- Форма для видалення закладки -->
                            <form action='bookmarks.php' method='get' class=''>
                                            <!-- Приховане поле із значенням ідентифікатора закладки для передачі на сервер -->
                            <input type='hidden' value=" . $row['bookmark_id'] . " name='bookid'>
                                            <!-- Кнопка для відправлення форми і видалення закладки -->
                            <button class='btn btn-primary btn-block' type='submit'>Delete</button>
                        </form>

                            </div>
                         </div>
                        ");
    }
    ?>
  </div>
</div>