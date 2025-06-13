<?php
require_once 'config.php';
header('Content-Type: application/json');

$paymentId = $_POST['paymentId'] ?? null;

if (!$paymentId) {
    echo json_encode(['success' => false, 'message' => 'Payment ID is required']);
    exit;
}

try {
    $pdo->beginTransaction();

    // Mark payment as processing
    $stmt = $pdo->prepare("UPDATE payments SET status = 'Processing' WHERE paymentsid = :paymentId");
    $stmt->execute(['paymentId' => $paymentId]);

    // Create savepoint
    $pdo->exec("SAVEPOINT PaymentProcessing");

    // Verify sufficient funds (simulated)
    $stmt = $pdo->prepare("SELECT amount FROM payments WHERE paymentsid = :paymentId");
    $stmt->execute(['paymentId' => $paymentId]);
    $amount = $stmt->fetchColumn();
    if ($amount > 100000) {
        throw new Exception('Payment amount exceeds limit');
    }

    // Complete payment
    $stmt = $pdo->prepare("UPDATE payments SET status = 'Completed', date = CURDATE() WHERE paymentsid = :paymentId");
    $stmt->execute(['paymentId' => $paymentId]);

    // Update booking status
    $stmt = $pdo->prepare("UPDATE bookings SET status = 'Confirmed' WHERE bookingid = (SELECT bookingId FROM payments WHERE paymentsid = :paymentId)");
    $stmt->execute(['paymentId' => $paymentId]);

    $pdo->commit();
    echo json_encode(['success' => true, 'message' => 'Payment processed successfully']);
} catch (Exception $e) {
    $pdo->rollBack();
    echo json_encode(['success' => false, 'message' => 'Error during payment: ' . $e->getMessage()]);
}
?>