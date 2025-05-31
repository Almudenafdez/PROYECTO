<?php
session_start();

// Conexión a la base de datos (ajusta según tu configuración)
$host = 'localhost';
$db = 'aliensblood';
$user = 'root';
$pass = '';  // Cambia si tienes contraseña

$conn = new mysqli($host, $user, $pass, $db);

// Comprobar conexión
if ($conn->connect_error) {
  die("Conexión fallida: " . $conn->connect_error);
}

// Recoger datos del formulario
$username = trim($_POST['username']);
$email = trim($_POST['email']);
$password = password_hash($_POST['password'], PASSWORD_DEFAULT);

// Insertar en la base de datos (prevenir inyecciones)
$stmt = $conn->prepare("INSERT INTO users (username, email, password) VALUES (?, ?, ?)");
$stmt->bind_param("sss", $username, $email, $password);

$success = $stmt->execute();

$stmt->close();
$conn->close();
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Registro Completado - ALiENS BLooD</title>
  <link rel="stylesheet" href="../assets/css/styles.css">
  <link rel="stylesheet" href="../assets/css/register.css"> <!-- Reusamos el CSS bonito -->
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
    <?php if ($success): ?>
      <h2>¡Registro Exitoso!</h2>
      <p>Bienvenido/a, <strong><?= htmlspecialchars($username) ?></strong>. Tu cuenta se ha creado correctamente.</p>
    <?php else: ?>
      <h2>Error en el registro</h2>
      <p>Hubo un problema al crear tu cuenta. Inténtalo de nuevo más tarde.</p>
    <?php endif; ?>

    <!-- Enlace corregido -->
    <a href="../index.php" class="btn">Volver al Inicio</a>
  </main>

  <footer>
    <p>&copy; <?= date("Y") ?> ALiENS BLooD. Todos los derechos reservados.</p>
  </footer>
</body>
</html>

