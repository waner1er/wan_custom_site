<?php

namespace Controllers;

require_once __DIR__ . '/../Classes/Product.php';
require_once __DIR__ . '/../Classes/Database.php';
use PDO;
use Classes\Product;
use Classes\Database;

class HomeController
{
    public function index(): void
    {
        $data = ['name' => 'World'];
        $this->loadView(__DIR__ . '/../views/home/index.php', $data);
    }

    private function loadView(string $viewPath, array $data): void
    {
        extract($data);
        require_once $viewPath;
    }
}