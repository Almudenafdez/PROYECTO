<?php
session_start();
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Reservar Cita - ALiENS BLooD</title>
  <link rel="stylesheet" href="assets/css/styles.css">
  <link rel="stylesheet" href="assets/css/appointment.css">
</head>
<body>
  <header>
    <h1 class="site-title">ALiENS BLooD</h1>
    <nav>
      <ul>
        <li><a href="index.php">Inicio</a></li>
      <li><a href="novedades.php">Novedades</a></li>
        <li><a href="gallery.php">Galería Pública</a></li>
        <li><a href="designers.php">Diseñadores</a></li>
        <li><a href="shop.php">Tienda</a></li>
        <li><a href="contact.php">Contacto</a></li>
        <li><a href="legal.php">Políticas</a></li>
        <?php if (isset($_SESSION['user_id'])): ?>
          <li><a href="users/profile.php">Perfil</a></li>
          <li><a href="users/logout.php">Cerrar sesión</a></li>
        <?php else: ?>
          <li><a href="users/login.php">Iniciar sesión</a></li>
          <li><a href="users/register.php">Registrarse</a></li>
        <?php endif; ?>
      </ul>
    </nav>
  </header>

  <main class="appointment-container">
    <h2>Solicita tu cita</h2>
    <form action="appointment_submit.php" method="POST">
      <label>Nombre:</label>
      <input type="text" name="name" required>

      <label>Email:</label>
      <input type="email" name="email" required>

      <label>Fecha deseada:</label>
      <input type="date" name="date" required>

      <label>Hora deseada:</label>
      <input type="time" name="time" required>

      <label>Selecciona diseñador:</label>
      <select name="designer_id" required>
        <option value="">-- Elige un diseñador --</option>
        <option value="1">ALiEN</option>
        <option value="2">naranja</option>
        <option value="3">erderlong</option>
      </select>

      <label>COMENTA SOBRE EL TATUAJE:</label>
      <textarea name="message" placeholder="Especifica detalles o preferencias..."></textarea>

      <button type="submit" class="btn">Enviar solicitud</button>
    </form>

    <!-- BOTÓN DE INICIO -->
    <a href="index.php" style="position: fixed; bottom: 20px; right: 20px; background-color: #000; color: #fff; padding: 10px 15px; border-radius: 8px; text-decoration: none; z-index: 999;">
      Volver al Inicio
    </a>
  </main>

  <footer>
    <p>&copy; <?= date("Y") ?> ALiENS BLooD. Todos los derechos reservados.</p>
  </footer>
</body>
</html>
