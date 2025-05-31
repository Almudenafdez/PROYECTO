<?php
session_start();
if (!isset($_SESSION['cart']) || count($_SESSION['cart']) === 0) {
    header("Location: cart.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Pago - ALiENS BLooD</title>
    <link rel="stylesheet" href="assets/css/styles.css">
    <link rel="stylesheet" href="assets/css/checkout.css">
</head>
<body>
<?php include 'includes/header.php'; ?>

<main class="checkout-container">
    <h2>Pago con Tarjeta</h2>
    <form id="payment-form">
        <label for="card-name">Nombre en la Tarjeta:</label>
        <input type="text" id="card-name" required>

        <label for="card-number">Número de Tarjeta:</label>
        <input type="text" id="card-number" maxlength="19" required>

        <label for="expiry">Fecha de Expiración (MM/AA):</label>
        <input type="text" id="expiry" placeholder="MM/AA" maxlength="5" required>

        <label for="cvv">CVV:</label>
        <input type="text" id="cvv" maxlength="4" required>

        <button type="submit" class="btn-pagar">Pagar Ahora</button>
        <div id="payment-message"></div>
    </form>
</main>

<script src="assets/js/payment.js" defer></script>
</body>
</html>
