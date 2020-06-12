<?php

namespace Blog;

class User {

    private $email;
    private $password;
    private $pdo;

    public function __construct(string $email, string $password, $pdo) {
        $this->email = $email;
        $this->password = $password;
        $this->pdo = $pdo;
    }

    public function registerUser(string $second_password) : bool {
        if(User::checkArguments() && User::comparePasswords($second_password) == 0) {
            if(User::isEmailFree() == 0) {
                $sth = $this->pdo->prepare('INSERT INTO users (email,password) VALUES (:email, :password)');
                @$sth->bindParam(':email', strip_tags($this->email), \PDO::PARAM_STR);
                @$sth->bindParam(':password', strip_tags($this->password), \PDO::PARAM_STR);
                return $sth->execute();

            } else {
                throw new \Exception("Użytkownik o podanym emailu już istnieje");
            }
        } else {
            throw new \Exception("Podałeś złe dane lub hasła nie są identyczne");
        }
    }

    public function loginUser() : bool {
        if(User::checkArguments()) {
            if(User::isUserExists()) {
                $_SESSION['login'] = $this->email;
                header('Location: index.php');
            } else {
                throw new \Exception("Podany użytkownik nie istnieje");
            }
        } else {
            throw new \Exception("Podany email lub hasło jest nieprawidłowe");
        }

    }

    private function checkArguments() : bool {
        if(!filter_var($this->email, FILTER_VALIDATE_EMAIL) || empty($this->email)) {
            return false;
        }
        if(strlen($this->password) < 6 || empty($this->password)) {
            return false;
        }

        return true;
    }

    private function isUserExists() : int {
        $sth = $this->pdo->prepare('SELECT email FROM users WHERE email = :email AND password = :password');
        $sth->bindParam(':email', $this->email);
        $sth->bindParam(':password', $this->password);
        $sth->execute();

        return $sth->rowCount();
    }

    private function isEmailFree() : int {
        $sth = $this->pdo->prepare('SELECT email FROM users WHERE email = :email');
        $sth->bindParam(':email', $this->email);
        $sth->execute();

        return $sth->rowCount();
    }

    private function comparePasswords(string $password) : bool {
        return strcmp($this->password, $password);
    }

    public function getEmail() : string {
        return $this->email;
    }
}