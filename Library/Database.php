<?php

namespace App\Library;

if (!defined('ACCESS')) { die; }

class Database
{
    private $host = 'db';
    private $db = 'web_db';
    private $user = 'devuser';
    private $pass = 'devpass';

    /** @var \PDO */
    private $connection;

    /** @var Database */
    private static $instance;

    public function __construct()
    {
        $this->connect();
    }

    public static function getInstance(): Database
    {
        if (empty(self::$instance)) {
            $instance = new self();
            self::$instance = $instance;
        }
        return self::$instance;
    }

    public function getConnection(): \PDO
    {
        return $this->connection;
    }

    private function connect()
    {
        try {
            $conn = new \PDO("mysql:host=$this->host;dbname=$this->db", $this->user, $this->pass);
            // set the PDO error mode to exception
            $conn->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
            $this->connection = $conn;
        }
        catch(\PDOException $e)
        {
            echo "Connection failed: " . $e->getMessage();
            die;
        }
        $conn = null;
    }

    public function select(string $sql): \PDOStatement
    {
        try {
            $stmt = $this->connection->prepare($sql);
            $result = $stmt->setFetchMode(\PDO::FETCH_ASSOC);

            return $stmt;
        }
        catch(\PDOException $e) {
            echo "Error: " . $e->getMessage();
            die;
        }
    }
}
