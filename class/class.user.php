<?php

include '../config/db.php';
class User
{
    protected $connection;

    public function __construct()
    {
        $db = new Database();
        $this->connection = $db->connection;
    }

    public function read($table, $condition = '', $limit = null)
    {
        $query = "SELECT * FROM $table";
        if ($condition != '') {
            $query .= " WHERE $condition";
        }
        if ($limit !== null) {
            $query .= " LIMIT $limit";
        }

        try {
            $stmt = $this->connection->query($query);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
            return false;
        }
    }
}
