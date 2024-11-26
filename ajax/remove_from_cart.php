<?php

require_once __DIR__."/../bootstrap.php";

use Codinari\Cardforge\Product;

$data = json_decode(file_get_contents('php://input'), true);
$productAlias = $data['product_alias'];

// Remove product from cart
if (($key = array_search($productAlias, $_SESSION['cart'])) !== false) {
    unset($_SESSION['cart'][$key]);
}

// Recalculate total
$total = 0;
foreach ($_SESSION['cart'] as $item) {
    $product = Product::getByAlias($item);
    $total += $product['price'];
}

$response = [
    'new_total' => $total,
    'cart_count' => count($_SESSION['cart']),
];

echo json_encode($response);