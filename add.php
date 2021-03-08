<!doctype html>
<html lang="en" class="h-100">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Гостевая книга</title>
    <!-- Bootstrap core CSS -->
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
                        <a class="nav-link active" aria-current="page" href="/">Назад</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <!-- Begin page content -->
    <main class="flex-shrink-0 mt-3">
        <div class="container">
            <div class="card shadow">
                <div class="card-header">
                    <?php if($created):?>
                        <div class="alert alert-primary">Запись добавлена!</div>
                    <?php endif;?>
                    <h1 class="text-center">Гостевая книга</h1>
                </div>
                <div class="card-body">

                    <form action="/save.php" method="post" accept-charset="utf-8">
                         <div class="mb-3 row">
                            <label for="name" class="col-sm-2 col-form-label">Имя:</label>
                            <div class="col-sm-10">
                                <input type="text" name="name" class="form-control" id="name" placeholder="Ваше имя" required>
                            </div>
                        </div>

                        <div class="mb-3 row">
                            
                            <label for="email" class="col-sm-2 col-form-label">Email:</label>
                            
                            <div class="col-sm-10">
                                <input type="email" name='email' class="form-control" id="email" placeholder="Ваш email" required>
                            </div>

                        </div>

                        <div class="mb-3 row">
                            <label for="descr" class="col-sm-2 col-form-label">Описание:</label>
                            <div class="col-sm-10">
                              
                               <textarea class="form-control mb-3" name="body" id="descr" rows="8" required></textarea>
                               <div class="form-group">
                                <div class="g-recaptcha" data-sitekey="6Ld_PnAaAAAAAD4LdQemG81_WFmkUkXAwNX81eA-" required>
                                </div>
                                <span class="text-danger">
                                    <?php
                                        if($response->success===false)
                                            echo '<p>Пройдите тест reCaptcha!</p>'; 
                                    ?>
                                </span>
                               </div>                               
                            </div>
                        </div>
                           <div class="mb-3">
                              <button type="submit" 
                                        name="submit"
                                  class="btn btn-primary form-control w-auto" 
                                  style="float:right;">
                                Добавить
                              </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </main>
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
</body>
</html>