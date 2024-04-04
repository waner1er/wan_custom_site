<?php ob_start(); ?>

<form method="POST" action="/products/store">
    <label for="name">Product Name:</label><br>
    <input type="text" id="name" name="name"><br>
    <label for="price">Product Price:</label><br>
    <input type="text" id="price" name="price"><br>
    <input type="submit" value="Submit">

    </form>
<?php
$content = ob_get_contents();
ob_end_clean();
include BASE_URL . '/views/components/layout.php';