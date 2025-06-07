<?php session_start(); ?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Contacto - ALiENS BLooD</title>
    <link rel="stylesheet" href="assets/css/styles.css">
    <link rel="stylesheet" href="assets/css/contact.css">
</head>
<body>
 <nav>
    <ul>
        <li><a href="index.php">Inicio</a></li>
      <li><a href="novedades.php">Novedades</a></li>
        <li><a href="gallery.php">Galería Pública</a></li>
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
    </ul>
</nav>

<main>
    <section class="contact-wrapper">
        <div class="contact-image">
            <img src="assets/img/background_2.png" alt="Imagen contacto">
        </div>

        <div class="contact-info">
            <h2>Contacta con ALiENS BLooD</h2>
            <p>Estamos disponibles para consultas y citas. Contáctanos por los siguientes medios:</p>

            <ul class="contact-list">
                <li><strong>Teléfono:</strong> <a href="tel:+34615681863">+34 615 681 863</a></li>
                <li><strong>Email:</strong> <a href="mailto:gunterheronhatsu@gmail.com">gunterheronhatsu@gmail.com</a></li>
            </ul>

            <h3>Síguenos en redes sociales</h3>
            <ul class="social-list">
                <li><a href="https://www.instagram.com/tinyalienspiece/" target="_blank">Instagram</a></li>
                <li><a href="https://www.tiktok.com/@dark.alien182" target="_blank">TikTok</a></li>
            </ul>
        </div>
    </section>

    <!-- BOTÓN DE INICIO-->
<a href="index.php" style="position: fixed; bottom: 20px; right: 20px; background-color: #000; color: #fff; padding: 10px 15px; border-radius: 8px; text-decoration: none; z-index: 999;">
  Volver al Inicio
</a>

</main>

<footer>
    <p>&copy; <?= date("Y") ?> ALiENS BLooD. Todos los derechos reservados.</p>
</footer>
</body>
</html>
