<?php
session_start();
require_once 'includes/db.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

if (!isset($_SESSION['cart']) || count($_SESSION['cart']) === 0) {
    header("Location: cart.php");
    exit;
}

try {
    $designIds = array_map(fn($item) => $item['design_id'] ?? null, $_SESSION['cart']);
    $designIds = array_filter($designIds);
    
    if (empty($designIds)) {
        header("Location: cart.php");
        exit;
    }

    $placeholders = implode(',', array_fill(0, count($designIds), '?'));
    $stmt = $pdo->prepare("SELECT * FROM designs WHERE id IN ($placeholders)");
    $stmt->execute($designIds);
    $cartItems = $stmt->fetchAll();

    $total = 0;
    foreach ($cartItems as $item) {
        $total += 9.99;
    }
} catch (Exception $e) {
    die("Error al cargar los productos");
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Checkout - ALiENS BLooD</title>
    <link rel="stylesheet" href="assets/css/styles.css">
    <link rel="stylesheet" href="assets/css/checkout.css">
</head>
<body>
<header>
    <h1 class="site-title">ALiENS BLooD</h1>
    <nav>
        <ul>
            <li><a href="index.php">Inicio</a></li>
            <li><a href="designers.php">Diseñadores</a></li>
            <li><a href="shop.php">Tienda</a></li>
            <li><a href="contact.php">Contacto</a></li>
            <li><a href="appointment.php">Citas</a></li>
            <li><a href="legal.php">Políticas</a></li>
            <li><a href="cart.php" class="active">🛒 Carrito</a></li>
        </ul>
    </nav>
</header>

<main>
    <section class="checkout-container">
        <h2>Checkout</h2>
        
        <div class="checkout-content">
            <div class="order-summary">
                <h3>Resumen del Pedido</h3>
                <div class="summary-items">
                    <?php foreach ($cartItems as $item): ?>
                        <div class="summary-item">
                            <span><?= htmlspecialchars($item['title']) ?></span>
                            <span>9.99 €</span>
                        </div>
                    <?php endforeach; ?>
                </div>
                <div class="summary-total">
                    <strong>Total: <?= number_format($total, 2) ?> €</strong>
                </div>
            </div>

            <form method="POST" action="procesar_pago.php" class="payment-form">
                <h3>Información de Pago</h3>
                
                <div class="form-group">
                    <label for="card_name">Nombre en la Tarjeta</label>
                    <input type="text" id="card_name" name="card_name" required>
                </div>

                <div class="form-group">
                    <label for="card_number">Número de Tarjeta</label>
                    <input type="text" id="card_number" name="card_number" placeholder="1234 5678 9012 3456" maxlength="19" required>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label for="expiry">Vencimiento (MM/YY)</label>
                        <input type="text" id="expiry" name="expiry" placeholder="MM/YY" maxlength="5" required>
                    </div>
                    <div class="form-group">
                        <label for="cvv">CVV</label>
                        <input type="text" id="cvv" name="cvv" placeholder="123" maxlength="3" required>
                    </div>
                </div>

                <button type="submit" class="pay-btn">Procesar Pago</button>
                <a href="cart.php" class="back-link">Volver al Carrito</a>
            </form>
        </div>
    </section>
</main>

<footer>
    <p>&copy; <?= date("Y") ?> ALiENS BLooD. Todos los derechos reservados.</p>
</footer>
</body>
</html>
