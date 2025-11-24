<?php
session_start();
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Iniciar Sesión - ALiENS BLooD</title>
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
        <li><a href="contact.php">Contacto</a></li>
        <li><a href="../appointment.php">Citas</a></li>
        <li><a href="../legal.php">Políticas</a></li>
      </ul>
    </nav>
  </header>

  <main class="login-container">
    <h2>Inicia Sesión</h2>
    <form id="loginForm" action="login_submit.php" method="POST">
      <label>Nombre de usuario:</label>
      <input type="text" name="username" required>

      <label>Contraseña:</label>
      <input type="password" name="password" required>
      <button type="submit" class="btn">Entrar</button>
    </form>

    <div class="login-links">
      <a href="register.php">¿No tienes cuenta? Regístrate</a> |
      <a href="../index.php">Volver al inicio</a>
    </div>
  </main>

  <script src="../assets/js/login.js"></script>

  <footer>
    <p>&copy; <?= date("Y") ?> ALiENS BLooD. Todos los derechos reservados.</p>
  </footer>
</body>
</html>

