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