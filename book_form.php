<?php
session_start();
include 'connection.php'; // DB connection

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['send'])) {
    $package_id = isset($_GET['package_id']) ? intval($_GET['package_id']) : 0;

    // If user is logged in
    $customer_id = $_SESSION['customer_id'] ?? 0;

    $name     = $_POST['name'];
    $email    = $_POST['email'];
    $phone    = $_POST['phone'];
    $address  = $_POST['address'];
    $guests   = $_POST['guests'];
    $arrivals = $_POST['arrivals'];
    $leaving  = $_POST['leaving'];

    $query = $conn->prepare("INSERT INTO book_form 
        (name, email, phone, address, guests, arrivals, leaving, package_id, customer_id, payment_status) 
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, 'Pending')");

    $query->bind_param("ssssissii", 
        $name, $email, $phone, $address, $guests, $arrivals, $leaving, $package_id, $customer_id);

    if ($query->execute()) {
        $booking_id = $query->insert_id;
        header("Location: payment.php?booking_id=" . $booking_id);
        exit;
    } else {
        echo "Error: " . $query->error;
    }
}
?>
