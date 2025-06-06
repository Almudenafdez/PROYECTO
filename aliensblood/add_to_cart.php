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
<a href="index.php" style="position: fixed; bottom: 20px; right: 20px; background-color: #000; color: #fff; padding: 10px 15px; border-radius: 8px; text-decoration: none; z-index: 999;">
  Volver al Inicio
</a>
