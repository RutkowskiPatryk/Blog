<?php
include_once('templates/header.php');

use \Blog\Database;
use \Blog\Article;

if(isset($_GET['id'])) {

    include_once __DIR__.'/vendor/autoload.php';

    $database = new Database();
    $article = Article::removeArticle($_GET['id'], $database->getConnection());

    header('Location: my-articles.php?remove='.$article);
} else {
    header('Location: my-articles.php');
}

?>