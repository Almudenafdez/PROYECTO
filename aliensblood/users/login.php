<?php
session_start();

// Simulamos base de datos en array (en producción usar DB)
$existingUsers = [
    'alienfan' => 'AlienFan123',
    'tattooqueen' => 'Tattoo2024'
];

$errors = [];
$success = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['login'])) {
        // Login
        $username = $_POST['username'] ?? '';
        $password = $_POST['password'] ?? '';

        if (!isset($existingUsers[$username]) || $existingUsers[$username] !== $password) {
            $errors[] = "Usuario o contraseña incorrectos.";
        } else {
            $_SESSION['user_id'] = $username;
            $success = "¡Inicio de sesión exitoso! Bienvenido, $username.";
        }

    } elseif (isset($_POST['subscribe'])) {
        // Registro para diseñadores
        $newUser = $_POST['new_username'] ?? '';
        $newPass = $_POST['new_password'] ?? '';

        if (isset($existingUsers[$newUser])) {
            $errors[] = "El usuario ya existe.";
        } elseif (!preg_match('/^(?=.*[A-Z])(?=.*\d).{8,}$/', $newPass)) {
            $errors[] = "La contraseña debe tener al menos 8 caracteres, una mayúscula y un número.";
        } else {
            $success = "Usuario registrado correctamente como diseñador. Recuerda que el servicio cuesta 4,99€/mes.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Iniciar sesión - ALiENS BLooD</title>
  <link rel="stylesheet" href="../assets/css/styles.css">
  <link rel="stylesheet" href="../assets/css/login.css">
</head>
<body>
  <header>
    <h1 class="site-title">ALiENS BLooD</h1>
    <nav>
      <ul>
        <li><a href="../index.php">Inicio</a></li>
        <li><a href="../designers.php">Diseñadores</a></li>
        <li><a href="../shop.php">Tienda</a></li>
        <li><a href="../appointment.php">Citas</a></li>
        <li><a href="../legal.php">Políticas</a></li>
      </ul>
    </nav>
  </header>

  <main class="login-page">
    <h2>Iniciar sesión</h2>

    <?php if (!empty($errors)): ?>
      <div class="error">
        <?php foreach ($errors as $error) echo "<p>$error</p>"; ?>
      </div>
    <?php endif; ?>

    <?php if ($success): ?>
      <div class="success"><?= $success ?></div>
    <?php endif; ?>

    <form method="POST" class="form-login">
      <label>Nombre de usuario:</label>
      <input type="text" name="username" required>
      <label>Contraseña:</label>
      <input type="password" name="password" required>
      <button type="submit" name="login" class="btn">Entrar</button>
    </form>

    <hr>

    <h3>¿Quieres convertirte en diseñador?</h3>
    <p>Suscríbete por solo 4,99€/mes y sube tus propios diseños.</p>

    <form method="POST" class="form-subscribe">
      <label>Nuevo usuario:</label>
      <input type="text" name="new_username" required>
      <label>Contraseña (8+ carácteres, 1 mayúscula, 1 número):</label>
      <input type="password" name="new_password" required>
      <button type="submit" name="subscribe" class="btn-subscribe">Suscribirse</button>
    </form>
  </main>

  <footer>
    <p>&copy; <?= date("Y") ?> ALiENS BLooD. Todos los derechos reservados.</p>
  </footer>
</body>
</html>
