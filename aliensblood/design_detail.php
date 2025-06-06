<?php
session_start();
require_once 'includes/db.php';

if (!isset($_GET['id'])) {
    die("Diseño no especificado.");
}

$designId = (int) $_GET['id'];

try {
    $stmt = $pdo->prepare("SELECT d.*, s.name AS designer_name FROM designs d JOIN designers s ON d.designer_id = s.id WHERE d.id = ?");
    $stmt->execute([$designId]);
    $design = $stmt->fetch();

    if (!$design) {
        die("Diseño no encontrado.");
    }
    
    // Determinar si el diseño es NSFW
    $is_nsfw = isset($design['is_nsfw']) ? $design['is_nsfw'] : 
              (stripos($design['title'], '18') !== false || stripos($design['title'], 'adulto') !== false);
} catch (PDOException $e) {
    die("Error: " . $e->getMessage());
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title><?= htmlspecialchars($design['title']) ?> - ALiENS BLooD</title>
    <link rel="stylesheet" href="assets/css/styles.css">
    <link rel="stylesheet" href="assets/css/design_detail.css">
    <link rel="stylesheet" href="assets/css/censorship.css">
</head>
<body data-design-id="<?= $design['id'] ?>">
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
            </ul>
        </nav>
    </header>

    <main>
        <section class="design-detail">
            <h2><?= htmlspecialchars($design['title']) ?></h2>
            
            <div class="image-wrapper <?= $is_nsfw ? 'censored' : '' ?>" 
                 data-nsfw="<?= $is_nsfw ? '1' : '0' ?>" 
                 data-id="<?= $design['id'] ?>">
                <img src="assets/img/<?= htmlspecialchars($design['image']) ?>" alt="<?= htmlspecialchars($design['title']) ?>">
                <?php if ($is_nsfw): ?>
                    <div class="censor-overlay">+18<br>Haz clic para confirmar tu edad</div>
                <?php endif; ?>
            </div>
            
            <?php if ($is_nsfw): ?>
                <span class="adult-warning">+18</span>
            <?php endif; ?>
            
            <p><strong>Diseñador:</strong> <?= htmlspecialchars($design['designer_name']) ?></p>
            
            <p class="design-description">
                <?= !empty($design['description']) ? htmlspecialchars($design['description']) : 'Descripción próximamente disponible.' ?>
            </p>

            <form method="POST" action="cart/add.php">
                <input type="hidden" name="design_id" value="<?= $design['id'] ?>">
                <button type="submit" class="btn btn-cart">Añadir al Carrito</button>
            </form>
        </section>

        <!-- Interacción con comentarios y me gusta -->
        <section class="interactions">
            <div class="likes">
                <button id="likeBtn">💜 Me gusta</button>
                <span id="likeCount">0</span> Me gusta
            </div>

            <div class="comments">
                <h3>Comentarios</h3>
                <ul id="commentList"></ul>
                <textarea id="commentInput" placeholder="Escribe tu comentario..."></textarea>
                <button id="addComment">Añadir comentario</button>
            </div>
        </section>
        
    <!-- BOTÓN DE INICIO-->
<a href="index.php" style="position: fixed; bottom: 20px; right: 20px; background-color: #000; color: #fff; padding: 10px 15px; border-radius: 8px; text-decoration: none; z-index: 999;">
  Volver al Inicio
</a>

    </main>

    <footer>
        <p>&copy; <?= date("Y") ?> ALiENS BLooD. Todos los derechos reservados.</p>
    </footer>

    <script src="assets/js/design_detail.js"></script>
    <script src="assets/js/censorship.js"></script>
</body>
</html>
