<?php include '../includes/db.php'; ?>
<?php include '../includes/header.php'; ?>

<main>
    <h2 class="fade-in">Registrarse</h2>
    <form action="" method="post" onsubmit="return validarFormulario()">
        <input type="text" name="name" placeholder="Nombre completo" required>
        <input type="email" name="email" placeholder="Correo electrónico" required>
        <input type="password" name="password" placeholder="Contraseña" required>
        <button type="submit" name="register">Crear cuenta</button>
    </form>

    <?php
    if (isset($_POST['register'])) {
        $name = $conn->real_escape_string($_POST['name']);
        $email = $conn->real_escape_string($_POST['email']);
        $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

        $check = $conn->query("SELECT * FROM users WHERE email = '$email'");
        if ($check->num_rows > 0) {
            echo "<p>Ya existe una cuenta con este correo.</p>";
        } else {
            $conn->query("INSERT INTO users (name, email, password) VALUES ('$name', '$email', '$password')");
            echo "<p>Registro exitoso. Ahora puedes iniciar sesión.</p>";
        }
    }
    ?>
</main>

<?php include '../includes/footer.php'; ?>
