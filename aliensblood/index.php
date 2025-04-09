<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>ALiENS BLooD</title>
    <link rel="stylesheet" href="assets/css/styles.css">
    <script src="assets/js/main.js" defer></script>
</head>
<body>
<header>
    <h1 class="site-title">ALiENS BLooD</h1>
    <nav>
        <ul>
            <li><a href="/index.php">Inicio</a></li>
            <li><a href="designers.php">Diseñadores</a></li>
            <li><a href="/shop.php">Tienda</a></li>
            <li><a href="/appointment.php">Citas</a></li>
            <li><a href="/legal.php">Políticas</a></li>
            <?php if (isset($_SESSION['user_id'])): ?>
                <li><a href="/users/profile.php">Perfil</a></li>
                <li><a href="/users/logout.php">Cerrar sesión</a></li>
            <?php else: ?>
                <li><a href="/users/login.php">Iniciar sesión</a></li>
                <li><a href="/users/register.php">Registrarse</a></li>
            <?php endif; ?>
        </ul>
    </nav>
</header>

<main>
    <section class="fade-in">
        <h2>Bienvenido a ALiENS BLooD</h2>
        <p>Explora los mejores artistas, productos y diseños exclusivos con estética alien punk.</p>
        <a href="designers.php" class="btn">Ver Diseñadores</a>
        <a href="/shop.php" class="btn">Ir a la Tienda</a>
        <a href="/appointment.php" class="btn">Agendar Cita</a>
    </section>
</main>

<footer>
    <p>&copy; <?php echo date("Y"); ?> ALiENS BLooD. Todos los derechos reservados.</p>
</footer>

<!-- Cookie banner -->
<div id="cookie-banner" class="cookie-banner">
    Este sitio usa cookies para mejorar tu experiencia.
    <button onclick="aceptarCookies()">Aceptar</button>
</div>
</body>
</html>
