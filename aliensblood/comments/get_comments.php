<?php
session_start();
require_once '../includes/db.php';

if (!isset($_GET['design_id'])) {
    echo json_encode([]);
    exit;
}

$designId = (int) $_GET['design_id'];

$stmt = $pdo->prepare("
    SELECT c.id, c.comment, u.username
    FROM comments c
    LEFT JOIN users u ON c.user_id = u.id
    WHERE c.design_id = ?
    ORDER BY c.id DESC
");
$stmt->execute([$designId]);

$comments = $stmt->fetchAll(PDO::FETCH_ASSOC);

foreach ($comments as &$c) {
    if (empty($c['username'])) {
        $c['username'] = "Anónimo";
    }
}

echo json_encode($comments);
