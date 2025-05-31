<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['design_id'])) {
    $designId = (int) $_POST['design_id'];
    unset($_SESSION['cart'][$designId]);
}

header('Location: ../cart.php');
exit;
