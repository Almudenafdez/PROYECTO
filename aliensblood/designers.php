<?php
session_start();
require_once 'includes/db.php';

// Consulta de solo 3 diseñadores
$designers = $pdo->query("SELECT * FROM designers LIMIT 3")->fetchAll();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Diseñadores - ALiENS BLooD</title>
    <link rel="stylesheet" href="assets/css/styles.css">
</head>
<body>
    <header>
        <!-- Lista de todas las páginas existentes -->
        <h1 class="site-title">ALiENS BLooD</h1>
        <nav>
            <ul>
                <li><a href="index.php">Inicio</a></li>
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


                <!-- SECCIÓN 1: slider automático que pasa imágenes desde la base de datos-->
    <main>
        <section class="slider-section">
            <h2>Diseñadores Destacados</h2>
                <div id="slider-container">
                <div id="slider">
                <?php foreach ($designers as $index => $designer): ?>
                    <div class="slide<?= $index === 0 ? ' active' : '' ?>">
                    <img src="assets/img/<?= htmlspecialchars($designer['image']) ?>" alt="<?= htmlspecialchars($designer['name']) ?>">
                    <h3><?= htmlspecialchars($designer['name']) ?></h3>
                    <p><?= htmlspecialchars($designer['bio']) ?></p>
                </div>
                <?php endforeach; ?>
                <div id="slider-container">
            <button id="prev-btn" class="slider-btn">
            <svg viewBox="0 0 24 24"><path d="M15.41 7.41L14 6l-6 6 6 6 1.41-1.41L10.83 12z"/></svg>
            </button>
                <div id="slider"></div>
            <button id="next-btn" class="slider-btn">
            <svg viewBox="0 0 24 24"><path d="M8.59 16.59L13.17 12 8.59 7.41 10 6l6 6-6 6z"/></svg>
            </button>
                </div>
        </section>


                <!-- SECCIÓN 2: todos los diseños por diseñador -->
        <section class="design-gallery">
            <h2>Galería de Diseños</h2>
                <?php
                    try {
                    $stmt = $pdo->query("SELECT d.*, des.name as designer_name 
                        FROM designs d
                        JOIN designers des ON d.designer_id = des.id
                        ORDER BY d.designer_id");
                        while ($row = $stmt->fetch()): ?>
       <div class="design-item">
            <a href="shop.php?design_id=<?= $row['id'] ?>">
                <img src="assets/img/<?= htmlspecialchars($row['image']) ?>" alt="<?= htmlspecialchars($row['title']) ?>">
            </a>
                <h4><?= htmlspecialchars($row['title']) ?></h4>
                <p>Autor: <?= htmlspecialchars($row['designer_name']) ?></p>
        </div>
                <?php endwhile;
                } catch (PDOException $e) {
                echo "<p class='error'>Error al cargar los diseños: " . $e->getMessage() . "</p>";
                }
                ?>
        </section>

    </main>






                <!-- Pie de página -->
    <footer>
        <p>&copy; <?= date("Y") ?> ALiENS BLooD. Todos los derechos reservados.</p>
    </footer>
                


                <!-- SCRIPT SLIDER-->
    <script src="assets/js/slider.js"></script>
</body>
</html>