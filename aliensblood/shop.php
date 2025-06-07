<?php 
session_start();
require_once 'includes/db.php';

if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

// Contar total de items (sumando cantidades)
$cartCount = 0;
foreach ($_SESSION['cart'] as $item) {
    $cartCount += $item['quantity'];
}

$designerFilter = isset($_GET['designer_id']) ? (int)$_GET['designer_id'] : 0;

try {
    $designers = $pdo->query("SELECT * FROM designers")->fetchAll();

    if ($designerFilter > 0) {
        $stmt = $pdo->prepare("SELECT * FROM designs WHERE designer_id = ?");
        $stmt->execute([$designerFilter]);
    } else {
        $stmt = $pdo->query("SELECT * FROM designs");
    }
    $designs = $stmt->fetchAll();
} catch (PDOException $e) {
    die("Error al cargar diseños: " . $e->getMessage());
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Tienda - ALiENS BLooD</title>
    <link rel="stylesheet" href="assets/css/styles.css">
    <link rel="stylesheet" href="assets/css/shop.css">
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
            <li><a href="cart.php">🛒 Carrito (<?= $cartCount ?>)</a></li>
        </ul>
    </nav>
</header>

<main>
    <section class="shop-section">
        <h2>Diseños Disponibles</h2>

        <?php if (isset($_GET['added'])): ?>
            <div class="alert-success">¡Diseño añadido al carrito!</div>
        <?php endif; ?>

        <form method="GET" class="filter-form">
            <label for="designer_id">Filtrar por diseñador:</label>
            <select name="designer_id" id="designer_id" onchange="this.form.submit()">
                <option value="0">Todos</option>
                <?php foreach ($designers as $designer): ?>
                    <option value="<?= $designer['id'] ?>" <?= $designerFilter == $designer['id'] ? 'selected' : '' ?>>
                        <?= htmlspecialchars($designer['name']) ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </form>

                <div class="designs-grid">
        <?php foreach ($designs as $design): 
            $is_nsfw = isset($design['is_nsfw']) ? $design['is_nsfw'] : 
                       (stripos($design['title'], '18') !== false || stripos($design['title'], 'adulto') !== false);
        ?>
            <div class="design-card">
                <div class="image-wrapper <?= $is_nsfw ? 'censored' : '' ?>" 
                     data-nsfw="<?= $is_nsfw ? '1' : '0' ?>" 
                     data-href="design_detail.php?id=<?= $design['id'] ?>" 
                     data-id="<?= $design['id'] ?>"
                     onclick="location.href='design_detail.php?id=<?= $design['id'] ?>'">
                    <img src="assets/img/<?= htmlspecialchars($design['image']) ?>" alt="<?= htmlspecialchars($design['title']) ?>">
                    <?php if ($is_nsfw): ?>
                        <div class="censor-overlay">+18<br>Contenido para adultos</div>
                    <?php endif; ?>
                </div>
                <h3><?= htmlspecialchars($design['title']) ?></h3>

                <?php if ($is_nsfw): ?>
                    <span class="adult-warning">+18</span>
                <?php endif; ?>

                <div class="design-actions">
                    <div class="quantity-counter">
                        <button type="button" class="qty-btn" data-action="decrement">−</button>
                        <input type="number" min="1" value="1" class="qty-input" data-design-id="<?= $design['id'] ?>">
                        <button type="button" class="qty-btn" data-action="increment">+</button>
                    </div>

                    <div class="action-buttons">
                        <a href="design_detail.php?id=<?= $design['id'] ?>" class="btn btn-details">Ver Detalles</a>
                        <form method="POST" action="cart/add.php" style="display: inline;">
                            <input type="hidden" name="design_id" value="<?= $design['id'] ?>">
                            <input type="hidden" name="quantity" value="1" class="quantity-hidden-<?= $design['id'] ?>">
                            <button type="submit" class="btn btn-cart">Añadir al Carrito</button>
                        </form>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
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

<script src="assets/js/censorship.js"></script>
<script src="assets/js/shop_counter.js"></script>

</body>
</html>