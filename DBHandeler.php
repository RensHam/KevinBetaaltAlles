<?php
require 'Config.php';

class DBHandeler
{
    private $conn;

    public function __construct()
    {
        $this->conn = new PDO('mysql:host=' . Config::DB_HOST . ';dbname=' . Config::DB_NAME, Config::DB_USERNAME,
            Config::DB_PASSWORD);
    }

    public function addPayment(string $name, int $amount): bool
    {
        $statement = $this->conn->prepare('INSERT INTO payments (user_name, amount) VALUES (:user_name, :amount)');
        $statement->bindParam('user_name', $name);
        $statement->bindParam(':amount', $amount);
        return $statement->execute();
    }
}