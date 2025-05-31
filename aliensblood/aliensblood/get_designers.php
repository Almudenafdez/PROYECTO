<?php
require_once 'includes/db.php';

header('Content-Type: application/json');

try {
    $stmt = $pdo->query("SELECT name, image, bio FROM designers LIMIT 3");
    echo json_encode($stmt->fetchAll());
} catch (PDOException $e) {
    echo json_encode(['error' => $e->getMessage()]);
}
