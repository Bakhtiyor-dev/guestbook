<?php
session_start();
if(!$_SESSION['loggedIn']){
  header('Location:/admin/login.php');
  die();
}else{
  require('../database/db.php');
  $pageno=mysqli_real_escape_string($conn,htmlspecialchars($_GET['pageno']));
  $id=mysqli_real_escape_string($conn,htmlspecialchars($_GET['id']));
  $id=htmlspecialchars($id);

  if(!$id || empty($id) || $id<=0 || !isset($id))
    die();

  $sql="SELECT * FROM records WHERE id=$id";
  $row=$conn->query($sql)->fetch_assoc();  
  $conn->close();
}
?>

<?php if($_SESSION['loggedIn']):?>
  <!DOCTYPE html>
  <html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin-Panel</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
  </head>

  <body>
    <nav class="navbar navbar-dark bg-dark">
      <div class="container-fluid">
        <div>
        <a class="navbar-brand text-white">Админ</a>
        <a class="navbar-brand text-white" href="/admin"><small>Назад</small></a>
          
        </div>
        
        <div class="d-flex">
          <form action="/admin/logout.php" method="post" accept-charset="utf-8">
            <button type="submit" class="btn btn-outline-warning">Выйти</button>
          </form>
        </div>
      </div>
    </nav>
    <div class="container">
      <div class="card shadow">
        <div class="card-header">
          <h1 class="text-center">Редактировать</h1>
        </div>
        <div class="card-body">

          <form action="/crud/update.php" method="post" accept-charset="utf-8">
           <div class="mb-3 row">
            <label for="name" class="col-sm-2 col-form-label">Имя:</label>
            <div class="col-sm-10">
              <input type="text" name="name" class="form-control" id="name" value="<?=$row['name']?>" required>
            </div>
          </div>
          <input type="hidden" value="<?=$row['id'];?>" name="id">
          <input type="hidden" value="<?=$pageno?>" name="pageno">
          <div class="mb-3 row">

            <label for="email" class="col-sm-2 col-form-label">Email:</label>

            <div class="col-sm-10">
              <input type="email" name='email' class="form-control" id="email" value="<?=$row['email']?>" required>
            </div>

          </div>

          <div class="mb-3 row">
            <label for="descr" class="col-sm-2 col-form-label">Описание:</label>
            <div class="col-sm-10">
             <textarea class="form-control mb-3" name="body" id="descr" rows="8" required><?=$row['body']?></textarea>
           </div>
         </div>
         <div class="mb-3 row">
          <label for="date" class="col-sm-2 col-form-label">Время добавления:</label>
          <div class="col-sm-10">
            <div class="form-inline">
              <input type="date" 
                    class="form-control mr-2" 
                    value="<?=date('Y-m-d',strtotime($row['created_at']))?>" 
                    name="date">      

              <input type="time"
                    name="time"
                    class="form-control"
                    value="<?=date('H:i:s',strtotime($row['created_at']))?>">      

            </div>


          </div>
        </div>
        <div class="mb-3">
          <button type="submit" 
          name="submit"
          class="btn btn-primary form-control w-auto" 
          style="float:right;">
          Сохранить
        </button>
      </div>
    </div>
  </form>
</div>
</div>
</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://getbootstrap.com/docs/5.0/dist/js/bootstrap.bundle.min.js" type="text/javascript" charset="utf-8" async defer></script>
</body>
</html>
<?php endif;?>