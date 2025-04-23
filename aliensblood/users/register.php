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
        <li><a href="../appointment.php">Citas</a></li>
        <li><a href="../legal.php">Políticas</a></li>
      </ul>
    </nav>
  </header>

  <main class="register-container">
    <h2>Crear una cuenta</h2>
    <form action="register_submit.php" method="POST">
      <label>Nombre de usuario:</label>
      <input type="text" name="username" required>

      <label>Email:</label>
      <input type="email" name="email" required>

      <label>Contraseña:</label>
      <input type="password" name="password" required>

      <button type="submit" class="btn">Registrarse</button>
    </form>
  </main>

  <footer>
    <p>&copy; <?= date("Y") ?> ALiENS BLooD. Todos los derechos reservados.</p>
  </footer>
</body>
</html>
