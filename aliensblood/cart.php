<?php
session_start();
require_once 'includes/db.php';

// Eliminar un diseño del carrito
if (isset($_GET['remove'])) {
    $removeId = (int) $_GET['remove'];
    $_SESSION['cart'] = array_filter($_SESSION['cart'], fn($id) => $id != $removeId);
    header("Location: cart.php");
    exit;
}

// Inicializar el carrito si no existe
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

$cartItems = [];
$total = 0;

if (count($_SESSION['cart']) > 0) {
    $placeholders = implode(',', array_fill(0, count($_SESSION['cart']), '?'));
    $stmt = $pdo->prepare("SELECT * FROM designs WHERE id IN ($placeholders)");
    $stmt->execute($_SESSION['cart']);
    $cartItems = $stmt->fetchAll();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Tu Carrito - ALiENS BLooD</title>
    <link rel="stylesheet" href="assets/css/styles.css">
    <link rel="stylesheet" href="assets/css/cart.css">
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
    <section class="cart-section">
        <h2>Tu Carrito</h2>

        <?php if (empty($cartItems)): ?>
            <p>Tu carrito está vacío.</p>
        <?php else: ?>
            <div class="cart-items">
                <?php foreach ($cartItems as $item): ?>
                    <div class="cart-item">
                        <img src="assets/img/<?= htmlspecialchars($item['image']) ?>" alt="<?= htmlspecialchars($item['title']) ?>">
                        <div class="item-info">
                            <h3><?= htmlspecialchars($item['title']) ?></h3>
                            <p>Precio: 9.99 €</p>
                            <a class="remove-link" href="cart.php?remove=<?= $item['id'] ?>">❌ Quitar</a>
                        </div>
                    </div>
                    <?php $total += 9.99; ?>
                <?php endforeach; ?>
            </div>

            <div class="cart-total">
                <strong>Total:</strong> <?= number_format($total, 2) ?> €
                <a href="checkout.php" class="checkout-btn">Finalizar Compra</a>
            </div>
        <?php endif; ?>
    </section>
</main>

<footer>
    <p>&copy; <?= date("Y") ?> ALiENS BLooD. Todos los derechos reservados.</p>
</footer>
</body>
</html>
