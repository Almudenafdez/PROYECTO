<?php
session_start();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Política y Términos - ALiENS BLooD</title>
    <link rel="stylesheet" href="assets/css/legal.css">
    <script src="assets/js/legal_tema.js" defer></script>
</head>
<body class="dark-mode">
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
            <?php if (isset($_SESSION['user_id'])): ?>
                <li><a href="users/profile.php">Perfil</a></li>
                <li><a href="users/logout.php">Cerrar sesión</a></li>
            <?php else: ?>
                <li><a href="users/login.php">Iniciar sesión</a></li>
                <li><a href="users/register.php">Registrarse</a></li>
            <?php endif; ?>
        </ul>
    </nav>
<select id="theme-select">
    <option value="dark-mode" selected>Oscuro</option>
    <option value="light-mode">Claro</option>
    <option value="blue-mode">Oscuro-Light</option>
    <option value="green-mode">Antiguo</option>
</select>

</header>

<main>
    <section class="legal-section">
        <h2>Política de Privacidad y Términos de Uso</h2>

        <article>
            <h3>Privacidad</h3>
            <p>Respetamos tu privacidad. No compartimos tu información con terceros salvo autorización expresa o requerimiento legal.</p>
        </article>

        <article>
            <h3>Cookies</h3>
            <p>Este sitio utiliza cookies para mejorar tu experiencia de navegación. Puedes aceptar o ignorar el aviso inicial.</p>
        </article>

        <article>
            <h3>Derechos de Autor</h3>
            <p>Todo contenido en ALiENS BLooD está protegido por derechos de autor. No está permitido el uso sin permiso expreso.</p>
        </article>

        <article>
            <h3>Condiciones de Uso</h3>
            <p>El uso del sitio implica aceptación de nuestras condiciones. Nos reservamos el derecho de modificar términos sin previo aviso.</p>
        </article>
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
