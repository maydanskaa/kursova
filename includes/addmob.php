<?php
    session_start(); // Розпочинаємо сесію для зберігання та використання даних сесії
    require_once 'connect.php';

    // Отримання даних з POST-запиту
    $vendor = $_POST['vendor'];
    $model = $_POST['model'];
    $soc = $_POST['soc'];
    $battery = $_POST['battery'];
    $display = $_POST['display'];
    $display_type = $_POST['display_type'];
    $ram = $_POST['ram'];
    $rom = $_POST['rom'];
    $weight = $_POST['weight'];
    $cam_r1 = $_POST['cam_r1'];
    $cam_r2 = $_POST['cam_r2'];
    $cam_r3 = $_POST['cam_r3'];
    $cam_r4 = $_POST['cam_r4'];
    $cam_f1 = $_POST['cam_f1'];
    $cam_f2 = $_POST['cam_f2'];
    $gsm = $_POST['gsm'];
    $os = $_POST['os'];
    $diagonal = $_POST['diagonal'];
    $price = $_POST['price'];

// Перевірка та присвоєння значення null для пустих полів камер

    if ($cam_f2 == '') {
        $cam_f2 = "NULL";
    }
    if ($cam_r2 == '') {
        $cam_r2 = "NULL";
    }
    if ($cam_r3 == '') {
        $cam_r3 = "NULL";
    }
    if ($cam_r4 == '') {
        $cam_r4 = "NULL";
    }


// Видалення пробілів у моделі та формування шляху для збереження фото
    $model_nospace = str_replace(" ","",$model);
    $path = 'img/smartphones/'.$vendor.$model_nospace.getExtension($_FILES['foto']['name']);
    move_uploaded_file($_FILES['foto']['tmp_name'],'../'.$path);

// Формування SQL-запиту для вставки нового запису в таблицю smartphone

    $query = "INSERT INTO `smartphone` VALUES (NULL, $vendor, '$model', NULL, '$soc', $battery, '$display', '$display_type', $ram, $rom, $weight, $cam_r1, $cam_r2, $cam_r3, $cam_r4, $cam_f1, $cam_f2, '$gsm', '$os', $diagonal, '$path', $price)";
    $result = mysqli_query($connect,$query);
// Перевірка результату вставки та збереження відповідного повідомлення у сесії

    if ($result) {
        $_SESSION['message'] = "Smartphone added";
    }else{
        $_SESSION['message'] = mysqli_error($connect);
    }
// Перенаправлення на сторінку додавання мобільного пристрою

    header('Location: ../addmobile.php');
// Функція для отримання розширення файлу

    function getExtension($filename){
        $filename = end(explode(".",$filename));
        return ".".$filename;
    }
?>