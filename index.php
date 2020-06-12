<?php
include_once 'templates/header.php';

if(!isset($_SESSION['login'])) {
    header('Location: login.php');
}
?>

<nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="index.php">Blog</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
      
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
                <li class="nav-item">
                    <a class="nav-link" href="all-articles.php">Wszystkie artykuły</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="add-article.php">Dodaj artykuł</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="my-articles.php">Twoje artykuły</a>
                </li>
              </ul>
          <a href="logout.php"><button class="btn btn-outline-primary my-2 my-sm-0" type="submit">Wyloguj</button></a>
        </div>
      </nav>

<div class="container">
    <div class="jumbotron">
        <div class="row">
            <div class="col-lg-4">
                <div class="card">
                    <img src="assets/images/post.jpg" class="card-img-top">
                    <div class="card-body">
                        <p class="card-text text-center">Zobacz swoje artykuły</p>
                        <a href="my-articles.php"><button class="btn btn-outline-primary btn-lg btn-block" type="submit">Zobacz</button></a>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="card">
                    <img src="assets/images/my-post.jpg" class="card-img-top">
                    <div class="card-body">
                        <p class="card-text text-center">Zobacz wszystkie artykuły</p>
                        <a href="all-articles.php"><button class="btn btn-outline-primary btn-lg btn-block" type="submit">Zobacz</button></a>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="card">
                    <img src="assets/images/post.jpg" class="card-img-top">
                    <div class="card-body">
                        <p class="card-text text-center">Dodaj nowy artykuł</p>
                        <a href="add-article.php"><button class="btn btn-outline-primary btn-lg btn-block" type="submit">Dodaj</button></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
include_once 'templates/footer.php';
?>