<head>
    <meta charset = 'UTF-8'>
    <title>Фильмсерчер</title>
    <script src = 'script.js'></script>
    <link rel="stylesheet" href="style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
    <nav class="navbar navbar-expand-lg bg-body-tertiary">
      <div class="container-fluid">
        <a class="navbar-brand"><b>ФИЛЬМСЕРЧЕР</b>"</a>
        <div class="dropdown">
          <button class="dropbtn">Категории</button>
          <div class="dropdown-content">
            <a href="category.php?idcategory=1">Фильмы</a>
            <a href="category.php?idcategory=2">Сериалы</a>
            <a href="category.php?idcategory=3">Аниме</a>
          </div>
        </div>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarTogglerDemo02" aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarTogglerDemo02">
          <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            <li class="nav-item">
              <a class="nav-link" aria-current="page" href="index.phtml">Главная</a>
            </li>
            <li>
              <a class="nav-link" 
                <? if ($_SESSION['email']==NULL) 
                  echo"href='login.phtml'"; 
                else
                  echo "href='account.phtml'"; 
                ?>
                >Личный кабинет</a>
            </li>
          </ul>
          <form class="d-flex" role="search">
            <input class="form-control me-2" type="search" placeholder="Название фильма" aria-label="Search">
            <button class="btn btn-outline-primary" type="submit">Найти</button>
          </form>
        </div>
      </div>
    </nav>
</head>