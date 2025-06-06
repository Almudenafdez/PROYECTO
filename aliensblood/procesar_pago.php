<?php
session_start();
require_once 'includes/db.php';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (!isset($_SESSION['user_id'])) {
        header("Location: login.php");
        exit;
    }

    $nombre = htmlspecialchars($_POST['card_name']);
    $numero = $_POST['card_number'];
    $expira = $_POST['expiry'];
    $cvv = $_POST['cvv'];

    // Validación básica del carrito
    if (!isset($_SESSION['cart']) || count($_SESSION['cart']) === 0) {
        header("Location: cart.php");
        exit;
    }

    // Obtener productos del carrito
    $placeholders = implode(',', array_fill(0, count($_SESSION['cart']), '?'));
    $stmt = $pdo->prepare("SELECT * FROM designs WHERE id IN ($placeholders)");
    $stmt->execute($_SESSION['cart']);
    $cartItems = $stmt->fetchAll();

    $total = 0;
    $itemsData = [];
    foreach ($cartItems as $item) {
        $price = 9.99; // Precio fijo
        $quantity = 1; // Si manejas cantidades, cámbialo
        $total += $price * $quantity;

        $itemsData[] = [
            'product_id' => $item['id'],
            'quantity' => $quantity,
            'price' => $price
        ];
    }

    $transactionStarted = false;

    try {
        $pdo->beginTransaction();
        $transactionStarted = true;

        // Insertar pedido
        $stmtOrder = $pdo->prepare("INSERT INTO orders (user_id, total, estado) VALUES (?, ?, 'Pendiente')");
        $stmtOrder->execute([$_SESSION['user_id'], $total]);
        $order_id = $pdo->lastInsertId();

        // Insertar productos del pedido
        $stmtItem = $pdo->prepare("INSERT INTO order_items (order_id, product_id, quantity, price) VALUES (?, ?, ?, ?)");
        foreach ($itemsData as $item) {
            $stmtItem->execute([$order_id, $item['product_id'], $item['quantity'], $item['price']]);
        }

        // Guardar en tabla pedidos (opcional)
        foreach ($_SESSION['cart'] as $productId) {
            $stmt = $pdo->prepare("INSERT INTO pedidos (user_id, product_id) VALUES (?, ?)");
            $stmt->execute([$_SESSION['user_id'], $productId]);
        }

        $pdo->commit();
        unset($_SESSION['cart']);

        // HTML de éxito
        echo "<!DOCTYPE html>
        <html lang='es'>
        <head>
            <meta charset='UTF-8'>
            <meta name='viewport' content='width=device-width, initial-scale=1'>
            <title>Pago Exitoso</title>
            <link rel='stylesheet' href='assets/css/procesar_pago.css'>
            <script>
                setTimeout(() => {
                    window.location.href = 'index.php';
                }, 5000);
            </script>
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
                <p style='text-align:center; margin-top:1rem; color:#ccc;'>
                    Serás redirigido al inicio en 5 segundos...
                </p>
            </div>
        </body>
        </html>";
        exit;

    } catch (Exception $e) {
        if ($transactionStarted) {
            $pdo->rollBack();
        }
        die("Error procesando el pedido: " . $e->getMessage());
    }
} else {
    header("Location: checkout.php");
    exit;
}
