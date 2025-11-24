<?php
session_start();
require_once 'includes/db.php';

if (!isset($_GET['id'])) {
    die("Diseño no especificado.");
}

$designId = (int) $_GET['id'];

try {
    // Obtener diseño y diseñador
    $stmt = $pdo->prepare("SELECT d.*, s.name AS designer_name FROM designs d JOIN designers s ON d.designer_id = s.id WHERE d.id = ?");
    $stmt->execute([$designId]);
    $design = $stmt->fetch();

    if (!$design) {
        die("Diseño no encontrado.");
    }

    // Determinar si es NSFW
    $is_nsfw = isset($design['is_nsfw']) ? $design['is_nsfw'] : 
              (stripos($design['title'], '18') !== false || stripos($design['title'], 'adulto') !== false);

    // AGREGAR NUEVO COMENTARIO
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['comment'])) {
        $comment = trim($_POST['comment']);
        if (!empty($comment)) {
            $user_id = $_SESSION['user_id'] ?? null;
            $username = $_SESSION['username'] ?? 'Anónimo';

            $stmtInsert = $pdo->prepare("INSERT INTO comments (design_id, user_id, username, comment) VALUES (?, ?, ?, ?)");
            $stmtInsert->execute([$design['id'], $user_id, $username, $comment]);

            header("Location: design_detail.php?id=" . $design['id']);
            exit;
        }
    }

    // DAR LIKE
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['like_comment_id'])) {
        $like_id = (int) $_POST['like_comment_id'];
        $stmtLike = $pdo->prepare("UPDATE comments SET likes = likes + 1 WHERE id = ?");
        $stmtLike->execute([$like_id]);

        header("Location: design_detail.php?id=" . $design['id']);
        exit;
    }

    // ELIMINAR COMENTARIO
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete_comment_id'])) {
        $delete_id = (int) $_POST['delete_comment_id'];

        $stmtCheck = $pdo->prepare("SELECT user_id FROM comments WHERE id = ?");
        $stmtCheck->execute([$delete_id]);
        $commentToDelete = $stmtCheck->fetch(PDO::FETCH_ASSOC);

        if ($commentToDelete && $commentToDelete['user_id'] == ($_SESSION['user_id'] ?? 0)) {
            $stmtDelete = $pdo->prepare("DELETE FROM comments WHERE id = ?");
            $stmtDelete->execute([$delete_id]);
        }

        header("Location: design_detail.php?id=" . $design['id']);
        exit;
    }

    // Obtener comentarios
    $stmtComments = $pdo->prepare("SELECT * FROM comments WHERE design_id = ? ORDER BY created_at DESC");
    $stmtComments->execute([$design['id']]);
    $comments = $stmtComments->fetchAll(PDO::FETCH_ASSOC);

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

        <!-- COMENTARIOS DENTRO DEL CONTENEDOR -->
        <section class="interactions">
            <div class="comments">
                <h3>Comentarios</h3>
                <ul id="commentList">
                    <?php foreach ($comments as $c): ?>
                        <li>
                            <strong><?= htmlspecialchars($c['username'] ?? 'Anónimo') ?>:</strong>
                            <?= nl2br(htmlspecialchars($c['comment'])) ?>
                            <small>(<?= $c['created_at'] ?>)</small>

                            <form method="POST" style="display:inline;">
                                <input type="hidden" name="like_comment_id" value="<?= $c['id'] ?>">
                                <button type="submit">💜 <?= $c['likes'] ?> Me gusta</button>
                            </form>

                            <?php if (($c['user_id'] ?? 0) == ($_SESSION['user_id'] ?? 0)): ?>
                                <form method="POST" style="display:inline;">
                                    <input type="hidden" name="delete_comment_id" value="<?= $c['id'] ?>">
                                    <button type="submit" onclick="return confirm('¿Eliminar comentario?')">Eliminar</button>
                                </form>
                            <?php endif; ?>
                        </li>
                    <?php endforeach; ?>
                </ul>

                <form method="POST">
                    <textarea name="comment" id="commentInput" placeholder="Escribe tu comentario..." required></textarea>
                    <button type="submit" id="addComment">Añadir comentario</button>
                </form>
            </div>
        </section>
    </section>

    <a href="index.php" style="position: fixed; bottom: 20px; right: 20px; background-color: #000; color: #fff; padding: 10px 15px; border-radius: 8px; text-decoration: none; z-index: 999;">
      Volver al Inicio
    </a>
</main>

<footer>
    <p>&copy; <?= date("Y") ?> ALiENS BLooD. Todos los derechos reservados.</p>
</footer>

<script src="assets/js/censorship.js"></script>
</body>
</html>
