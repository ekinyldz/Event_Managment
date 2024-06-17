<?php
class Database {
    private $host = 'localhost';
    private $user = 'root';
    private $password = '';
    private $dbname = 'event_management_db';
    private $conn;

    public function __construct() {
        $this->connect();
        $this->createDatabase();
        $this->createTables();
    }

    private function connect() {
        $this->conn = new mysqli($this->host, $this->user, $this->password);

        if ($this->conn->connect_error) {
            die('Connection failed: ' . $this->conn->connect_error);
        }
    }

    private function createDatabase() {
        $sql = "CREATE DATABASE IF NOT EXISTS $this->dbname";
        if ($this->conn->query($sql) === False) {
            echo "Error creating database: " . $this->conn->error;
        }
        $this->conn->select_db($this->dbname);
    }

    private function createTables() {
        $usersTable = "CREATE TABLE IF NOT EXISTS users (
            id INT AUTO_INCREMENT PRIMARY KEY,
            username VARCHAR(50) NOT NULL,
            email VARCHAR(100) NOT NULL,
            password VARCHAR(255) NOT NULL
        )";

        $eventsTable = "CREATE TABLE IF NOT EXISTS events (
            id INT AUTO_INCREMENT PRIMARY KEY,
            user_id INT NOT NULL,
            event_name VARCHAR(100) NOT NULL,
            description TEXT NOT NULL,
            event_date DATETIME NOT NULL,
            location VARCHAR(100) NOT NULL,
            FOREIGN KEY (user_id) REFERENCES users(id)
        )";

        if ($this->conn->query($usersTable) === FALSE) {
            echo "Error creating 
            users table: " . $this->conn->error;
        } 
        if ($this->conn->query($eventsTable) === FALSE) {
            echo "Error creating events table: " . $this->conn->error;
        } 
    }

    public function getConnection() {
        return $this->conn;
    }
}

new Database();
?>
