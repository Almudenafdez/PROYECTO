<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['design_id'])) {
    $designId = (int) $_POST['design_id'];

    if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = [];
    }

    if (!in_array($designId, $_SESSION['cart'])) {
        $_SESSION['cart'][] = $designId;
    }
}

header("Location: ../shop.php?added=1");
exit;
