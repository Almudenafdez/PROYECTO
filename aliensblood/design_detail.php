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
            <img src="assets/img/<?= htmlspecialchars($design['image']) ?>" alt="<?= htmlspecialchars($design['title']) ?>">
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
    </main>

    <footer>
        <p>&copy; <?= date("Y") ?> ALiENS BLooD. Todos los derechos reservados.</p>
    </footer>

    <script src="assets/js/design_detail.js"></script>

</body>
</html>