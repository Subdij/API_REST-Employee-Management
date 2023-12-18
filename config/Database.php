<?php
class Database {
    private $host = "127.0.0.1";
    private $database_name = "aero";
    private $username = "root";
    private $password = "";
    public $conn;
    
    public function getConnection(){
        $this->conn = null;
        try {
            $this->conn = new PDO("mysql:host=" . $this->host, $this->username, $this->password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $query = "SELECT SCHEMA_NAME FROM INFORMATION_SCHEMA.SCHEMATA WHERE SCHEMA_NAME = :database_name";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':database_name', $this->database_name);
            $stmt->execute();

            if ($stmt->rowCount() == 0) {
                $createDatabaseQuery = "CREATE DATABASE IF NOT EXISTS " . $this->database_name;
                $this->conn->exec($createDatabaseQuery);
            }

            $this->conn = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->database_name, $this->username, $this->password);
            $this->conn->exec("set names utf8");
        } catch(PDOException $exception) {
            echo "Database could not be connected: " . $exception->getMessage();
        }
        return $this->conn;
    }
}
?>