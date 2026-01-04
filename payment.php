<?php
session_start();
include 'connection.php';

// Get booking ID from query
$booking_id = isset($_GET['booking_id']) ? intval($_GET['booking_id']) : 0;
if ($booking_id <= 0) {
    header("Location: packages.php");
    exit;
}

// Fetch booking and package details
$stmt = $conn->prepare("SELECT b.*, p.location, p.duration, p.price, p.image 
                        FROM book_form b 
                        JOIN package p ON b.package_id = p.package_id 
                        WHERE b.book_id = ?");
$stmt->bind_param("i", $booking_id);
$stmt->execute();
$result = $stmt->get_result();
$booking = $result->fetch_assoc();

if (!$booking) {
    die("Invalid booking!");
}

// Calculate total price
$total_price = $booking['price'] * $booking['guests'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment</title>
    <link rel="stylesheet" href="style2.css">
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: #f0f0f0;
            margin: 0;
            padding: 0;
        }
        .payment-container {
            max-width: 700px;
            margin: 80px auto;
            background: #fff;
            padding: 2.5rem;
            border-radius: 15px;
            box-shadow: 0 6px 25px rgba(0,0,0,0.2);
            text-align: center;
        }
        h2 {
            color: #3c00a0;
            margin-bottom: 1.5rem;
        }
        .details img {
            width: 100%;
            max-width: 350px;
            border-radius: 10px;
            margin-bottom: 1rem;
        }
        .details p {
            font-size: 1.1rem;
            margin: 0.5rem 0;
        }
        .total-price {
            font-size: 1.5rem;
            font-weight: 700;
            color: #b22222;
            margin-top: 1rem;
        }
        .pay-button {
            margin-top: 2rem;
            display: inline-block;
            padding: 12px 30px;
            background: #5a1dbb;
            color: white;
            font-weight: 600;
            border-radius: 10px;
            text-decoration: none;
            transition: 0.3s;
        }
        .pay-button:hover {
            background: #3c00a0;
        }
    </style>
</head>
<body>

<?php include 'header.php'; ?>

<div class="payment-container">
    <h2>Confirm Your Payment</h2>
    <div class="details">
        <p><strong>Booking ID:</strong> <?php echo $booking['book_id']; ?></p>
        <p><strong>Package:</strong> <?php echo htmlspecialchars($booking['location']); ?> (<?php echo htmlspecialchars($booking['duration']); ?>)</p>
        <img src="uploads/<?php echo htmlspecialchars($booking['image']); ?>" alt="Package Image">
        <p><strong>Name:</strong> <?php echo htmlspecialchars($booking['name']); ?></p>
        <p><strong>Guests:</strong> <?php echo $booking['guests']; ?></p>
        <p><strong>Price per Person:</strong> Rs. <?php echo $booking['price']; ?></p>
        <p class="total-price"><strong>Total Price:</strong> Rs. <?php echo $total_price; ?></p>
    </div>
    <a class="pay-button" href="esewa_pay.php?booking_id=<?php echo $booking['book_id']; ?>">Pay with eSewa</a>
</div>

<?php include 'footer.php'; ?>

</body>
</html>
