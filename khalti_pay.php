<?php
session_start();
include 'connection.php';

$booking_id = isset($_GET['booking_id']) ? intval($_GET['booking_id']) : 0;
if ($booking_id <= 0) {
    header("Location: packages.php");
    exit;
}

$stmt = $conn->prepare("SELECT b.*, p.price FROM book_form b JOIN package p ON b.package_id=p.package_id WHERE b.book_id=?");
$stmt->bind_param("i", $booking_id);
$stmt->execute();
$result = $stmt->get_result();
$booking = $result->fetch_assoc();

if (!$booking) {
    echo "Invalid booking!";
    exit;
}

$total_price = $booking['price'] * $booking['guests'];
?>

<!DOCTYPE html>
<html>
<head>
    <title>Khalti Payment</title>
    <script src="https://khalti.com/static/khalti-checkout.js"></script>
</head>
<body>
<button id="payment-button">Pay with Khalti</button>

<script>
var config = {
    "publicKey": "test_public_key_xxxxx", // replace with your Khalti test public key
    "productIdentity": "<?php echo $booking_id; ?>",
    "productName": "Tour Package Booking",
    "productUrl": "http://localhost/project/payment.php?booking_id=<?php echo $booking_id; ?>",
    eventHandler: {
        onSuccess(payload) {
            fetch("khalti_verify.php", {
                method: "POST",
                headers: {"Content-Type":"application/json"},
                body: JSON.stringify({
                    token: payload.token,
                    amount: payload.amount,
                    booking_id: <?php echo $booking_id; ?>
                })
            })
            .then(res=>res.json())
            .then(data=>{
                if(data.success){
                    alert("✅ Payment Successful via Khalti!");
                    window.location.href="packages.php";
                } else {
                    alert("❌ Payment Verification Failed!");
                }
            });
        },
        onError(error) {
            alert("❌ Payment Error: "+JSON.stringify(error));
        },
        onClose() { console.log("Widget closed"); }
    }
};
var checkout = new KhaltiCheckout(config);
document.getElementById("payment-button").onclick = function() {
    checkout.show({amount: <?php echo $total_price * 100; ?>});
}
</script>
</body>
</html>
