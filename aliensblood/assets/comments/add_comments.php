<?php
session_start();
require_once '../includes/db.php';

$data = json_decode(file_get_contents("php://input"), true);

$designId = (int) $data['design_id'];
$comment = trim($data['comment']);

if ($comment === "") {
    echo json_encode(["error" => "empty"]);
    exit;
}

$userId = $_SESSION['user_id'] ?? null;

$stmt = $pdo->prepare("
    INSERT INTO comments (design_id, comment, user_id)
    VALUES (?, ?, ?)
");
$stmt->execute([$designId, $comment, $userId]);

echo json_encode(["success" => true]);
