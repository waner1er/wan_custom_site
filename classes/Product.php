<?php

namespace Classes;

require_once __DIR__ . '/Database.php';

use PDO;
use Classes\Database;

class Product
{
    private $id;
    private $name;
    private $price;


    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }


    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function getPrice(): float
    {
        return $this->price;
    }

    public function setPrice(float $price): void
    {
        $this->price = $price;
    }

    public static function find(int $id): ?Product
    {
        $db = Database::getInstance(DB_TYPE);
        $connection = $db->getConnection();

        $statement = $connection->prepare("SELECT * FROM products WHERE id = :id");
        $statement->bindParam(':id', $id, PDO::PARAM_INT);
        $statement->execute();

        $row = $statement->fetch();
        if (!$row) {
            return null;
        }

        $product = new Product();
        $product->setId($row['id']); // Set the product ID
        $product->setName($row['name']);
        $product->setPrice((float)$row['price']);

        return $product;
    }


}