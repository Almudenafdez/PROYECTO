<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

require '../includes/db.php';

$errors = [];
$success = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $ideaText = trim($_POST['idea_text']);
    $authorName = trim($_POST['author_name']);
    $userId = $_SESSION['user_id'];

    // Validación
    if (empty($ideaText) || empty($authorName)) {
        $errors[] = "Debes rellenar todos los campos.";
    }

    if (!isset($_FILES['idea_image']) || $_FILES['idea_image']['error'] != UPLOAD_ERR_OK) {
        $errors[] = "Debes seleccionar una imagen válida.";
    }

    if (empty($errors)) {
        // Ruta y nombre del archivo
        $uploadDir = '../assets/uploads/';
        $filename = basename($_FILES['idea_image']['name']);
        $filename = time() . "_" . preg_replace("/[^a-zA-Z0-9.\-_]/", "", $filename);
        $targetPath = $uploadDir . $filename;

        // Ruta que se guardará en la base de datos (relativa)
        $dbPath = 'assets/uploads/' . $filename;

        // Subir el archivo
        if (move_uploaded_file($_FILES['idea_image']['tmp_name'], $targetPath)) {
            // Insertar en la base de datos
            $stmt = $pdo->prepare("INSERT INTO ideas (user_id, image_path, idea_text, created_at) VALUES (?, ?, ?, NOW())");
            $stmt->execute([$userId, $dbPath, $ideaText]);

            $success = "Tu idea se ha subido correctamente.";
        } else {
            $errors[] = "Error al subir la imagen.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Subir Diseño - ALiENS BLooD</title>
  <link rel="stylesheet" href="../assets/css/styles.css">
  <link rel="stylesheet" href="../assets/css/upload_idea.css">
</head>
<body>

<header>
  <h1 class="site-title">ALiENS BLooD</h1>
  <nav>
    <ul>
      <li><a href="../index.php">Inicio</a></li>
      <li><a href="../gallery.php">Galería Pública</a></li>
      <li><a href="profile.php">Perfil</a></li>
      <li><a href="../contact.php">Contacto</a></li>
    </ul>
  </nav>
</header>

<main class="upload-container">
  <h2>Sube tu idea o diseño</h2>

  <?php if (!empty($errors)): ?>
    <div class="error">
      <?php foreach ($errors as $error): ?>
        <p><?= htmlspecialchars($error) ?></p>
      <?php endforeach; ?>
    </div>
  <?php endif; ?>

  <?php if ($success): ?>
    <div class="success">
      <p><?= htmlspecialchars($success) ?></p>
    </div>
  <?php endif; ?>

  <form action="upload_idea.php" method="POST" enctype="multipart/form-data">
    <label for="idea_text">Nombre de la obra:</label>
    <input type="text" name="idea_text" id="idea_text" required>

    <label for="author_name">Autor:</label>
    <input type="text" name="author_name" id="author_name" required>

    <label for="idea_image">Imagen del diseño:</label>
    <input type="file" name="idea_image" id="idea_image" accept="image/*" required>

    <button type="submit" class="btn">Subir Diseño</button>
  </form>
</main>

<footer>
  <p>&copy; <?= date("Y") ?> ALiENS BLooD. Todos los derechos reservados.</p>
</footer>

</body>
</html>
