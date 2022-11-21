<?php
class Database
{
    public $connection;

    public function getConnection()
    {
        $this->connection = null;
        try {
            $this->connection = mysqli_connect("hostName", "user", "password", "databaseName");
            if (!$this->connection) {
                die("Connection failed: " . mysqli_connect_error());
            }
        } catch (Exception $e) {
            echo json_encode(array('message' => 'Database could not be connected: ' . $e->getMessage()));
            die();
        }
        return $this->connection;
    }

    public function closeConnection()
    {
        $this->connection->close();
    }
}