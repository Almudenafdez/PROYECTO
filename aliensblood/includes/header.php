<?php
    session_start();
?>

<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <title>ALiENS BlooD</title>
        <link rel="stylesheet" href="/assets/css/styles.css">
    </head>

    <body>

    <header>
    <h1 class="site-title">ALiENS BLooD</h1>
        <nav>
            <ul>
                <li>
                    <a href="/index.php">Inicio </a>
                </li>
                <li>
                    <a href="/designers.php">Diseñadores </a>
                </li>
                <li>
                    <a href="/shop.php">Tienda </a>
                </li>
                <li>
                    <a href="/appointment.php">Citas </a>
                </li>
                <li>
                    <a href="/legal.php">Acuerdos y políticas de la empresa </a>
                </li>

<?php if (isset($_SESSION['user_id'])):?>
    <li>
        <a href="/users/profile.php">Perfil</a>
    </li>
    <li>
        <a href="/users/logout.php">Cerrar sesión</a>
    </li>

<?php else: ?>
    <li>
        <a href="/users/login.php">Iniciar sesión</a>
    </li> 
    <li>
        <a href="/users/register.php">Registrarse</a>
    </li>

<?php endif; ?>

            </ul>
    </nav>
</header>