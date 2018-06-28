<?php

use Entity\Entity;

require 'Config.php';

/**
 * The Class DBHandeler connects to the database and handel all database calls
 */
class DBHandeler
{
    private $conn;
    private $payer;

    public function __construct(string $payer)
    {
        $this->conn = new PDO('mysql:host=' . Config::DB_HOST . ';dbname=' . Config::DB_NAME . ';charset=utf8',
            Config::DB_USERNAME,
            Config::DB_PASSWORD);
        $this->payer = $payer;
    }

    /**
     * Insert a payment into the database.
     * @param string $name a name
     * @param int $amount cost of the payment
     * @param string $description a description of the payment
     * @return bool
     */
    public function addPayment(string $name, int $amount, string $description): bool
    {
        $statement = $this->conn->prepare('INSERT INTO payments (user_name, amount, description,payer) VALUES (:user_name, :amount, :description,:payer)');
        $statement->bindParam('user_name', $name);
        $statement->bindParam(':amount', $amount);
        $statement->bindParam(':description', $description);
        $statement->bindParam(':payer', $this->payer);
        return $statement->execute();
    }

    /**
     * Get information about the total made payments
     * @return Payments
     */
    public function totalUserPayments(): Payments
    {
        $statement = $this->conn->prepare('SELECT SUM(amount) as `amount`, COUNT(*) as `count` FROM payments WHERE payer = :payer');
        $statement->bindParam(':payer', $this->payer);
        $statement->execute();
        return new Payments($statement->fetch(PDO::FETCH_ASSOC));
    }

    /**
     * Get information about the total made payments for a given username
     * @param string $user
     * @return Payments
     */
    public function totalUserPaymentsForUser(string $user): Payments
    {
        $statement = $this->conn->prepare('SELECT SUM(amount) as `amount`, COUNT(*) as `count` FROM payments WHERE payer = :payer AND user_name = :user_name');
        $statement->bindParam(':payer', $this->payer);
        $statement->bindParam(':user_name', $user);
        $statement->execute();
        return new Payments($statement->fetch(PDO::FETCH_ASSOC));
    }

    /**
     * Get information about the total made payments
     * @return Payments
     */
    public function totalPayments(): Payments
    {
        return new Payments($this->conn->query('SELECT SUM(amount) as `amount`, COUNT(*) as `count` FROM payments')->fetch(PDO::FETCH_ASSOC));
    }
}

/**
 * @property string $amount
 * @property string $count
 */
class Payments extends Entity
{
    /**
     * @return string
     */
    public function getAmount(): string
    {
        return number_format($this->get('amount'));
    }

    /**
     * @return string
     */
    public function getCount(): string
    {
        return number_format($this->get('count'));
    }
}