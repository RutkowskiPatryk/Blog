<?php

namespace Blog;

require_once 'config.php';

class Database {

    private $host;
    private $user;
    private $password;
    private $dbname;
    private $dbh;
    
    public function __construct() {
        $this->host = DB_HOST;
        $this->user = DB_USER;
        $this->password = DB_PASSWORD;
        $this->dbname = DB_NAME;
    }

    public function getConnection() {
        try {
            $this->dbh = new \PDO('mysql:host='.$this->host.';dbname='.$this->dbname, $this->user, $this->password);
        } catch (PDOException $e) {
            echo 'Błąd: ' . $e->getMessage() . '<br>';
        }

        return $this->dbh;
    }
}
