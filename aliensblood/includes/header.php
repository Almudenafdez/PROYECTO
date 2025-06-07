<?php if (session_status() === PHP_SESSION_NONE) session_start(); ?>
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
