<?php
session_start();
include "connection.php";

// ✅ Admin session check
if (!isset($_SESSION['is_admin']) || $_SESSION['is_admin'] != 1) {
    header('Location: login.php');
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Messages</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <style>
         .container {
            height: 100vh;
            
            background-image: linear-gradient(rgba(100,100,237,0.6), rgba(255,143,241,0.6)), 
                              url(https://assets.thehansindia.com/h-upload/2019/12/27/248830-worldtour.jpg);

            margin-top:-10px;
            
        }
        .container h1{
            color: #fff;
        }
        body {
            font-family: "Poppins", sans-serif;
            margin: 0;
            padding: 0;
            background: #f1f2f6;
        }
        
        .container {
            padding: 40px;
        }
        h1 {
            text-align: center;
            color: #2f1db5;
            margin-bottom: 20px;
        }
        table {
            width: 95%;
            margin: auto;
            border-collapse: collapse;
            background: #fff;
            box-shadow: 0px 4px 15px rgba(0,0,0,0.2);
            border-radius: 10px;
            overflow: hidden;
        }
        table th, table td {
            padding: 14px 18px;
            text-align: center;
            border-bottom: 1px solid #ddd;
            font-size: 15px;
        }
        table th {
            background: #2f1db5;
            color: white;
        }
        table tr:nth-child(even) {
            background: #f8f8f8;
        }
        table tr:hover {
            background: rgba(47,29,181,0.1);
        }
    </style>
</head>
<body>

<?php include "admin_header.php"; ?>

<div class="container">
    <h1>Contact Messages</h1>
    <?php
    $sql = "SELECT * FROM contactus ORDER BY created_at DESC";
    $query = $conn->query($sql);

    if ($query->num_rows > 0) {
        echo "<table>";
        echo "<tr>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Message</th>
                <th>Date</th>
                <th>Customer ID</th>
              </tr>";
        while ($row = $query->fetch_assoc()) {
            echo "<tr>";
            echo "<td>".$row['id']."</td>";
            echo "<td>".$row['Name']."</td>";
            echo "<td>".$row['Email']."</td>";
            echo "<td>".$row['Message']."</td>";
            echo "<td>".$row['created_at']."</td>";
            echo "<td>".$row['customer_id']."</td>";
            echo "</tr>";
        }
        echo "</table>";
    } else {
        echo "<p style='text-align:center;color:#333;'>No messages found.</p>";
    }
    $conn->close();
    ?>
</div>

</body>
</html>
