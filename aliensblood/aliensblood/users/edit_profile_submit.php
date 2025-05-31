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
$email = trim($_POST['email']);
$new_password = trim($_POST['new_password']);

// Validar email básico
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
  echo "<script>alert('Email no válido'); window.location.href='edit_profile.php';</script>";
  exit;
}

if (!empty($new_password)) {
  // Hashear nueva contraseña si se cambia
  $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);

  $stmt = $conn->prepare("UPDATE users SET email = ?, password = ? WHERE id = ?");
  $stmt->bind_param("ssi", $email, $hashed_password, $user_id);
} else {
  // Solo actualizar email
  $stmt = $conn->prepare("UPDATE users SET email = ? WHERE id = ?");
  $stmt->bind_param("si", $email, $user_id);
}

if ($stmt->execute()) {
  echo "<script>alert('Perfil actualizado correctamente'); window.location.href='profile.php';</script>";
} else {
  echo "<script>alert('Error al actualizar'); window.location.href='edit_profile.php';</script>";
}

$stmt->close();
$conn->close();
?>
