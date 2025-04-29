<?php session_start(); ?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>ALiENS BLooD</title>
  <link rel="stylesheet" href="assets/css/styles.css">
  <link rel="stylesheet" href="assets/css/index.css">
  <link rel="stylesheet" href="assets/css/cart.css">
  <script src="assets/js/main.js" defer></script>
  <script src="assets/js/cookies.js" defer></script>
  <script src="assets/js/cart.js" defer></script>
</head>
<body>

<header>
  <h1 class="site-title">ALiENS BLooD</h1>
  <nav>
    <ul>
      <li><a href="index.php">Inicio</a></li>
      <li><a href="designers.php">Diseñadores</a></li>
      <li><a href="shop.php">Tienda</a></li>
      <li><a href="appointment.php">Citas</a></li>
      <li><a href="legal.php">Políticas</a></li>
      <?php if (isset($_SESSION['user_id'])): ?>
        <li><a href="users/profile.php">Perfil</a></li>
        <li><a href="users/logout.php">Cerrar sesión</a></li>
      <?php else: ?>
        <li><a href="users/login.php">Iniciar sesión</a></li>
        <li><a href="users/register.php">Registrarse</a></li>
      <?php endif; ?>
      <li class="cart-icon">
        <a href="cart.php">
          🛒 <span id="cart-count"><?= isset($_SESSION['cart']) ? count($_SESSION['cart']) : 0 ?></span>
        </a>
      </li>
    </ul>
  </nav>
</header>

<main>

  <!-- INTRODUCCIÓN -->
  <section class="intro-section">
    <h2>Bienvenido a ALiENS BLooD</h2>
    <p>Ofrecemos diseños únicos y productos de calidad.</p>
    <p><strong>DECORA TU PIEL O DECORA TU HABITACIÓN</strong></p>
    <a href="designers.php" class="btn">Ver Diseñadores</a>
    <a href="shop.php" class="btn">Ir a la Tienda</a>
    <a href="appointment.php" class="btn">Agendar Cita</a>
  </section>

  <!-- ANUNCIOS CON IMAGEN -->
  <section class="benefits">
    <div class="benefit" style="background-image: url('assets/img/icon-designs.png');">
      <div class="overlay">
        <h4>Diseños Únicos</h4>
        <p>Arte exclusivo de nuestros diseñadores independientes.</p>
      </div>
    </div>
    <div class="benefit" style="background-image: url('assets/img/icon-security.png');">
      <div class="overlay">
        <h4>Compra Segura</h4>
        <p>Pagos protegidos y atención personalizada.</p>
      </div>
    </div>
    <div class="benefit" style="background-image: url('assets/img/icon-support.png');">
      <div class="overlay">
        <h4>Atención Personalizada</h4>
        <p>Te ayudamos en cada paso: desde la compra hasta la cita.</p>
      </div>
    </div>
  </section>

  <!-- PUNTO RESERVA -->
  <section class="cta-reserva">
    <h2 class="animated-title">Haz tu reserva ya</h2>
    <a href="appointment.php" class="btn-reserva">Agendar Cita</a>
  </section>

</main>

<footer>
  <p>&copy; <?= date("Y") ?> ALiENS BLooD. Todos los derechos reservados.</p>
</footer>

<!-- Banner de cookies -->
<div id="cookie-banner" class="cookie-banner">
  <p>
    🍪 Este sitio utiliza cookies para mejorar tu experiencia. 
    <a href="legal.php" style="color: #ffd700; text-decoration: underline;">Leer más</a>
  </p>
  <div class="cookie-actions">
    <button id="accept-cookies">Aceptar</button>
    <button id="ignore-cookies">Ignorar</button>
  </div>
</div>

</body>
</html>
