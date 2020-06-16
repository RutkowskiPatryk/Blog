<?php
include_once('templates/header-login.php');

if(!isset($_SESSION['login'])) {
    header('Location: login.php');
}
?>
<div class="container">
    <div class="jumbotron">
            <?php
                if(isset($_GET['remove'])) {
                    echo '<div class="alert alert-warning" role="alert">';
                    echo 'Twój artykuł został usunięty';
                    echo '<button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button></div>';
                }
            ?>
        <div class="row">
           
            <?php
                include_once __DIR__.'/vendor/autoload.php';
                use \Blog\Database;
                use \Blog\Article;

                $database = new Database();
                $articles = Article::getMyArticles($_SESSION['login'], $database->getConnection());

                foreach($articles as $article) {
                    echo '<div class="col-lg-4">';
                    echo '<img src="assets/images/post.jpg" class="card-img-top" alt="Image">';
                    echo '<div class="card-body">';
                    echo '<p class="card-text text-center">'. $article['title'] .'</p>';
                    echo '<div class="btn-group" role="group">';
                    echo '<a href="single-article.php?id='. $article['id'] .'"><button class="btn btn-outline-primary btn-lg" type="submit">Zobacz</button></a>';
                    echo '<a href="edit.php?id='. $article['id'] .'"><button class="btn btn-outline-success btn-lg" type="submit">Edytuj</button></a>';
                    echo '<a href="remove.php?id='. $article['id'] .'"><button class="btn btn-outline-danger btn-lg" type="submit">Usuń</button></a>';
                    echo '</div></div></div>';
                }
            ?>
           
        </div>
    </div>
</div>

<?php
include_once 'templates/footer.php';
?>
