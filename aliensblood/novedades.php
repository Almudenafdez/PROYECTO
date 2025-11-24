<!-- NOVEDADES.PHP -->
<?php
session_start();
require_once 'includes/db.php';

// Obtener novedades con la ruta de imagen
try {
    $stmt = $pdo->query("SELECT id, obra_nombre, autor, image_path FROM novedades ORDER BY id DESC");
    $novedades = $stmt->fetchAll();
} catch (PDOException $e) {
    $error = "Error al cargar las novedades: " . $e->getMessage();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8" />
    <title>Novedades - ALiENS BLooD</title>
    <link rel="stylesheet" href="assets/css/styles.css" />
    <link rel="stylesheet" href="assets/css/novedades.css" />
    <link rel="stylesheet" href="assets/css/censorship.css" />

</head>
<body>
<header>
    <h1 class="site-title">ALiENS BLooD</h1>
    <nav>
        <ul>
            <li><a href="index.php">Inicio</a></li>
            <li><a href="novedades.php" class="active">Novedades</a></li>
            <li><a href="gallery.php">Galería Pública</a></li>
            <li><a href="shop.php">Tienda</a></li>
            <li><a href="contact.php">Contacto</a></li>
            <li><a href="appointment.php">Citas</a></li>
            <li><a href="legal.php">Políticas</a></li>
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

<main>
    <section class="design-gallery" id="gallery">
        <h2>Novedades</h2>

        <?php if (!empty($error)): ?>
            <p class="error"><?= htmlspecialchars($error) ?></p>
        <?php else: ?>
            <?php if (empty($novedades)): ?>
                <p>No hay novedades disponibles.</p>
            <?php else: ?>
                <?php foreach ($novedades as $index => $item): 
                    // Corregido: ruta correcta de la imagen
                    $imgSrc = "novedades/" . htmlspecialchars($item['image_path']);
                ?>
                    <div class="design-item" tabindex="0"
                        data-index="<?= $index ?>"
                        data-title="<?= htmlspecialchars($item['obra_nombre'], ENT_QUOTES) ?>"
                        data-author="<?= htmlspecialchars($item['autor'], ENT_QUOTES) ?>"
                        data-src="<?= $imgSrc ?>">
                        <img src="<?= $imgSrc ?>" alt="<?= htmlspecialchars($item['obra_nombre']) ?>" />
                        <h4><?= htmlspecialchars($item['obra_nombre']) ?></h4>
                        <p>Autor: <?= htmlspecialchars($item['autor']) ?></p>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        <?php endif; ?>
    </section>

    <!-- Modal -->
    <div id="imageModal" class="modal" role="dialog" aria-modal="true" aria-labelledby="modalTitle" tabindex="-1">
        <div class="modal-content">
            <span class="close-btn" aria-label="Cerrar modal">&times;</span>
            <img src="/placeholder.svg" alt="" id="modalImage" />
            <h3 id="modalTitle"></h3>
            <p id="modalAuthor"></p>
            <div class="modal-nav-buttons">
                <button id="modalPrevBtn" aria-label="Imagen anterior">Anterior</button>
                <button id="modalNextBtn" aria-label="Imagen siguiente">Siguiente</button>
            </div>
        </div>
    </div>

    <!-- Updated back button with cyberpunk class -->
    <a href="index.php" class="back-btn-cyberpunk">
        Volver al Inicio
    </a>
</main>

<footer>
    <p>&copy; <?= date("Y") ?> ALiENS BLooD. Todos los derechos reservados.</p>
</footer>
<script src="assets/js/novedades.js" defer></script>
</body>
</html>
