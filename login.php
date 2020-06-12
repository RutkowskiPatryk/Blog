<?php

include_once('templates/header.php');

if(isset($_SESSION['login'])) {
    header('Location: index.php');
}

include_once __DIR__.'/vendor/autoload.php';

use \Blog\User;
use \Blog\Database;

if(isset($_POST['login'])) {
    $pdo = new Database();
    $user = new User($_POST['email'], $_POST['password'], $pdo->getConnection());
    try {
        $user->loginUser();
    } catch (Exception $e) {
        $error = $e->getMessage();
    }
}
?>

<nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="index.php">Blog</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
      
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav mr-auto">

          </ul>
          <a href="register.php"><button class="btn btn-outline-primary my-2 my-sm-0" type="submit">Rejestracja</button></a>
        </div>
      </nav>

      <div class="container">
        <div class="jumbotron">
            <h1 class="display-4">Zaloguj się</h1>
            <hr>
            <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
            <?php
                if(isset($error)) {
                    echo '<div class="alert alert-danger" role="alert">';
                    echo $error;
                    echo '<button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button></div>';
                    unset($error);
                }
            ?>
              <div class="form-group">
                <label for="email">Podaj email</label>
                <input type="email" class="form-control" id="email" name="email" value="<?php if(isset($_POST['email'])) {echo $_POST['email'];} ?>">
              </div>
              <div class="form-group">
                <label for="password">Hasło</label>
                <input type="password" class="form-control" id="password" name="password">
              </div>
              <button type="submit" class="btn btn-primary" name="login">Zaloguj</button>
          </form>
          </div>
      </div>

<?php
include_once('templates/footer.php');
?>