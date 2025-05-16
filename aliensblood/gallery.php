<?php
session_start();
require 'includes/db.php';

try {
    $stmt = $pdo->query("SELECT * FROM ideas ORDER BY created_at DESC");
    $ideas = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    $ideas = [];
    $error = "Error al cargar la galería: " . $e->getMessage();
}
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
    <h2>Galería Pública de Diseños</h2>

    <?php if (isset($error)): ?>
        <p class="error"><?= htmlspecialchars($error) ?></p>
    <?php elseif (empty($ideas)): ?>
        <p>No hay ideas publicadas todavía.</p>
    <?php else: ?>
        <div class="gallery">
            <?php foreach ($ideas as $idea): ?>
                <div class="gallery-item">
                    <img src="<?= htmlspecialchars($idea['image_path']) ?>"
                         alt="<?= htmlspecialchars($idea['idea_text']) ?>"
                         class="thumbnail"
                         data-full="<?= htmlspecialchars($idea['image_path']) ?>">
                    <p><strong><?= htmlspecialchars($idea['idea_text']) ?></strong><br>
                    <?= htmlspecialchars($idea['author_name'] ?? '') ?></p>
                </div>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
</main>

<!-- Modal -->
<div id="image-modal" class="modal">
    <span class="close">&times;</span>
    <img class="modal-content" id="modal-image">
</div>

<script>
document.addEventListener("DOMContentLoaded", function () {
    const modal = document.getElementById("image-modal");
    const modalImg = document.getElementById("modal-image");
    const closeBtn = document.querySelector(".close");

    document.querySelectorAll(".thumbnail").forEach(img => {
        img.addEventListener("click", function () {
            modal.style.display = "block";
            modalImg.src = this.dataset.full;
        });
    });

    closeBtn.onclick = function () {
        modal.style.display = "none";
        modalImg.src = "";
    };

    window.onclick = function (event) {
        if (event.target === modal) {
            modal.style.display = "none";
            modalImg.src = "";
        }
    };
});
</script>

</body>
</html>
