<?php
session_start();
include 'connection.php';

$data = json_decode(file_get_contents("php://input"), true);
$token = $data['token'];
$amount = $data['amount'];
$booking_id = intval($data['booking_id']);

$secret_key = "test_secret_key_xxxxx"; // replace with your Khalti test secret key

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, "https://khalti.com/api/v2/payment/verify/");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query([
    "token" => $token,
    "amount" => $amount
]));
curl_setopt($ch, CURLOPT_HTTPHEADER, ["Authorization: Key $secret_key"]);

$response = curl_exec($ch);
curl_close($ch);

$res_data = json_decode($response, true);

if(isset($res_data['idx'])){
    $stmt = $conn->prepare("UPDATE book_form SET payment_status='Paid (Khalti)' WHERE book_id=?");
    $stmt->bind_param("i", $booking_id);
    $stmt->execute();
    echo json_encode(["success"=>true]);
} else {
    echo json_encode(["success"=>false]);
}
