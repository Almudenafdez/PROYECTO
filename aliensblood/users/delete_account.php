<?php
session_start();
if (!isset($_SESSION['user_id'])) {
  header("Location: login.php");
  exit;
}

$host = 'localhost';
$db = 'aliensblood';
$user = 'root';
$pass = '';

$conn = new mysqli($host, $user, $pass, $db);
if ($conn->connect_error) {
  die("Conexión fallida: " . $conn->connect_error);
}

$user_id = $_SESSION['user_id'];

// Borrar usuario
$stmt = $conn->prepare("DELETE FROM users WHERE id = ?");
$stmt->bind_param("i", $user_id);
$stmt->execute();

$stmt->close();
$conn->close();

session_unset();
session_destroy();

header("Location: ../index.php");
exit;
?>
