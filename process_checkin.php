<?php
require_once 'config.php';
header('Content-Type: application/json');

$bookingId = $_POST['bookingId'] ?? null;

if (!$bookingId) {
    echo json_encode(['success' => false, 'message' => 'Booking ID is required']);
    exit;
}

try {
    $pdo->beginTransaction();

    // Update booking status
    $stmt = $pdo->prepare("UPDATE bookings SET status = 'Checked-in' WHERE bookingid = :bookingId");
    $stmt->execute(['bookingId' => $bookingId]);

    // Update room status
    $stmt = $pdo->prepare("UPDATE rooms SET status = 'Occupied' WHERE roomid = (SELECT roomId FROM bookings WHERE bookingid = :bookingId)");
    $stmt->execute(['bookingId' => $bookingId]);

    $pdo->commit();
    echo json_encode(['success' => true, 'message' => 'Check-in completed successfully']);
} catch (Exception $e) {
    $pdo->rollBack();
    echo json_encode(['success' => false, 'message' => 'Error during check-in: ' . $e->getMessage()]);
}
?>