<?php
session_start();
require_once 'includes/db.php'; 

if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    header("Location: appointment.php");
    exit;
}

// Recoge los datos del formulario
$user_id = $_SESSION['user_id'] ?? null;
$name = trim($_POST['name'] ?? '');
$email = trim($_POST['email'] ?? '');
$date = trim($_POST['date'] ?? '');
$time = trim($_POST['time'] ?? '');
$designer_id = trim($_POST['designer_id'] ?? '');
$message = trim($_POST['message'] ?? '');

// Validaciones
$errors = [];

if ($name === '') $errors[] = "Nombre requerido.";
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) $errors[] = "Email no válido.";
if ($date === '') $errors[] = "Fecha requerida.";
if ($time === '') $errors[] = "Hora requerida.";
if ($designer_id === '') $errors[] = "Selecciona un diseñador.";

if (!empty($errors)) {
    echo "<!DOCTYPE html><html lang='es'><head><meta charset='UTF-8'><title>Error</title>";
    echo "<link rel='stylesheet' href='assets/css/styles.css'>";
    echo "</head><body><main class='appointment-container'>";
    echo "<h2 style='color:cyan;'>Errores encontrados:</h2><ul style='color:white;'>";
    foreach ($errors as $error) echo "<li>$error</li>";
    echo "</ul><a href='appointment.php' style='color:violet;'>Volver</a></main></body></html>";
    exit;
}

// Insertar en la base de datos
try {
    $stmt = $pdo->prepare("INSERT INTO appointments (user_id, designer_id, date, time, message, created_at)
                           VALUES (?, ?, ?, ?, ?, NOW())");
    $stmt->execute([$user_id, $designer_id, $date, $time, $message]);
} catch (PDOException $e) {
    die("Error al guardar la cita: " . $e->getMessage());
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Cita Confirmada - ALiENS BLooD</title>
  <link rel="stylesheet" href="assets/css/styles.css">
  <link rel="stylesheet" href="assets/css/appointment.css">
</head>
<body>
  <header>
    <h1 class="site-title">ALiENS BLooD</h1>
  </header>

  <main class="appointment-container">
    <h2>¡Tu cita ha sido reservada!</h2>
    <p>Gracias <strong><?= htmlspecialchars($name) ?></strong>, has solicitado una cita para el <strong><?= htmlspecialchars($date) ?></strong> a las <strong><?= htmlspecialchars($time) ?></strong>.</p>
    <p>Te contactaremos al correo <strong><?= htmlspecialchars($email) ?></strong>.</p>
    <?php if ($message): ?>
      <p><em>TATUAJE COMENTARIO:</em> <?= nl2br(htmlspecialchars($message)) ?></p>
    <?php endif; ?>

    <a href="index.php" class="btn" style="margin-top: 20px;">Volver al inicio</a>
  </main>

  <footer>
    <p>&copy; <?= date("Y") ?> ALiENS BLooD. Todos los derechos reservados.</p>
  </footer>
</body>
</html>
