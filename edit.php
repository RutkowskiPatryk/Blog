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

    if(isset($_POST['update'])) {
        $article = new Article($_POST['title'], $_POST['content'], $_SESSION['login'], $database->getConnection());
        try {
            $update = $article->updateArticle($_GET['id'], $database->getConnection());
            header("Location: edit.php?id=" . $_GET['id'] . '&update=true');
        } catch (Exception $e) {
            $error = $e->getMessage();
        }
    } else {
       
    }
} else {
    header('Location: index.php');
}
?>
      <div class="container">
        <div class="jumbotron">
        <div class="float-right">
            <a href="index.php"><button class="btn btn-primary my-2 my-sm-0" type="submit">Powrót</button></a>
        </div>
            <h1 class="display-4">Edytuj artykuł</h1>
            <hr>
            <form action="edit.php?id=<?php if(isset($_GET['id'])) echo $_GET['id']; ?>" method="POST">
            <?php
                if(isset($error)) {
                    echo '<div class="alert alert-danger" role="alert">';
                    echo $error;
                    echo '<button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button></div>';
                    unset($error);
                }

                if(isset($_GET['update']) && isset($_GET['id'])) {
                    echo '<div class="alert alert-success" role="alert">';
                    echo 'Artykuł został poprawnie zaktualizowany';
                    echo '<button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button></div>';
                    unset($error);
                }

            ?>
              <div class="form-group">
                <label for="email">Tytuł</label>
                <input type="text" class="form-control" id="title" name="title" value="<?php if(isset($article_info)) echo $article_info['title']; ?>">
              </div>
              <div class="form-group">
                <label for="content">Treść</label>
                <textarea class="form-control" id="content" rows="5" name="content">
                <?php if(isset($article_info)) echo $article_info['content']; ?>
                </textarea>
              </div>
              <button type="submit" class="btn btn-primary" name="update">Edytuj</button>
          </form>
          </div>
      </div>

<?php
include_once('templates/footer.php');
?>
