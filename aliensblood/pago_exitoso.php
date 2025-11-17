<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Pago Exitoso - ALiENS BLooD</title>
    <link rel="stylesheet" href="assets/css/styles.css">
    <link rel="stylesheet" href="assets/css/success.css">
</head>
<body>
    <div class="success-container">
        <div class="success-card">
            <div class="success-icon">✓</div>
            <h1>¡Gracias por tu compra!</h1>
            <p>Tu pago fue procesado correctamente.</p>
            <p class="success-message">Tu pedido aparecerá en "Pedidos Anteriores" en tu carrito.</p>
            <div class="success-actions">
                <a href="index.php" class="btn-primary">Volver al Inicio</a>
                <a href="cart.php" class="btn-secondary">Ver mis Pedidos</a>
            </div>
        </div>
    </div>
</body>
</html>
