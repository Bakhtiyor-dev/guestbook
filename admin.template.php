<?php
  session_start();
  
  if(!$_SESSION['loggedIn']){
    header('Location:/login.php');
    die();
  }else{
    require('db.php');
    $sql="SELECT * FROM records";
    $res=$conn->query($sql);  
  }
?>
<?php if($_SESSION['loggedIn']):?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin-Panel</title>
  <link href="assets/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
  <nav class="navbar navbar-dark bg-dark">
  <div class="container-fluid">
    <a class="navbar-brand">Админ</a>
    <div class="d-flex">
      <form action="/logout.php" method="post" accept-charset="utf-8">
          <button type="submit" class="btn text-white" >Выйти</button>
      </form>
    </div>
  </div>
</nav>
<div class="container d-flex flex-column align-items-center">
  <h2 class="text-center m-2">Записи:</h2>

<?php while($row = $res->fetch_assoc()):?>  
  <div class="card m-2" style="width: 50rem;">
    <div class="card-header d-flex">
      <div>
      <h5><?=$row['name']?></h5> <?=$row['email']?> оставил запись в <?=$row['created_at']?></div> 

    <div class="form-check form-switch">
        <input class="form-check-input" type="checkbox" id="flexSwitchCheckChecked">
    </div>
    
      
    

    <form action="/delete.php" method="post">
      <input type="hidden" name="id" value="<?=$row['id']?>">
      <button type="submit" class="btn btn-danger">Удалить</button>
    </form>

    </div>
    <div class="card-body">
      <?=$row['body']?>
    </div>
  </div>
<?php endwhile;?> 

<?php if($res->num_rows==0):?>
  No records
<?php endif;?>

</div>
<script src="https://getbootstrap.com/docs/5.0/dist/js/bootstrap.bundle.min.js" type="text/javascript" charset="utf-8" async defer></script>
</body>
</html>
<?php endif;?>