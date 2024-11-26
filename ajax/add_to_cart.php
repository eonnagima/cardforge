<?php

require_once __DIR__."/../bootstrap.php";

$data = json_decode(file_get_contents('php://input'), true);
$productAlias = $data['product_alias'] ?? null;

$response = [];

if ($productAlias) {
    if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = [];
    }

    if (!in_array($productAlias, $_SESSION['cart'])) {
        $_SESSION['cart'][] = $productAlias;
    }

    $response['cartCount'] = count($_SESSION['cart']);
} else {
    $response['error'] = 'Invalid product alias';
}

// Debugging information
$response['debug'] = [
    'session_cart' => $_SESSION['cart'],
    'product_alias' => $productAlias,
];

echo json_encode($response);