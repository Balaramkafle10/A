<?php
session_start();
include "connection.php";

// ✅ Correct session validation
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
    <title>User List</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">

    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }

        body {
            font-family: "Poppins", sans-serif;
            background: #f7f9fc;
        }

        

        /* ---------------- Section ---------------- */
        .information {
            padding: 100px 20px 50px;
            min-height: 100vh;
            background: var(--bg-gradient);
            background-size: cover;
            background-position: center;
            text-align: center;
        }

        h1 {
            color: #3600d8ff;
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

        /* Action Buttons */
        .action-links a {
            padding: 6px 12px;
            border-radius: 6px;
            text-decoration: none;
            font-size: 14px;
            margin: 0 5px;
            transition: var(--transition);
        }

        .update-btn {
            background: #28a745;
            color: white;
        }
        .update-btn:hover { background: #218838; }

        .delete-btn {
            background: #dc3545;
            color: white;
        }
        .delete-btn:hover { background: #c82333; }

        /* No users */
        p.no-users {
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
            .header { flex-wrap: wrap; }
            .navbar { flex-direction: column; gap: 5px; }
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

<?php include "admin_header.php"; ?>

<div class="information">
    <h1>User Information</h1>
    <?php
    $sql= "SELECT * FROM customers";
    $query = $conn->query($sql);

    if($query->num_rows > 0){
        echo "<table>";
        echo "<tr>
                <th>ID</th>
                <th>Name</th>
                <th>Address</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Username</th>
                <th>Is Admin</th>
                <th>Actions</th>
              </tr>";
        while($row = $query->fetch_assoc()){
            echo "<tr>";
            echo "<td>".$row['customer_id']."</td>";
            echo "<td>".$row['Name']."</td>";
            echo "<td>".$row['Address']."</td>";
            echo "<td>".$row['Email']."</td>";
            echo "<td>".$row['phoneNumber']."</td>";
            echo "<td>".$row['userName']."</td>";
            echo "<td>".($row['is_admin'] ? "Yes" : "No")."</td>";
            echo "<td class='action-links'>
                    <a class='update-btn' href='user_update.php?customer_id=".$row['customer_id']."'>Update</a>
                    <a class='delete-btn' href='user_delete.php?customer_id=".$row['customer_id']."'>Delete</a>
                  </td>";
            echo "</tr>";
        }
        echo "</table>";
    } else {
        echo "<p class='no-users'>No users found.</p>";
    }
    mysqli_close($conn);
    ?>
</div>

</body>
</html>
