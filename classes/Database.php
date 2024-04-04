<?php

namespace Classes;

use PDO;
use PDOException;

class Database
{
    private static $instance = null;
    private $connection;
    private $host = 'localhost';
    private $db = 'fromscratch';
    private $user = 'root';
    private $pass = 'root';
    private $charset = 'utf8mb4';

    private $type = 'mysql';
    private $sqlite_path = __DIR__ . '/../database/database.sqlite';

    private function __construct($type = null)
    {
        if ($type) {
            $this->type = $type;
        }

        switch ($this->type) {
            case 'sqlite':
                $dsn = "sqlite:" . $this->sqlite_path;
                break;
            case 'mysql':
            default:
                $dsn = "mysql:host=$this->host;dbname=$this->db;charset=$this->charset";
                break;
        }

        try {
            $this->connection = new PDO($dsn, $this->user, $this->pass);
            $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            echo 'Connection failed: ' . $e->getMessage();
        }
    }

    public static function getInstance($type = null)
    {
        if ($type === null) {
            $type = defined('DB_TYPE') ? DB_TYPE : 'mysql';
        }
        if (self::$instance === null) {
            self::$instance = new Database($type);
        }
        return self::$instance;
    }

    public function getConnection()
    {
        return $this->connection;
    }
}