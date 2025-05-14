<?php
session_start();
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Registro - ALiENS BLooD</title>
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
    <h2>Crear una cuenta</h2>
    <form id="registerForm" action="register_submit.php" method="POST">
      <label for="username">Nombre de usuario:</label>
      <input type="text" name="username" id="username" required>

      <label for="email">Email:</label>
      <input type="email" name="email" id="email" required>

      <label for="password">Contraseña:</label>
      <input type="password" name="password" id="password" required>

      <button type="submit" class="btn">Registrarse</button>
    </form>

    <p id="formMessage"></p>
  </main>

  <footer>
    <p>&copy; <?= date("Y") ?> ALiENS BLooD. Todos los derechos reservados.</p>
  </footer>

  <script src="../assets/js/register.js"></script>
</body>
</html>
