<?php

namespace Blog;

require_once 'config.php';

class Database {

    private $host = DB_HOST;
    private $user = DB_USER;
    private $password = DB_PASSWORD;
    private $dbname = DB_NAME;
    private $dbh;

    public function getConnection() {
        try {
            $this->dbh = new \PDO('mysql:host='.$this->host.';dbname='.$this->dbname, $this->user, $this->password);
        } catch (PDOException $e) {
            echo 'Błąd: ' . $e->getMessage() . '<br>';
        }

        return $this->dbh;
    }
}