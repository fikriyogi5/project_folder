<?php
// File: DbConnection.php

class Database
{
    private $host = 'localhost';
    private $username = 'root';
    private $password = '';
    private $database = 'app';
    private $conn;

    public function __construct()
    {
        $this->conn = new PDO("mysql:host=$this->host;dbname=$this->database", $this->username, $this->password);
        $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

    public function executeQuery($query, $params = [])
    {
        $stmt = $this->conn->prepare($query);
        $stmt->execute($params);
        return $stmt;
    }

    public function getLastInsertedId()
    {
        return $this->conn->lastInsertId();
    }
}