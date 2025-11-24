<!-- CART.PHP-->
<?php
session_start();
require_once 'includes/db.php';

// Inicializar carrito si no existe
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

// Eliminar un diseño del carrito (por design_id)
if (isset($_GET['remove'])) {
    $removeId = (int) $_GET['remove'];
    $_SESSION['cart'] = array_filter($_SESSION['cart'], function($item) use ($removeId) {
        return $item['design_id'] != $removeId;
    });
    // Reindexar array para evitar índices dispersos
    $_SESSION['cart'] = array_values($_SESSION['cart']);
    header("Location: cart.php");
    exit;
}

$cartItems = [];
$total = 0;

if (count($_SESSION['cart']) > 0) {
    // Obtener solo los design_id para la consulta
    $designIds = array_map(fn($item) => $item['design_id'], $_SESSION['cart']);

    $placeholders = implode(',', array_fill(0, count($designIds), '?'));
    $stmt = $pdo->prepare("SELECT * FROM designs WHERE id IN ($placeholders)");
    $stmt->execute($designIds);
    $cartItems = $stmt->fetchAll();

    // Asociar la cantidad con cada item para mostrarla
    // Crear un array asociativo [design_id => quantity]
    $quantities = [];
    foreach ($_SESSION['cart'] as $item) {
        $quantities[$item['design_id']] = $item['quantity'];
    }
}

$pedidos = [];
if (isset($_SESSION['user_id'])) {
    $stmtPedidos = $pdo->prepare("SELECT id, fecha, total, estado FROM orders WHERE user_id = ? ORDER BY fecha DESC");
    $stmtPedidos->execute([$_SESSION['user_id']]);
    $pedidos = $stmtPedidos->fetchAll();
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
                <?php foreach ($cartItems as $item): 
                    $qty = $quantities[$item['id']] ?? 1; // Cantidad o 1 por defecto
                ?>
                    <div class="cart-item">
                        <img src="assets/img/<?= htmlspecialchars($item['image']) ?>" alt="<?= htmlspecialchars($item['title']) ?>">
                        <div class="item-info">
                            <h3><?= htmlspecialchars($item['title']) ?></h3>
                            <p>Cantidad: <?= $qty ?></p>
                            <p>Precio: 9.99 €</p>
                            <a class="remove-link" href="cart.php?remove=<?= $item['id'] ?>">❌ Quitar</a>
                        </div>
                    </div>
                    <?php $total += 9.99 * $qty; ?>
                <?php endforeach; ?>
            </div>

            <div class="cart-total">
                <strong>Total:</strong> <?= number_format($total, 2) ?> €
                <a href="checkout.php" class="checkout-btn">Finalizar Compra</a>
            </div>
        <?php endif; ?>
    </section>

    <!-- resto del código para pedidos anteriores y footer sin cambios -->

    <?php if (isset($_SESSION['user_id'])): ?>
    <section class="order-history">
    <h2>Pedidos Anteriores</h2>

    <?php if (count($pedidos) > 0): ?>
        <?php foreach ($pedidos as $pedido): ?>
            <div class="order-box">
                <h3>Pedido #<?= htmlspecialchars($pedido['id']) ?> - <?= htmlspecialchars($pedido['fecha']) ?></h3>
                <p><strong>Total:</strong> <?= number_format($pedido['total'], 2) ?> €</p>
                <p><strong>Estado:</strong> <?= htmlspecialchars($pedido['estado']) ?></p>

                <div class="order-images">
                    <?php
                    $stmtItems = $pdo->prepare("
                        SELECT d.image, d.title
                        FROM order_items oi
                        JOIN designs d ON oi.product_id = d.id
                        WHERE oi.order_id = ?
                    ");
                    $stmtItems->execute([$pedido['id']]);
                    $productos = $stmtItems->fetchAll();

                    foreach ($productos as $prod):
                    ?>
                        <div class="order-image">
                            <img src="assets/img/<?= htmlspecialchars($prod['image']) ?>" alt="<?= htmlspecialchars($prod['title']) ?>" style="width: 80px; height: auto; margin: 5px; border: 1px solid #ccc; border-radius: 4px;">
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        <?php endforeach; ?>
    <?php else: ?>
        <p>No tienes pedidos anteriores.</p>
    <?php endif; ?>
</section>
    <?php endif; ?>

    <!-- BOTÓN DE INICIO-->
    <a href="index.php" style="position: fixed; bottom: 20px; right: 20px; background-color: #000; color: #fff; padding: 10px 15px; border-radius: 8px; text-decoration: none; z-index: 999;">
        Volver al Inicio
    </a>
</main>

<footer>
    <p>&copy; <?= date("Y") ?> ALiENS BLooD. Todos los derechos reservados.</p>
</footer>
</body>
</html>
