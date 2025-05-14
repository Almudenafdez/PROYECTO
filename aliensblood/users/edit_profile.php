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

$stmt = $conn->prepare("SELECT username, email FROM users WHERE id = ?");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();

$user = $result->fetch_assoc();

$stmt->close();
$conn->close();
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Editar Perfil - ALiENS BLooD</title>
  <link rel="stylesheet" href="../assets/css/styles.css">
  <link rel="stylesheet" href="../assets/css/register.css">
</head>
<body>
  <header>
    <h1 class="site-title">ALiENS BLooD</h1>
    <nav>
      <ul>
        <li><a href="../index.php">Inicio</a></li>
        <li><a href="profile.php">Mi Perfil</a></li>
        <li><a href="logout.php">Cerrar Sesión</a></li>
      </ul>
    </nav>
  </header>

  <main class="register-container">
    <h2>Editar Perfil</h2>
    <form id="editForm" action="edit_profile_submit.php" method="POST">
      <label>Email actual:</label>
      <input type="email" name="email" value="<?= htmlspecialchars($user['email']) ?>" required>

      <label>Nueva contraseña (opcional):</label>
      <input type="password" name="new_password">

      <button type="submit" class="btn">Actualizar</button>
    </form>
  </main>

  <footer>
    <p>&copy; <?= date("Y") ?> ALiENS BLooD. Todos los derechos reservados.</p>
  </footer>

<script>
  document.getElementById('editForm').addEventListener('submit', function(e) {
    const password = document.querySelector('input[name="new_password"]').value;
    if (password && password.length < 6) {
      e.preventDefault();
      alert('La nueva contraseña debe tener al menos 6 caracteres.');
    }
  });
</script>

</body>
</html>
