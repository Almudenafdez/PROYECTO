<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['design_id'])) {
    $designId = (int) $_POST['design_id'];
    $quantity = isset($_POST['quantity']) ? max(1, (int) $_POST['quantity']) : 1;

    if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = [];
    }

    $found = false;

    // Verifica si el diseño ya está en el carrito
    foreach ($_SESSION['cart'] as &$item) {
        if ($item['design_id'] === $designId) {
            $item['quantity'] += $quantity;
            $found = true;
            break;
        }
    }

    // Si no está en el carrito, lo agregamos
    if (!$found) {
        $_SESSION['cart'][] = [
            'design_id' => $designId,
            'quantity' => $quantity
        ];
    }
}

header("Location: ../shop.php?added=1");
exit;
