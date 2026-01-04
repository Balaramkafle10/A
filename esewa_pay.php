<?php
session_start();
include 'connection.php';

// Booking ID
$booking_id = isset($_GET['booking_id']) ? intval($_GET['booking_id']) : 0;
if ($booking_id <= 0) die("Invalid booking ID");

// Fetch booking
$stmt = $conn->prepare("SELECT b.*, p.price, p.location, p.duration 
                        FROM book_form b 
                        JOIN package p ON b.package_id = p.package_id 
                        WHERE b.book_id = ?");
$stmt->bind_param("i", $booking_id);
$stmt->execute();
$booking = $stmt->get_result()->fetch_assoc();
if (!$booking) die("Booking not found!");

// Amount
$total_amount = $booking['guests'] * $booking['price'];

// Transaction UUID (unique)
$transaction_uuid = "BOOK-" . $booking['book_id'] . "-" . time();

// eSewa UAT v2 URL
$esewa_url = "https://rc-epay.esewa.com.np/api/epay/main/v2/form";

// Success & failure URLs
$success_url = "http://localhost/A/esewa_success.php?booking_id={$booking_id}";
$failure_url = "http://localhost/A/esewa_faliure.php?booking_id={$booking_id}";

// Product code (merchant)
$product_code = "EPAYTEST";

// Optional charges
$tax_amount = 0;
$product_service_charge = 0;
$product_delivery_charge = 0;

// Fields to sign (must be in exact order)
$signed_fields = "total_amount,transaction_uuid,product_code";

// Create the string to sign exactly in that order
$signature_string = "total_amount=" . $total_amount . 
                    ",transaction_uuid=" . $transaction_uuid . 
                    ",product_code=" . $product_code;

// Secret key from eSewa UAT
$secret_key = "8gBm/:&EnhH.1/q";

// Generate HMAC SHA256 and Base64 encode it
$signature = base64_encode(hash_hmac('sha256', $signature_string, $secret_key, true));
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Redirecting to eSewa v2</title>
</head>
<body>
<p>Redirecting to eSewa...</p>

<form id="esewaForm" action="<?php echo $esewa_url; ?>" method="POST">
    <input type="hidden" name="amount" value="<?php echo $total_amount; ?>">
    <input type="hidden" name="tax_amount" value="<?php echo $tax_amount; ?>">
    <input type="hidden" name="total_amount" value="<?php echo $total_amount; ?>">
    <input type="hidden" name="transaction_uuid" value="<?php echo $transaction_uuid; ?>">
    <input type="hidden" name="product_code" value="<?php echo $product_code; ?>">
    <input type="hidden" name="product_service_charge" value="<?php echo $product_service_charge; ?>">
    <input type="hidden" name="product_delivery_charge" value="<?php echo $product_delivery_charge; ?>">
    <input type="hidden" name="success_url" value="<?php echo $success_url; ?>">
    <input type="hidden" name="failure_url" value="<?php echo $failure_url; ?>">
    <input type="hidden" name="signed_field_names" value="<?php echo $signed_fields; ?>">
    <input type="hidden" name="signature" value="<?php echo $signature; ?>">
    <input type="submit" value="Pay Now">
</form>

<script>
document.getElementById('esewaForm').submit();
</script>

</body>
</html>
