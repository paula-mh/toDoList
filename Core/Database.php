<?php

class Database {
    private static $instance = null;
    private $conn;

    private function __construct($servername, $username, $password, $dbname) {
        try {
            $this->conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch(PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }

    public static function getInstance() {
        $servername = "localhost:3306";
        $username = "username";
        $password = "password";
        $dbname = "dbname";

        if (!self::$instance) {
            self::$instance = new self($servername, $username, $password, $dbname);
        }
        return self::$instance;
    }

    public function getConnection() {
        return $this->conn;
    }

    public function __destruct() {
        $this->conn = null;
    }
}

?>