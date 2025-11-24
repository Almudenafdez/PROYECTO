<!-- DESIGNERS.PHP -->
<?php
session_start();
require_once 'includes/db.php';

// Solo 3 diseñadores para el slider
$designers = $pdo->query("SELECT * FROM designers LIMIT 3")->fetchAll();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8" />
    <title>Diseñadores - ALiENS BLooD</title>
    <link rel="stylesheet" href="assets/css/styles.css" />
    <link rel="stylesheet" href="assets/css/designers.css" />
    <link rel="stylesheet" href="assets/css/censorship.css" />
</head>
<body>
    <header>
        <h1 class="site-title">ALiENS BLooD</h1>
        <nav>
            <ul>
                <li><a href="index.php">Inicio</a></li>
                <li><a href="novedades.php">Novedades</a></li>
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
        <section class="slider-section">
            <h2>Diseñadores Destacados</h2>

            <div id="slider-container">
                <button id="prev-btn" class="slider-btn" aria-label="Anterior">
                    <svg viewBox="0 0 24 24" width="24" height="24" fill="white">
                        <path d="M15.41 7.41L14 6l-6 6 6 6 1.41-1.41L10.83 12z"/>
                    </svg>
                </button>

                <div id="slider">
                    <?php foreach ($designers as $index => $designer): ?>
                        <div class="slide<?= $index === 0 ? ' active' : '' ?>">
                            <img src="assets/img/<?= htmlspecialchars($designer['image']) ?>" alt="<?= htmlspecialchars($designer['name']) ?>">
                            <h3><?= htmlspecialchars($designer['name']) ?></h3>
                            <p><?= htmlspecialchars($designer['bio']) ?></p>
                        </div>
                    <?php endforeach; ?>
                </div>

                <button id="next-btn" class="slider-btn" aria-label="Siguiente">
                    <svg viewBox="0 0 24 24" width="24" height="24" fill="white">
                        <path d="M8.59 16.59L13.17 12 8.59 7.41 10 6l6 6-6 6z"/>
                    </svg>
                </button>
            </div>
        </section>

        <section class="design-gallery">
    <h2>Galería de Diseños</h2>
    <?php
    try {
        $stmt = $pdo->query("SELECT d.*, des.name as designer_name 
                             FROM designs d
                             JOIN designers des ON d.designer_id = des.id
                             ORDER BY d.designer_id");
        while ($row = $stmt->fetch()):
            $is_nsfw = $row['is_nsfw'] ?? 0; 
            ?>
            <div class="design-item">
                <div class="image-wrapper <?= $is_nsfw ? 'censored' : '' ?>" 
                     data-nsfw="<?= $is_nsfw ?>" 
                     data-image="assets/img/<?= htmlspecialchars($row['image'], ENT_QUOTES) ?>"
                     data-title="<?= htmlspecialchars($row['title'], ENT_QUOTES) ?>"
                     data-designer="<?= htmlspecialchars($row['designer_name'], ENT_QUOTES) ?>"
                     data-href="shop.php?design_id=<?= $row['id'] ?>"
                     data-id="<?= $row['id'] ?>"
                     style="cursor:pointer;">
                    <img src="assets/img/<?= htmlspecialchars($row['image'], ENT_QUOTES) ?>" alt="<?= htmlspecialchars($row['title'], ENT_QUOTES) ?>">
                    <?php if ($is_nsfw): ?>
                        <div class="censor-overlay">+18<br>Haz clic para confirmar tu edad</div>
                    <?php endif; ?>
                </div>
                <h4><?= htmlspecialchars($row['title']) ?></h4>
                <p>Autor: <?= htmlspecialchars($row['designer_name']) ?></p>
            </div>
        <?php endwhile;
    } catch (PDOException $e) {
        echo "<p class='error'>Error al cargar los diseños: " . htmlspecialchars($e->getMessage()) . "</p>";
    }
    ?>
</section>


       <!-- Modal -->
<div id="imageModal" role="dialog" aria-modal="true" aria-labelledby="modalTitle" tabindex="-1">
    <div class="modal-content">
        <span class="close-btn" aria-label="Cerrar modal">&times;</span>
        <img src="" alt="" id="modalImage" />
        <h3 id="modalTitle"></h3>
        <p id="modalDesigner"></p>

        <div class="modal-nav-buttons">
            <button id="modalPrevBtn" aria-label="Imagen anterior">Anterior</button>
            <button id="modalNextBtn" aria-label="Imagen siguiente">Siguiente</button>
        </div>
    </div>
</div>




        <a href="index.php" style="position: fixed; bottom: 20px; right: 20px; background-color: #000; color: #fff; padding: 10px 15px; border-radius: 8px; text-decoration: none; z-index: 999;">
            Volver al Inicio
        </a>
    </main>

    <footer>
        <p>&copy; <?= date("Y") ?> ALiENS BLooD. Todos los derechos reservados.</p>
    </footer>

    <script src="assets/js/slider.js"></script>
    <script src="assets/js/designers_modal.js"></script>
    <script src="assets/js/censorship.js"></script>
</body>
</html>
