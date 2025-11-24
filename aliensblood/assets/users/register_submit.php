<?php
session_start();

// Conexión a la base de datos
$host = 'localhost';
$db = 'aliensblood';
$user = 'root';
$pass = '';

$conn = new mysqli($host, $user, $pass, $db);
if ($conn->connect_error) {
  die("Conexión fallida: " . $conn->connect_error);
}

// Función para validar la contraseña
function is_valid_password($password) {
  return (
    strlen($password) >= 8 &&
    preg_match('/[A-Z]/', $password) &&
    preg_match('/[a-z]/', $password) &&
    preg_match('/\d/', $password) &&
    preg_match('/[\W_]/', $password)
  );
}

// Recoger y sanitizar datos
$username = trim($_POST['username'] ?? '');
$email = trim($_POST['email'] ?? '');
$password_raw = $_POST['password'] ?? '';
$password_hash = password_hash($password_raw, PASSWORD_DEFAULT);

// Validaciones del servidor
$errors = [];

if (empty($username) || empty($email) || empty($password_raw)) {
  $errors[] = "Todos los campos son obligatorios.";
}

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
  $errors[] = "El correo electrónico no es válido.";
}

if (!is_valid_password($password_raw)) {
  $errors[] = "La contraseña debe tener al menos 8 caracteres, una letra mayúscula, una minúscula, un número y un carácter especial.";
}

// Verificar si el nombre de usuario ya existe
if (empty($errors)) {
  $check_stmt = $conn->prepare("SELECT id FROM users WHERE username = ?");
  $check_stmt->bind_param("s", $username);
  $check_stmt->execute();
  $check_stmt->store_result();

  if ($check_stmt->num_rows > 0) {
    $errors[] = "El nombre de usuario ya está en uso. Elige otro.";
  }

  $check_stmt->close();
}

// Si no hay errores, insertar
if (empty($errors)) {
  $stmt = $conn->prepare("INSERT INTO users (username, email, password) VALUES (?, ?, ?)");
  $stmt->bind_param("sss", $username, $email, $password_hash);
  $success = $stmt->execute();
  $stmt->close();
} else {
  $success = false;
}

$conn->close();
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Registro Completado - ALiENS BLooD</title>
  <link rel="stylesheet" href="../assets/css/styles.css">
  <link rel="stylesheet" href="../assets/css/register.css">
</head>
<body>
  <header>
    <h1 class="site-title">ALiENS BLooD</h1>
    <nav>
      <ul>
        <li><a href="../index.php">Inicio</a></li>
        <li><a href="../designers.php">Diseñadores</a></li>
        <li><a href="../shop.php">Tienda</a></li>
        <li><a href="contact.php">Contacto</a></li>
        <li><a href="../appointment.php">Citas</a></li>
        <li><a href="../legal.php">Políticas</a></li>
      </ul>
    </nav>
  </header>

  <main class="register-container">
    <?php if (!empty($errors)): ?>
      <h2>Error en el registro</h2>
      <ul>
        <?php foreach ($errors as $error): ?>
          <li style="color: #ff6f6f"><?= htmlspecialchars($error) ?></li>
        <?php endforeach; ?>
      </ul>
      <a href="register.php" class="back-btn">Volver al registro</a>
    <?php elseif ($success): ?>
      <h2>¡Registro Exitoso!</h2>
      <p>Bienvenido/a, <strong><?= htmlspecialchars($username) ?></strong>. Tu cuenta se ha creado correctamente.</p>
      <a href="../index.php" class="btn">Volver al Inicio</a>
    <?php else: ?>
      <h2>Error desconocido</h2>
      <p>Hubo un problema al crear tu cuenta. Inténtalo de nuevo más tarde.</p>
      <a href="register.php" class="back-btn">Volver al registro</a>
    <?php endif; ?>
  </main>

  <footer>
    <p>&copy; <?= date("Y") ?> ALiENS BLooD. Todos los derechos reservados.</p>
  </footer>
</body>
</html>
