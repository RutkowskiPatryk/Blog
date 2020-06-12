<?php

include_once('templates/header.php');

if(!isset($_SESSION['login'])) {
    header('Location: login.php');
}

include_once __DIR__.'/vendor/autoload.php';

use \Blog\Article;
use \Blog\Database;

$database = new Database();

if(isset($_GET['id'])) {
    $article_info = Article::getArticle($_GET['id'], $database->getConnection());
} else {
    header('Location: index.php');
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
        <div class="float-right">
            <a href="index.php"><button class="btn btn-primary my-2 my-sm-0" type="submit">Powrót</button></a>
        </div>
            <h1 class="display-4"><?php echo $article_info['title']; ?></h1>
            <hr>
            <p class="lead"><?php echo $article_info['content']; ?></p>
          </div>
      </div>

<?php
include_once('templates/footer.php');
?>