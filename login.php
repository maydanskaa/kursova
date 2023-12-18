<?php
    session_start(); // Розпочинаємо сесію для зберігання та використання даних сесії
    if (isset($_SESSION['user'])) { //Перевіряємо, чи у сесії користувач авторизований
      header('Location: index.php'); //Якщо так, то переправляємо на сторінку index.php
    }
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Авторизація</title> <!-- Заголовок сторінки Авторизація -->
    <link rel="stylesheet" href="/css/login.css">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

    <!-- Шрифт Awesome -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css">
    <!-- Google шрифт -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap">
    


</head>
<body>
<!-- Створення карточки для форми авторизації -->
<div class="container">
    <div class="row">
      <div class="col-sm-9 col-md-7 col-lg-5 mx-auto">
        <div class="card card-signin my-5">
          <div class="card-body">
            <h5 class="card-title text-center">Sign In</h5>
              <!-- Початок форми авторизації -->
            <form class="form-signin" action="includes/signin.php" method="POST">
                <!-- Поле введення для логіна -->
              <div class="form-label-group">
                <input type="text" id="inputLogin" class="form-control" placeholder="Login" required autofocus name="login">
                <label for="inputLogin">Login</label>
              </div>
                <!-- Поле введення для пароля -->
              <div class="form-label-group">
                <input type="password" id="inputPassword" class="form-control" placeholder="Password" required name="password">
                <label for="inputPassword">Password</label>
              </div>
                <!-- Віджет для вибору чи пам'ятати пароль -->
              <div class="custom-control custom-checkbox mb-3">
                <input type="checkbox" class="custom-control-input" id="customCheck1">
                <label class="custom-control-label" for="customCheck1">Remember password</label>
              </div>
                <!-- Кнопка для входу у аккаунт -->
              <button class="btn btn-lg btn-primary btn-block text-uppercase" type="submit">Sign in</button>
              <div class="row mx-auto">
                  <!-- Рядок для  переходу до сторінки реєстрації -->
              <p>No account? </p> <a href="register.php">Sign Up</a>
              </div>
              <h3 class="text-center"><?php unset($_SESSION['message']); ?></h3>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>

    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</body>


</html>