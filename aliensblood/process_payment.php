<?php
session_start();
header('Content-Type: application/json');

$raw = file_get_contents("php://input");
$data = json_decode($raw, true);

// Validación básica
if (
    empty($data['name']) ||
    empty($data['number']) ||
    empty($data['expiry']) ||
    empty($data['cvv'])
) {
    echo json_encode(['success' => false, 'message' => 'Todos los campos son obligatorios.']);
    exit;
}

// Simulación de verificación de tarjeta
if (preg_match('/^5[1-5][0-9]{14}$/', $data['number'])) {
    // Mastercard válida simulada
    $_SESSION['cart'] = [];
    echo json_encode(['success' => true, 'message' => 'Pago realizado correctamente. ¡Gracias por tu compra!']);
} else {
    echo json_encode(['success' => false, 'message' => 'Tarjeta inválida o no aceptada. Solo Mastercard simulada.']);
}
