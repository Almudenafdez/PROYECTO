<?php
session_start();
require '../includes/db.php'; // Asegúrate de que la ruta es correcta

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    if (empty($username) || empty($password)) {
        die('Por favor completa todos los campos.');
    }

    // Consulta segura con PDO
    $sql = "SELECT * FROM users WHERE username = :username";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['username' => $username]);
    $user = $stmt->fetch();

    if ($user && password_verify($password, $user['password'])) {
        // Login correcto
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['username'] = $user['username'];

        header("Location: ../users/profile.php");
        exit;
    } else {
        // --- AQUÍ AÑADIMOS EL HTML PARA CARGAR EL CSS ---
        ?>
        <!DOCTYPE html>
        <html lang="es">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">

            <!-- Aquí enlazas el CSS ciberpunk -->
            <link rel="stylesheet" href="/aliensblood/assets/css/login_submit.css">
            <title>Error de inicio de sesión</title>
        </head>

        <body>
            <div class="login-error">Usuario o contraseña incorrectos</div>
            <a class="login-back" href="login.php">Volver al inicio de sesión</a>
        </body>
        </html>
        <?php
        // ------------------------------------------------
    }
} else {
    header("Location: login.php");
    exit;
}
