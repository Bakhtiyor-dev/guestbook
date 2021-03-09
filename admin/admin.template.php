<?php
session_start();
if(!$_SESSION['loggedIn']){
  header('Location:/admin/login.php');
  die();
}else
  require('../pagination/pagination_admin.php');  
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
          <form action="/admin/logout.php" method="post" accept-charset="utf-8">
            <button type="submit" class="btn btn-outline-warning">Выйти</button>
          </form>
        </div>
      </div>
    </nav>
    <div class="container d-flex flex-column align-items-center mb-5">
      <h2 class="text-center m-2">Записи:</h2>
    <?php if($res_data):?>
      <?php while($row = $res_data->fetch_assoc()):?>  
        <div class="card m-2" id="record<?=$row['id'];?>" style="width: 50rem;">
          <div class="card-header d-flex justify-content-between">
            <div>
              <h5><?=$row['name']?></h5> <?=$row['email']?> оставил запись в <?=$row['created_at']?>
            </div> 

            <div class="form-inline">                  
              
                <div class="custom-control  custom-switch">
                  <input type="checkbox" 
                  onclick="set_status(this.checked,<?=$row['id'];?>)"  
                  class="custom-control-input" 
                  id="customSwitch<?=$row['id'];?>"
                  <?if($row['status']==1)echo 'checked'?>
                  >
                  <label class="custom-control-label" for="customSwitch<?=$row['id'];?>"></label>
                </div>  

                <a href="/crud/edit.php?id=<?=$row['id']?>&pageno=<?=$pageno?>" class="btn btn-outline-primary btn-sm mr-1">Редактировать</a>

                <form action="/crud/delete.php" method="post">
                  <input type="hidden" name="id" value="<?=$row['id']?>">
                  <button type="submit" class="btn btn-outline-danger btn-sm">Удалить</button>
                </form>

              

            </div>


          </div>
          <div class="card-body">
            <?=$row['body']?>
          </div>
        </div>
      <?php endwhile;?> 
    <?php endif;?>

      <?php if($res_data->num_rows==0):?>
        No records
      <?php endif;?>
      <?php if($pageno=0):?>
      <ul class="pagination justify-content-center mt-3">
        <li class="page-item <?php if($pageno<=1)echo 'disabled';?>">
          <a class="page-link" 
          href="/admin?pageno=<?php if($pageno>1)echo $pageno-1?>"  
          >
          Назад
        </a>
      </li>
      <?php for($i=1;$i<=$total_pages;$i++):?>
        <li class="page-item <?php if($pageno==$i)echo 'active';?>">
          <a class="page-link" href="/admin?pageno=<?=$i?>">
            <?=$i?>
          </a>
        </li>
      <?php endfor;?>
      <li class="page-item <?php if($pageno>=$total_pages)echo 'disabled';?>">
        <a class="page-link" href="/admin?pageno=<?php if($pageno<$total_pages)echo $pageno+1?>">Далее</a>
      </li>
    </ul>
  <?php endif;?>
  </div>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="https://getbootstrap.com/docs/5.0/dist/js/bootstrap.bundle.min.js" type="text/javascript" charset="utf-8" async defer></script>
  <script>
    function set_status(checked,id){
      $.post('/admin/status.php', {checked:checked,id:id});
    }
  </script>
</body>
</html>
<?php endif;?>