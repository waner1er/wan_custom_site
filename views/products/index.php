<?php

use Classes\Product;

/** @var $products Product */

ob_start();
?>

    <h1 class="text-center">Products</h1>
    <a href="/products/create" class="btn btn-primary">Create</a>

<?php
foreach ($products as $product) {
    $card = <<<HTML
        <div class="card">
            <div class="card-body">
                <h5 class="card-title text-center">{$product->getName()}</h5>
                <p class="card-text text-center">{$product->getPrice()}</p>
                <a href="/products/edit/{$product->getId()}" class="btn btn-primary">Edit</a>
            </div>
        </div>
HTML;

    echo $card;
}

$content = ob_get_contents();
ob_end_clean();
include BASE_URL . '/views/components/layout.php';