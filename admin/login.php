<?php
  session_start();
?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Авторизация</title>
    <!-- Bootstrap core CSS -->
    <link href="https://getbootstrap.com/docs/4.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom styles for this template -->
    <link href="https://getbootstrap.com/docs/4.0/examples/sign-in/signin.css" rel="stylesheet">
  </head> 
  <body class="text-center">
    <form action="process.php" method="post" class="form-signin">
      <h1>Админ</h1>
      <?php if($message=$_SESSION['message']):?>
         <div class="alert alert-danger"><?=$message;?></div>     
      <?php endif;?>
     
      <label for="inputEmail" class="sr-only">Email</label>
      <input type="email" name="admin_email" id="inputEmail" class="form-control mb-2" placeholder="Email"  autofocus required>
      <label for="inputPassword" class="sr-only">Пароль</label>
      <input type="password" name="admin_password" id="inputPassword" class="form-control" placeholder="Пароль" required>
      
      <button class="btn btn-lg btn-primary btn-block" type="submit">Войти</button>
      <p class="mt-5 mb-3 text-muted">&copy; 2021</p>
    </form>
  </body>
</html>
<?php 
  unset($_SESSION['message']);
?>