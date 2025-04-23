<?php
session_start();
?>
<!DOCTYPE html>
<html lang="es" data-theme="dark">
<head>
    <meta charset="UTF-8">
    <title>Políticas y Términos - ALiENS BLooD</title>
    <link rel="stylesheet" href="assets/css/styles.css">
    <link rel="stylesheet" href="assets/css/legal.css">
    <script src="assets/js/legal_tema.js" defer></script>
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
                <li><a href="legal.php" class="active">Políticas</a></li>
                <?php if (isset($_SESSION['user_id'])): ?>
                    <li><a href="users/profile.php">Perfil</a></li>
                    <li><a href="users/logout.php">Cerrar sesión</a></li>
                <?php else: ?>
                    <li><a href="users/login.php">Iniciar sesión</a></li>
                    <li><a href="users/register.php">Registrarse</a></li>
                <?php endif; ?>
            </ul>
        </nav>
        <button id="toggle-theme">Cambiar Tema</button>
    </header>

    <main>
        <section class="legal-container">
            <h2>Términos y Condiciones</h2>
            <p>Bienvenido a ALiENS BLooD. Al acceder y usar nuestro sitio, aceptas cumplir con nuestras políticas. Nos reservamos el derecho de modificar estos términos en cualquier momento.</p>

            <h3>Derechos Reservados</h3>
            <p>Todo el contenido (imágenes, texto, logotipos, diseños) es propiedad de ALiENS BLooD o sus respectivos diseñadores. No está permitido el uso sin autorización.</p>

            <h3>Política de Privacidad</h3>
            <p>Recopilamos datos necesarios para el funcionamiento del sitio, como cookies y registros de usuario. No compartimos tu información sin consentimiento.</p>

            <h3>Cookies</h3>
            <p>Este sitio utiliza cookies para mejorar tu experiencia de usuario. Puedes aceptar o ignorar su uso al entrar al sitio.</p>

            <h3>Suscripciones</h3>
            <p>Los diseñadores que deseen publicar sus diseños deben suscribirse por 4,99€/mes. Esta suscripción es gestionada desde el perfil del usuario.</p>
        </section>
    </main>

    <footer>
        <p>&copy; <?= date("Y") ?> ALiENS BLooD. Todos los derechos reservados.</p>
    </footer>
</body>
</html>
