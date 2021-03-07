<?php
require('db.php');

if (isset($_GET['pageno'])) {
    $pageno = $_GET['pageno'];
} else {
    $pageno = 1;
}

$no_of_records_per_page = 1;
$offset = ($pageno-1) * $no_of_records_per_page;

$total_pages_sql = "SELECT COUNT(*) FROM records";
$result = mysqli_query($conn,$total_pages_sql);
$total_rows = mysqli_fetch_array($result)[0];
$total_pages = ceil($total_rows / $no_of_records_per_page);

$sql = "SELECT * FROM records LIMIT $offset, $no_of_records_per_page";
$res_data = mysqli_query($conn,$sql);
mysqli_close($conn);
?>
<!doctype html>
<html lang="en" class="h-100">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Гостевая книга</title>
    <link href="assets/css/bootstrap.min.css" rel="stylesheet">    

</head>

<body class="d-flex flex-column h-100">

    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <div class="container-fluid">
            <a class="navbar-brand" href="/">Гостевая книга</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="/add.php">Оставить запись</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    
    <main>
        <div class="container" id="container">
            <?php while($row = $res_data->fetch_assoc()):?>  
              <div class="card m-2" style="width: 50rem;">
                <div class="card-header d-flex">
                  <div>
                      <h5><?=$row['name']?></h5> <?=$row['email']?> оставил запись в <?=$row['created_at']?></div> 
                  </div>
                  <div class="card-body">
                      <?=$row['body']?>
                  </div>
              </div>
          <?php endwhile;?> 
      </div>

      <ul class="pagination justify-content-center mt-3">
          <li class="page-item <?php if($pageno<=1)echo 'disabled';?>">
              <a class="page-link" 
              href="/?pageno=<?php if($pageno>1)echo --$pageno?>" 
              tabindex="-1" 
              aria-disabled="true">
              Назад
          </a>
      </li>
        <?php for($i=1;$i<=$total_pages;$i++):?>
            <li class="page-item <?php if($pageno==$i) echo 'active';?>">
                <a class="page-link" href="/?pageno=<?=$i?>">
                    <?=$i?>
                </a>
            </li>
        <?php endfor;?>
    <li class="page-item <?php if($pageno>=$total_pages)echo 'disabled';?>">
        <a class="page-link" href="/?pageno=<?php if($pageno<$total_pages)echo ++$pageno?>">Далее</a>
    </li>
</ul>
</main>

<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
<script src="assets/js/popper.min.js"></script>
<script src="pagination.js" type="text/javascript" charset="utf-8" async defer></script>
<script src="assets/js/bootstrap.bundle.js" type="text/javascript" charset="utf-8" async defer></script>

</body>


</html>

