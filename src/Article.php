<?php

namespace Blog;

use \Blog\User;

class Article {

    private $title;
    private $content;
    private $email;
    private $pdo;

    public function __construct(string $title, string $content, string $email, $pdo) {
        $this->title = $title;
        $this->content = $content;
        $this->email = $email;
        $this->pdo = $pdo;
    }

    public function addArticle() : bool {
        if(Article::checkArguments()) {
            $sth = $this->pdo->prepare('INSERT INTO articles (title,content,author) VALUES (:title,:content,:author)');
            $sth->bindParam(':title', $this->title);
            $sth->bindParam(':content', $this->content);
            $sth->bindParam(':author', $this->email);
            return $sth->execute();
        } else {
            throw new \Exception("Podałeś nieprawidłowe dane");
        }
    }

    public static function getMyArticles(string $author, $pdo) : array {
        $sth = $pdo->prepare('SELECT id,title,content,author FROM articles WHERE author = :author');
        $sth->bindParam(':author', $author);
        $sth->execute();

        return $sth->fetchAll();
    }

    public static function getAllArticles($pdo) : array {
        $sth = $pdo->prepare('SELECT id,title,content,author FROM articles');
        $sth->execute();

        return $sth->fetchAll();
    }

    public static function getArticle(int $id, $pdo) : array {
        $sth = $pdo->prepare('SELECT id,title,content FROM articles WHERE id = :id');
        $sth->bindParam(':id', $id);
        $sth->execute();

        if($sth->rowCount() > 0) {
            return $sth->fetch();
        } else {
            header('Location: index.php');
        }
    }

    public function removeArticle(int $id, $pdo) : bool {
        $sth = $pdo->prepare('DELETE FROM articles WHERE id = :id');
        $sth->bindParam(':id', $id);

        return $sth->execute();
    }

    public function updateArticle(int $id, $pdo) : int {
        if(Article::checkArguments()) {
            $sth = $pdo->prepare('UPDATE articles SET title = :title, content = :content WHERE id = :id');
            $sth->bindParam(':title', $this->title);
            $sth->bindParam(':content', $this->content);
            $sth->bindParam(':id', $id);

            return $sth->execute();
        } else {
            throw new \Exception("Podałeś nieprawidłowe dane");
        }
    }

    private function checkArguments() : bool {
        Article::filterArguments();
        if(empty($this->title)) {
            return false;
           
        }
        if(empty($this->content)) {
            return false;
        }

        return true;
    }

    private function filterArguments() : void {
        $this->title = strip_tags(trim($this->title));
        $this->content = strip_tags(trim($this->content));
    }
}