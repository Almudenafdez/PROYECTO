<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

require '../includes/db.php';

// Obtener datos del usuario actual (añadimos avatar próximamente si lo deseas)
$user_id = $_SESSION['user_id'];
$stmt = $pdo->prepare("SELECT username, email, is_subscribed FROM users WHERE id = ?");
$stmt->execute([$user_id]);
$user = $stmt->fetch();

if (!$user) {
    echo "Usuario no encontrado.";
    exit;
}

// ESTADÍSTICAS: cuántas ideas subió este usuario
$stmt2 = $pdo->prepare("SELECT COUNT(*) FROM design_ideas WHERE user_id = ?");
$stmt2->execute([$user_id]);
$idea_count = $stmt2->fetchColumn();
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

<!-- BANNER HOLOGRÁFICO -->
<div class="profile-banner">
    <h2 class="banner-text">Perfil de <?= htmlspecialchars($user['username']) ?></h2>
</div>

<main class="profile-container">

    <!-- AVATAR -->
    <div class="avatar-wrapper">
        <img src="../assets/img/default_avatar.png" class="avatar-img" alt="avatar">
        <p class="avatar-edit">Cambiar Avatar</p>
    </div>

    <!-- TARJETA DE IDENTIDAD CIBERPUNK -->
    <div class="cyber-id-card">
        <h2><?= htmlspecialchars($user['username']) ?></h2>
        <p><strong>Email:</strong> <?= htmlspecialchars($user['email']) ?></p>

        <?php if ($user['is_subscribed'] == 1): ?>
            <p class="subscribed-msg">✔ Usuario Premium</p>
        <?php else: ?>
            <p class="not-subscribed-msg">No eres premium</p>
        <?php endif; ?>
    </div>

    <!-- ZONA DE ARTISTA -->
    <section class="artist-zone">
        <h3>Zona de Artista</h3>

        <?php if ($user['is_subscribed'] == 1): ?>
            <a href="upload_idea.php" class="btn">Subir Idea</a>
        <?php else: ?>
            <a href="subscribe.php" class="btn btn-subscribe">Hazte Premium</a>
        <?php endif; ?>

</main>

<footer>
    <p>&copy; <?= date("Y") ?> ALiENS BLooD. Todos los derechos reservados.</p>
</footer>

</body>
</html>
