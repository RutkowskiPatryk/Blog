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
           
            <?php
                include_once __DIR__.'/vendor/autoload.php';
                use \Blog\Database;
                use \Blog\Article;

                $database = new Database();
                $articles = Article::getAllArticles($database->getConnection());

                foreach($articles as $article) {
                    echo '<div class="col-lg-4">';
                    echo '<img src="assets/images/post.jpg" class="card-img-top" alt="Image">';
                    echo '<div class="card-body">';
                    echo '<p class="card-text text-center">'. $article['title'] .'</p>';
                    echo '<a href="single-article.php?id='. $article['id'] .'"><button class="btn btn-outline-primary btn-lg btn-block" type="submit">Zobacz</button></a>';
                    echo '</div></div>';
                }
            ?>
           
        </div>
    </div>
</div>

<?php
include_once 'templates/footer.php';
?>