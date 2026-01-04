<?php
session_start();
include 'connection.php';

// Get booking ID from query
$booking_id = isset($_GET['booking_id']) ? intval($_GET['booking_id']) : 0;
if ($booking_id <= 0) die("Invalid booking ID");

// Fetch booking info
$stmt = $conn->prepare("SELECT b.*, p.price, p.location, p.duration 
                        FROM book_form b 
                        JOIN package p ON b.package_id = p.package_id 
                        WHERE b.book_id = ?");
$stmt->bind_param("i", $booking_id);
$stmt->execute();
$booking = $stmt->get_result()->fetch_assoc();

if (!$booking) die("Booking not found!");

// Total amount calculation
$total_amount = $booking['guests'] * $booking['price'];

// eSewa secret key and merchant info (UAT)
$secret_key = "8gBm/:&EnhH.1/q"; // UAT Secret Key
$product_code = "EPAYTEST";

// Get POST data from eSewa response
$transaction_uuid = $_POST['transaction_uuid'] ?? '';
$status = $_POST['status'] ?? 'NOT_FOUND';
$esewa_signature = $_POST['signature'] ?? '';
$signed_fields = $_POST['signed_field_names'] ?? '';

// Recreate signature string using signed fields
$fields_array = explode(',', $signed_fields);
$signature_string = [];
foreach ($fields_array as $field) {
    $signature_string[] = $_POST[$field] ?? '';
}
$signature_string = implode(',', $signature_string);
$transaction_uuid = $_POST['transaction_uuid'] ?? '';
$product_code = $_POST['product_code'] ?? '';
$total_amount = $_POST['total_amount'] ?? '';
$status = $_POST['status'] ?? '';
$esewa_signature = $_POST['signature'] ?? '';

$secret_key = "8gBm/:&EnhH.1/q";

/* EXACT STRING ORDER REQUIRED BY eSewa v2 */
$signature_string = 
    "transaction_uuid={$transaction_uuid}," .
    "product_code={$product_code}," .
    "total_amount={$total_amount}," .
    "status={$status}";

$generated_signature = base64_encode(
    hash_hmac('sha256', $signature_string, $secret_key, true)
);


// Generate HMAC SHA256 + Base64
$generated_signature = base64_encode(hash_hmac('sha256', $signature_string, $secret_key, true));
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>eSewa Payment Status</title>
<style>
    body {
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        background: #f5f6fa;
        margin: 0;
        padding: 0;
        display: flex;
        justify-content: center;
        align-items: center;
        min-height: 100vh;
    }
    .payment-container {
        background: #fff;
        max-width: 500px;
        width: 90%;
        padding: 2rem;
        border-radius: 15px;
        box-shadow: 0 8px 30px rgba(0,0,0,0.15);
        text-align: center;
    }
    .payment-container h2 {
        color: #2e86de;
        margin-bottom: 1rem;
    }
    .payment-container p {
        font-size: 1.1rem;
        margin: 0.5rem 0;
        color: #333;
    }
    .success {
        color: #27ae60;
        font-weight: 600;
        font-size: 1.2rem;
    }
    .failed {
        color: #e74c3c;
        font-weight: 600;
        font-size: 1.2rem;
    }
    .transaction-details {
        margin-top: 1.5rem;
        background: #f1f2f6;
        padding: 1rem;
        border-radius: 10px;
        text-align: left;
    }
    .transaction-details p {
        margin: 0.3rem 0;
    }
    .back-btn {
        display: inline-block;
        margin-top: 1.5rem;
        padding: 10px 25px;
        background: #2e86de;
        color: #fff;
        text-decoration: none;
        border-radius: 8px;
        transition: 0.3s;
    }
    .back-btn:hover {
        background: #1b4f72;
    }
</style>
</head>
<body>

<div class="payment-container">
<?php
if ($generated_signature !== $esewa_signature) {
    echo '<h2 class="failed">Invalid Payment Signature!</h2>';
    echo '<p>Possible tampering detected. Payment not verified.</p>';
} elseif ($status === 'COMPLETE') {
    // Update DB
    $update = $conn->prepare("UPDATE book_form SET payment_status = 'Paid', transaction_uuid = ? WHERE book_id = ?");
    $update->bind_param("si", $transaction_uuid, $booking_id);
    $update->execute();

    echo '<h2 class="success">Payment Successful!</h2>';
    echo '<div class="transaction-details">';
    echo "<p><strong>Booking ID:</strong> " . $booking['book_id'] . "</p>";
    echo "<p><strong>Package:</strong> " . htmlspecialchars($booking['location']) . " (" . htmlspecialchars($booking['duration']) . ")</p>";
    echo "<p><strong>Total Paid:</strong> Rs. " . $total_amount . "</p>";
    echo "<p><strong>Transaction ID:</strong> " . htmlspecialchars($transaction_uuid) . "</p>";
    echo '</div>';
} else {
    echo '<h2 class="failed">Payment Failed or Not Completed</h2>';
    echo "<p>Status: " . htmlspecialchars($status) . "</p>";
}
?>
<a class="back-btn" href="package.php">Back to Packages</a>
</div>

</body>
</html>
