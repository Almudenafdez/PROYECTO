<?php
$host = "localhost";
$user = "root";
$pass = "";
$dbname = "tatuajes";

$conn = new mysqli($host, $user, $pass, $dbname);

if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}
?>
