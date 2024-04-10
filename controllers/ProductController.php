<?php

namespace Controllers;

use PDO;
use Classes\Product;
use Classes\Database;

class ProductController
{
    public function index(): void
    {
        $products = [];
        $db = Database::getInstance(DB_TYPE);
        $connection = $db->getConnection();

        $statement = $connection->prepare("SELECT * FROM products");
        $statement->execute();

        while ($row = $statement->fetch()) {
            $product = new Product();
            $product->setId((int)$row['id']);
            $product->setName($row['name']);
            $product->setPrice((float)$row['price']);
            $products[] = $product;
        }

        $data = compact('products');

        $this->loadView(__DIR__ . '/../views/products/index.php', $data);
    }

    public function show(int $id): void
    {
        $product = new Product();
        $product->setName('Product ' . $id);
        $product->setPrice(100 * $id);

        $data = compact('product');

        $this->loadView(__DIR__ . '/../views/products/index.php', $data);
    }

    public function create(): void
    {
        $this->loadView(__DIR__ . '/../views/products/create.php', []);
    }

    public function store(): void
    {
        $product = new Product();
        $product->setName($_POST['name']);
        $product->setPrice((float)$_POST['price']);

        $db = Database::getInstance(DB_TYPE);
        $connection = $db->getConnection();

        $statement = $connection->prepare("INSERT INTO products (name, price) VALUES (:name, :price)");

        $name = $product->getName();
        $statement->bindParam(':name', $name);

        $price = $product->getPrice();
        $statement->bindParam(':price', $price);

        $statement->execute();

        header('Location: /products');
    }

    public function edit(Product $product): void
    {
        $data = compact('product');

        $this->loadView(__DIR__ . '/../views/products/edit.php', $data);
    }

   public function update(int $id): void
{
    // Find the product in the database
    $product = Product::find($id);

    if ($product === null) {
        // Handle the case where no product is found
        return;
    }

    // Update the product's attributes
    $product->setName($_POST['name']);
    $product->setPrice((float)$_POST['price']);

    // Save the changes to the database
    $db = Database::getInstance(DB_TYPE);
    $connection = $db->getConnection();

    $statement = $connection->prepare("UPDATE products SET name = :name, price = :price WHERE id = :id");
    $name = $product->getName();
    $statement->bindParam(':name', $name);
    $price = $product->getPrice();
    $statement->bindParam(':price', $price);
    $statement->bindParam(':id', $id, PDO::PARAM_INT);
    $statement->execute();
    // Redirect the user back to the products page
    header('Location: /products');
}

    private function loadView(string $viewPath, array $data): void
    {
        extract($data);
        require_once $viewPath;
    }
}