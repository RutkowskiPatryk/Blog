<?php
include_once('templates/header-login.php');

if(!isset($_SESSION['login'])) {
    header('Location: login.php');
}
?>

<div class="container">
    <div class="jumbotron">
        <div class="row">
            <div class="col-lg-4">
                <div class="card">
                    <img src="assets/images/post.jpg" class="card-img-top">
                    <div class="card-body">
                        <p class="card-text text-center">Zobacz swoje artykuły</p>
                        <a href="my-articles.php"><button class="btn btn-outline-primary btn-lg btn-block" type="submit">Zobacz</button></a>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="card">
                    <img src="assets/images/my-post.jpg" class="card-img-top">
                    <div class="card-body">
                        <p class="card-text text-center">Zobacz wszystkie artykuły</p>
                        <a href="all-articles.php"><button class="btn btn-outline-primary btn-lg btn-block" type="submit">Zobacz</button></a>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="card">
                    <img src="assets/images/post.jpg" class="card-img-top">
                    <div class="card-body">
                        <p class="card-text text-center">Dodaj nowy artykuł</p>
                        <a href="add-article.php"><button class="btn btn-outline-primary btn-lg btn-block" type="submit">Dodaj</button></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
include_once 'templates/footer.php';
?>
