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

    public function addPayment(string $name, int $amount, string $description): bool
    {
        $statement = $this->conn->prepare('INSERT INTO payments (user_name, amount, description) VALUES (:user_name, :amount, :description)');
        $statement->bindParam('user_name', $name);
        $statement->bindParam(':amount', $amount);
        $statement->bindParam(':description', $description);
        return $statement->execute();
    }

    public function totalPayments()
    {
        return $this->conn->query('SELECT SUM(amount) as amount, COUNT(*) as payments FROM payments')->fetchObject();
    }
}