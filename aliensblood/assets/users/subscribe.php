<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

require '../includes/db.php';

$user_id = $_SESSION['user_id'];

// Consultar si ya está suscrito
$stmt = $pdo->prepare("SELECT is_subscribed FROM users WHERE id = ?");
$stmt->execute([$user_id]);
$user = $stmt->fetch();

if (!$user) {
    die('Usuario no encontrado.');
}

// Procesar suscripción si el formulario se envió
if ($_SERVER['REQUEST_METHOD'] === 'POST' && $user['is_subscribed'] == 0) {
    $updateStmt = $pdo->prepare("UPDATE users SET is_subscribed = 1 WHERE id = ?");
    $updateStmt->execute([$user_id]);

    // Actualizar variable local
    $user['is_subscribed'] = 1;
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Suscripción - ALiENS BLooD</title>
    <link rel="stylesheet" href="../assets/css/styles.css">
    <link rel="stylesheet" href="../assets/css/subscribe.css">
</head>
<body>

<header>
    <h1 class="site-title">ALiENS BLooD</h1>
    <nav>
        <ul>
            <li><a href="../index.php">Inicio</a></li>
            <li><a href="../designers.php">Diseñadores</a></li>
            <li><a href="../shop.php">Tienda</a></li>
            <li><a href="../users/contact.php">Contacto</a></li>
            <li><a href="profile.php">Mi Perfil</a></li>
        </ul>
    </nav>
</header>

<main class="subscribe-container">
    <h2>Suscripción ALiENS BLooD</h2>

    <?php if ($user['is_subscribed'] == 1): ?>
        <p><strong>Ya estás suscrito.</strong> Gracias por apoyar a ALiENS BLooD.</p>
        <a href="profile.php" class="btn">Volver a mi perfil</a>
    <?php else: ?>
        <p>Suscríbete por solo 4,99€/mes para acceder a contenido exclusivo, subir tus ideas y obtener descuentos.</p>
        <form method="POST">
            <button type="submit" class="btn btn-subscribe">Confirmar Suscripción</button>
        </form>
    <?php endif; ?>
</main>

<footer>
    <p>&copy; <?= date("Y") ?> ALiENS BLooD. Todos los derechos reservados.</p>
</footer>

</body>
</html>
