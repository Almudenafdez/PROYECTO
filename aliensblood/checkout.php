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
    <link rel="stylesheet" href="assets/css/procesar_pago.css">

</head>
<body>
<?php include 'includes/header.php'; ?>

<main class="checkout-container">
    <h2>Pago con Tarjeta</h2>
    <form action="procesar_pago.php" method="POST" id="payment-form">
        <label for="card-name">Nombre en la Tarjeta:</label>
        <input type="text" id="card-name" name="card_name" required placeholder="Juan Pérez">

        <label for="card-number">Número de Tarjeta:</label>
        <input type="text" id="card-number" name="card_number" maxlength="19" required placeholder="1234 5678 9012 3456">

        <label for="expiry">Fecha de Expiración (MM/AA):</label>
        <input type="text" id="expiry" name="expiry" placeholder="MM/AA" maxlength="5" required>

        <label for="cvv">CVV:</label>
        <input type="text" id="cvv" name="cvv" maxlength="4" required placeholder="123">

        <button type="submit" class="btn-pagar">
            <span class="btn-text">Pagar Ahora</span>
            <span class="btn-loader"></span>
        </button>
    </form>

    <a href="index.php" style="position: fixed; bottom: 20px; right: 20px; background-color: #000; color: #fff; padding: 10px 15px; border-radius: 8px; text-decoration: none; z-index: 999;">
        Volver al Inicio
    </a>
</main>

<!-- Librerías JS -->
<script src="https://cdn.jsdelivr.net/npm/cleave.js@1/dist/cleave.min.js"></script>
<script src="assets/js/procesar_pago.js"></script>
</body>
</html>
