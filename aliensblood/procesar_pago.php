<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $nombre = htmlspecialchars($_POST['card_name']);
    $numero = $_POST['card_number'];
    $expira = $_POST['expiry'];
    $cvv = $_POST['cvv'];

    // Aquí iría la integración real con Stripe, PayPal, etc.

    unset($_SESSION['cart']); // Vacía el carrito

    echo "<!DOCTYPE html>
    <html lang='es'>
    <head>
        <meta charset='UTF-8'>
        <meta name='viewport' content='width=device-width, initial-scale=1'>
        <title>Pago Exitoso</title>
        <link rel='stylesheet' href='assets/css/procesar_pago.css'>
    </head>
    <body>
        <div class='checkout-container'>
            <h2>¡Pago realizado con éxito!</h2>
            <div id='payment-message'>
                <svg xmlns='http://www.w3.org/2000/svg' width='32' height='32' viewBox='0 0 16 16'>
                    <path d='M13.485 1.929a.75.75 0 011.06 1.06l-8 8a.75.75 0 01-1.06 0l-4-4a.75.75 0 111.06-1.06L6 8.439l7.485-7.51z'/>
                </svg>
                ¡Gracias por tu compra, $nombre!
            </div>
        </div>
    </body>
    </html>";
    exit;
} else {
    header("Location: checkout.php");
    exit;
}
