<?php

use Classes\Product;
use Controllers\HomeController;
use Controllers\ProductController;


$request = rtrim($_SERVER['REQUEST_URI'], '/');
$method = $_SERVER['REQUEST_METHOD'];

if (preg_match('#^/products/edit/(\d+)$#', $request, $matches)) {
    $id = $matches[1];
    $product = Product::find($id);
    if ($method == 'GET') {
        $controller = new ProductController();
        $controller->edit($product);
    } 
} elseif (preg_match('#^/products/update/(\d+)$#', $request, $matches)) {
    $id = $matches[1];
    if ($method == 'POST') {
        $controller = new ProductController();
        $controller->update($id);
    }
}

else {
    switch ($request) {
        case '':
            $controller = new HomeController();
            $controller->index();
            break;
        case '/products':
            if ($method == 'GET') {
                $controller = new ProductController();
                $controller->index();
            }
            break;
        case '/products/create':
            if ($method == 'GET') {
                $controller = new ProductController();
                $controller->create();
            }
            break;
        case '/products/store':
            if ($method == 'POST') {
                $controller = new ProductController();
                $controller->store();
            }
            break;
        default:
            http_response_code(404);
            require __DIR__ . '/../views/errors/404.php';
            break;
    }
}