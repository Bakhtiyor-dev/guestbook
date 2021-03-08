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
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
  </head>

  <body>
    <nav class="navbar navbar-dark bg-dark">
      <div class="container-fluid">
        <a class="navbar-brand text-white">Админ</a>
        <div class="d-flex">
          <form action="/logout.php" method="post" accept-charset="utf-8">
            <button type="submit" class="btn btn-outline-warning">Выйти</button>
          </form>
        </div>
      </div>
    </nav>
    <div class="container d-flex flex-column align-items-center mb-5">
      <h2 class="text-center m-2">Записи:</h2>

      <?php while($row = $res->fetch_assoc()):?>  
        <div class="card m-2" style="width: 50rem;">
          <div class="card-header d-flex justify-content-between">
            <div>
              <h5><?=$row['name']?></h5> <?=$row['email']?> оставил запись в <?=$row['created_at']?>
            </div> 

              <div class="form-group">                  
                <div class="btn-group btn-group-sm" role="group">
                  <small class="mr-2">Статус:  </small>
                  <div class="custom-control custom-switch">

                    <input type="checkbox" 
                            onclick="set_status(this.checked,<?=$row['id'];?>)"  
                            class="custom-control-input" 
                            id="customSwitch<?=$row['id'];?>"
                            <?if($row['status']==1)echo 'checked'?>
                            >
                    <label class="custom-control-label" for="customSwitch<?=$row['id'];?>"></label>
                  </div>  

                  <button type="button" class="btn btn-outline-primary">Редактировать</button>
                  
                  <form action="/delete.php" method="post">
                    <input type="hidden" name="id" value="<?=$row['id']?>">
                    <button type="submit" class="btn btn-outline-danger">Удалить</button>
                  </form>

                </div>

              </div>


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
      <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
      <script src="https://getbootstrap.com/docs/5.0/dist/js/bootstrap.bundle.min.js" type="text/javascript" charset="utf-8" async defer></script>
      <script>
        function set_status(checked,id){
          $.post('/status.php', {checked:checked,id:id});
        }
      </script>
    </body>
    </html>
    <?php endif;?>