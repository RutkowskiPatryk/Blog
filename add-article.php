<?php

include_once('templates/header-login.php');

if(!isset($_SESSION['login'])) {
    header('Location: login.php');
}

include_once __DIR__.'/vendor/autoload.php';

use \Blog\Article;
use \Blog\Database;

if(isset($_POST['add'])) {
    $pdo = new Database();
    $article = new Article($_POST['title'], $_POST['content'], $_SESSION['login'], $pdo->getConnection());
    try {
        $add_article = $article->addArticle();
    } catch (Exception $e) {
        $error = $e->getMessage();
    }

}
?>
      <div class="container">
        <div class="jumbotron">
        <div class="float-right">
            <a href="index.php"><button class="btn btn-primary my-2 my-sm-0" type="submit">Powrót</button></a>
        </div>
            <h1 class="display-4">Dodaj nowy artykuł</h1>
            <hr>
            <?php
                if(isset($error)) {
                    echo '<div class="alert alert-danger" role="alert">';
                    echo $error;
                    echo '<button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button></div>';
                    unset($error);
                }

                if(isset($add_article) && $add_article) {
                    echo '<div class="alert alert-success" role="alert">';
                    echo 'Twój artykuł został dodany poprawnie';
                    echo '<button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button></div>';
                    unset($error);
                    unset($_POST);
                }
            ?>
            <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
              <div class="form-group">
                <label for="email">Tytuł</label>
                <input type="text" class="form-control" id="title" name="title" value="<?php if(isset($_POST['title'])) echo $_POST['title']; ?>">
              </div>
              <div class="form-group">
                <label for="content">Treść</label>
                <textarea class="form-control" id="content" rows="5" name="content" value="<?php if(isset($_POST['content'])) echo $_POST['content']; ?>"></textarea>
              </div>
              <button type="submit" class="btn btn-primary" name="add">Dodaj</button>
          </form>
          </div>
      </div>

<?php
include_once('templates/footer.php');
?>
