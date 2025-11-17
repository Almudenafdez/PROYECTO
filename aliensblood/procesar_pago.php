<?php
session_start();
require_once 'includes/db.php';

if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    header("Location: checkout.php");
    exit;
}

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

if (!isset($_SESSION['cart']) || count($_SESSION['cart']) === 0) {
    header("Location: cart.php");
    exit;
}

$nombre = htmlspecialchars($_POST['card_name'] ?? '');
$numero = htmlspecialchars($_POST['card_number'] ?? '');
$expira = htmlspecialchars($_POST['expiry'] ?? '');
$cvv = htmlspecialchars($_POST['cvv'] ?? '');

if (empty($nombre) || empty($numero) || empty($expira) || empty($cvv)) {
    die("Error: Datos de tarjeta incompletos");
}

try {
    $designIds = array_map(fn($item) => $item['design_id'] ?? null, $_SESSION['cart']);
    $designIds = array_filter($designIds);

    if (empty($designIds)) {
        header("Location: cart.php");
        exit;
    }

    $placeholders = implode(',', array_fill(0, count($designIds), '?'));
    $stmt = $pdo->prepare("SELECT id FROM designs WHERE id IN ($placeholders)");
    $stmt->execute($designIds);
    $cartItems = $stmt->fetchAll(PDO::FETCH_ASSOC);

    if (empty($cartItems)) {
        header("Location: cart.php");
        exit;
    }

    $total = 9.99 * count($cartItems);

    $pdo->beginTransaction();

    $stmtOrder = $pdo->prepare("INSERT INTO orders (user_id, total, estado) VALUES (?, ?, 'Completado')");
    $stmtOrder->execute([$_SESSION['user_id'], $total]);
    $order_id = $pdo->lastInsertId();

    $stmtItem = $pdo->prepare("INSERT INTO order_items (order_id, product_id, quantity, price) VALUES (?, ?, ?, ?)");
    foreach ($cartItems as $item) {
        $stmtItem->execute([$order_id, $item['id'], 1, 9.99]);
    }

    $pdo->commit();

    unset($_SESSION['cart']);
    header("Location: pago_exitoso.php");
    exit;

} catch (Exception $e) {
    if ($pdo->inTransaction()) {
        $pdo->rollBack();
    }
    die("Error procesando el pedido: " . $e->getMessage());
}
?>
