<?php

include_once('templates/header-login.php');

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
