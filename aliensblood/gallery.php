<?php
session_start();
require 'includes/db.php';
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Galería Pública - ALiENS BLooD</title>
  <link rel="stylesheet" href="assets/css/styles.css">
  <link rel="stylesheet" href="assets/css/gallery.css">
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
      <li><a href="/aliensblood/users/profile.php">Perfil</a></li>
      <?php if (isset($_SESSION['user_id'])): ?>
                <li><a href="users/profile.php">Perfil</a></li>
                <li><a href="users/logout.php">Cerrar sesión</a></li>
            <?php else: ?>
                <li><a href="users/login.php">Iniciar sesión</a></li>
                <li><a href="users/register.php">Registrarse</a></li>
            <?php endif; ?>
        </ul>
  </nav>
</header>

<main class="gallery-container">
  <h2>Galería de Diseños Subidos</h2>

  <div class="gallery-grid">
    <?php
    $stmt = $pdo->query("SELECT ideas.*, users.username FROM ideas JOIN users ON ideas.user_id = users.id ORDER BY created_at DESC");

    while ($row = $stmt->fetch()):
        // Asegurarse que image_path no tenga error de ruta
        $imagePath = htmlspecialchars($row['image_path']);
        $ideaText = htmlspecialchars($row['idea_text']);
        $author = htmlspecialchars($row['username']);

        // Si falta la ruta correcta, mostrar texto alternativo
        if (!empty($imagePath) && file_exists($imagePath)):
    ?>
      <div class="gallery-item">
        <img src="<?= $imagePath ?>" alt="<?= $ideaText ?>">
        <p class="idea-text"><?= $ideaText ?></p>
        <p class="author-text">Autor: <?= $author ?></p>
      </div>
    <?php else: ?>
      <div class="gallery-item">
        <p>Imagen no disponible</p>
        <p class="idea-text"><?= $ideaText ?></p>
        <p class="author-text">Autor: <?= $author ?></p>
      </div>
    <?php endif; endwhile; ?>
  </div>
</main>

<footer>
  <p>&copy; <?= date("Y") ?> ALiENS BLooD. Todos los derechos reservados.</p>
</footer>
</body>
</html>
