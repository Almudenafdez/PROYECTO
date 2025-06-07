<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

require '../includes/db.php';

// Obtener datos del usuario actual
$user_id = $_SESSION['user_id'];
$stmt = $pdo->prepare("SELECT username, email, is_subscribed FROM users WHERE id = ?");
$stmt->execute([$user_id]);
$user = $stmt->fetch();

if (!$user) {
    echo "Usuario no encontrado.";
    exit;
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Mi Perfil - ALiENS BLooD</title>
    <link rel="stylesheet" href="../assets/css/styles.css">
    <link rel="stylesheet" href="../assets/css/profile.css">
</head>
<body>

<header>
    <h1 class="site-title">ALiENS BLooD</h1>
    <nav>
        <ul>
            <li><a href="../index.php">Inicio</a></li>
            <li><a href="../novedades.php">Novedades</a></li>
            <li><a href="../gallery.php">Galería Pública</a></li>
            <li><a href="../designers.php">Diseñadores</a></li>
            <li><a href="../shop.php">Tienda</a></li>
            <li><a href="../contact.php">Contacto</a></li>
            <li><a href="../appointment.php">Citas</a></li>
            <li><a href="logout.php">Cerrar Sesión</a></li>
        </ul>
    </nav>
</header>

<main class="profile-container">
    <h2>Bienvenido, <?= htmlspecialchars($user['username']) ?>!</h2>
    <p><strong>Email:</strong> <?= htmlspecialchars($user['email']) ?></p>

    <?php if ($user['is_subscribed'] == 1): ?>
        <p class="subscribed-msg">🎉 Eres un suscriptor premium.</p>
        <a href="upload_idea.php" class="btn">Subir Idea de Diseño</a>
    <?php else: ?>
        <p class="not-subscribed-msg">No estás suscrito todavía.</p>
        <a href="subscribe.php" class="btn btn-subscribe">Suscribirse</a>
    <?php endif; ?>

    <section>
        
    </section>
</main>

<footer>
    <p>&copy; <?= date("Y") ?> ALiENS BLooD. Todos los derechos reservados.</p>
</footer>

</body>
</html>
