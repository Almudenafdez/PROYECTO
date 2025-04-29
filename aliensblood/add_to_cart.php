<?php
session_start();

if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

if (isset($_GET['id'])) {
    $productId = intval($_GET['id']);
    
    // Añadir al carrito
    $_SESSION['cart'][] = $productId;

    echo json_encode([
        'success' => true,
        'count' => count($_SESSION['cart'])
    ]);
} else {
    echo json_encode(['success' => false]);
}
