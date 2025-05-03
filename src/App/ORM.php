<?php

namespace App;

use PDO;

final class ORM
{

    private static ?self $instance = null;
    private PDO $pdo;

    public function __construct()
    {
        $this->pdo = new PDO('mysql:host=mysql;dbname=app_db', 'app_user', 'app_password');
    }

    public static function getInstance(): self
    {
        if (self::$instance === null) {
            self::$instance = new self();
        }

        return self::$instance;

        //$res = $dbh->query('SELECT * FROM users');
        /*echo '<pre>';
        var_dump($res->fetchAll(PDO::FETCH_ASSOC));*/
    }

    public function getConnection(): PDO
    {
        self::getInstance();
        return $this->pdo;
    }
}