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
<?php include 'includes/header.php'; ?>

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
</main>

<footer>
    <p>&copy; <?= date("Y") ?> ALiENS BLooD. Todos los derechos reservados.</p>
</footer>
</body>
</html>
