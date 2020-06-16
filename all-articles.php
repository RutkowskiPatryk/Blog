<?php
include_once('templates/header-login.php');

if(!isset($_SESSION['login'])) {
    header('Location: login.php');
}
?>
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
