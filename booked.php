<?php
session_start();
include "connection.php";

// Fix session check
if (!isset($_SESSION['customer_id']) || !isset($_SESSION['is_admin']) || $_SESSION['is_admin'] != 1) {
    header('Location: login.php');
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Booked Information</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">

    <style>
        /* Reset */
        * { margin: 0; padding: 0; box-sizing: border-box; }

        body {
            font-family: "Poppins", sans-serif;
            margin: 0;
            padding: 0;
            background: #f7f9fc;
        }

        :root {
            --main-color: #1423caff;
            --accent-color: #ffd700;
            --bg-gradient: linear-gradient(rgba(97, 106, 203, 0.9), rgba(63,81,181,0.85)),
                           url(https://assets.thehansindia.com/h-upload/2019/12/27/248830-worldtour.jpg);
            --transition: 0.3s ease-in-out;
        }


        /* ---------------- Section ---------------- */
        .information {
            padding: 100px 20px 50px;
            min-height: 100vh;
            background: var(--bg-gradient);
            background-size: cover;
            background-position: center;
            text-align: center;
            margin-top:-10px;
        }

        h1 {
            color: #fff;
            margin-bottom: 30px;
            font-size: 2rem;
            text-shadow: 1px 1px 6px rgba(0,0,0,0.6);
        }

        table {
            width: 95%;
            margin: auto;
            border-collapse: collapse;
            background: #fff;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 6px 20px rgba(0,0,0,0.25);
            animation: fadeIn 0.7s ease-in-out;
        }

        th, td {
            padding: 14px 18px;
            text-align: center;
            font-size: 0.95rem;
        }

        th {
            background: var(--main-color);
            color: #fff;
            font-size: 1rem;
            letter-spacing: 1px;
        }

        tr:nth-child(even) { background: #f8f9ff; }
        tr:hover { background: rgba(26,35,126,0.1); }

        p {
            color: #fff;
            font-size: 1.1rem;
            background: rgba(0,0,0,0.5);
            display: inline-block;
            padding: 12px 18px;
            border-radius: 8px;
            margin-top: 20px;
        }

        /* Responsive */
        @media (max-width: 900px) {
            table { font-size: 0.8rem; }
            th, td { padding: 10px; }
        }

        @media (max-width: 600px) {
            h1 { font-size: 1.5rem; }
            table { width: 100%; }
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to   { opacity: 1; transform: translateY(0); }
        }
    </style>
</head>
<body>
    
<?php include "admin_header.php" ?>

<div class="information">
    <h1>Package Booked Information</h1>
    <?php
    $sql= "SELECT * FROM book_form";
    $query = $conn->query($sql);

    if($query->num_rows > 0){
        echo "<table>";
        echo "<tr>
                <th>Booking ID</th>
                <th>Name</th>
                <th>Email</th>  
                <th>Phone</th>
                <th>Address</th>
                <th>Guests</th>
                <th>Arrivals</th>
                <th>Leaving</th>
                <th>Package ID</th>
                <th>Customer ID</th>
                <th>Payment Status</th>
              </tr>";

        while($row = $query->fetch_assoc()){
            echo "<tr>";
            echo "<td>".$row['book_id']."</td>";
            echo "<td>".$row['name']."</td>";
            echo "<td>".$row['email']."</td>";
            echo "<td>".$row['phone']."</td>";
            echo "<td>".$row['address']."</td>";
            echo "<td>".$row['guests']."</td>";
            echo "<td>".$row['arrivals']."</td>";
            echo "<td>".$row['leaving']."</td>";
            echo "<td>".$row['package_id']."</td>";
            echo "<td>".$row['customer_id']."</td>";
            echo "<td>".$row['payment_status']."</td>";
            echo "</tr>";
        }
        echo "</table>";
    } else {
        echo "<p>No bookings found.</p>";
    }
    $conn->close();
    ?>
</div>

</body>
</html>
