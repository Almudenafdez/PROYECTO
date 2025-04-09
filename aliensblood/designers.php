<?php
session_start();
require_once 'includes/db.php';

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Diseñadores - ALiENS BLooD</title>
    <link rel="stylesheet" href="assets/css/styles.css">
</head>
<body>
    <header>
        <h1 class="site-title">ALiENS BLooD</h1>
        <nav>
            <ul>
                <li><a href="index.php">Inicio</a></li>
                <li><a href="designers.php" class="active">Diseñadores</a></li>
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
    </header>

    <main>
        <section class="designer-list">
            <h2>Diseñadores de ALiENS BLooD</h2>
            <div class="designers-grid">
                <?php
                try {
                    $stmt = $pdo->query("SELECT * FROM designers");
                    while ($designer = $stmt->fetch()):
                ?>
                    <div class="designer-card">
                        <img src="assets/img/<?= htmlspecialchars($designer['image']) ?>" alt="<?= htmlspecialchars($designer['name']) ?>">
                        <h3><?= htmlspecialchars($designer['name']) ?></h3>
                        <p><?= htmlspecialchars($designer['bio']) ?></p>
                        <a href="appointment.php?designer_id=<?= $designer['id'] ?>" class="btn">Agendar Cita</a>
                    </div>
                <?php
                    endwhile;
                } catch (PDOException $e) {
                    echo "<p class='error'>Error al cargar diseñadores: " . $e->getMessage() . "</p>";
                }
                ?>
            </div>
        </section>
    </main>

    <footer>
        <p>&copy; <?= date("Y") ?> ALiENS BLooD. Todos los derechos reservados.</p>
    </footer>
</body>
</html>
