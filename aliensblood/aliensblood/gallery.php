<?php
require 'includes/db.php';
session_start();

// Obtener ideas con datos de usuario
$stmt = $pdo->query("SELECT ideas.*, users.username FROM ideas JOIN users ON ideas.user_id = users.id ORDER BY created_at DESC");
$ideas = $stmt->fetchAll();
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

<?php include 'includes/header.php'; ?>

<main class="gallery-container">
    <h2>Galería Pública</h2>
    <div class="gallery-grid">
        <?php foreach ($ideas as $idea): ?>
            <div class="gallery-item">
                <img src="<?= htmlspecialchars($idea['image_path']) ?>" 
     alt="<?= htmlspecialchars($idea['idea_text']) ?>" 
     class="thumbnail" 
     data-full="<?= htmlspecialchars($idea['image_path']) ?>"
     data-title="<?= htmlspecialchars($idea['idea_text']) ?>"
     data-author="<?= htmlspecialchars($idea['username']) ?>">

                <div class="info">
                    <strong><?= htmlspecialchars($idea['idea_text']) ?></strong><br>
                    <em>por <?= htmlspecialchars($idea['username']) ?></em>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</main>

<!-- Modal -->
<div id="image-modal" class="modal">
    <div class="modal-content-wrapper">
        <span class="close">&times;</span>
        <img class="modal-image" id="modal-image" src="" alt="Imagen seleccionada">
        <div class="modal-caption" id="modal-caption"></div>
        <div class="modal-nav">
            <button id="prev-btn">⟨ Anterior</button>
            <button id="next-btn">Siguiente ⟩</button>
        </div>
    </div>
</div>

        <!-- BOTÓN DE INICIO-->
<a href="index.php" style="position: fixed; bottom: 20px; right: 20px; background-color: #000; color: #fff; padding: 10px 15px; border-radius: 8px; text-decoration: none; z-index: 999;">
  Volver al Inicio
</a>



<?php include 'includes/footer.php'; ?>
<script src="assets/js/gallery.js" defer></script>
</body>
</html>
