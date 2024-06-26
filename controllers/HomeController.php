<?php

namespace Controllers;



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