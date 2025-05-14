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
        echo "<p style='color: red;'>Usuario o contraseña incorrectos</p>";
        echo "<a href='login.php'>Volver a intentarlo</a>";
    }
} else {
    header("Location: login.php");
    exit;
}
