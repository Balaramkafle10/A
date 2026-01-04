<?php
// Start session only if not already started
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
include 'connection.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Package Information</title>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">

<style>
:root {
    --main-color: #311bbeff;
    --secondary-color: #1a73e8;
    --gold: #ffd700;
    --transition: 0.3s ease-in-out;
    --shadow: rgba(0,0,0,0.2);
}



/* ---------------- Page Background ---------------- */
body {
    font-family: 'Poppins', sans-serif;
    margin: 0;
}
.main-content1 {
    min-height: 100vh;
    background-image: linear-gradient(rgba(26, 115, 232, 0.7), rgba(255, 107, 107, 0.7)), 
        url('https://assets.thehansindia.com/h-upload/2019/12/27/248830-worldtour.jpg');
    background-size: cover;
    background-position: center;
    padding: 100px 20px;
    margin-top:-10px;
}
.main-content h1 {
    text-align: center;
    color: #fff;
    font-size: 2.5rem;
    font-weight: 700;
    text-shadow: 2px 4px 8px rgba(0,0,0,0.5);
    margin-bottom: 50px;
}

/* ---------------- Package Cards ---------------- */
.package-container {
    display: flex;
    flex-wrap: wrap;
    gap: 30px;
    justify-content: center;
}
.package {
    background: #fff;
    border-radius: 12px;
    box-shadow: 0 6px 15px rgba(0,0,0,0.15);
    width: 280px;
    padding: 15px;
    text-align: center;
    transition: var(--transition);
}
.package:hover { transform: translateY(-8px); box-shadow: 0 10px 25px rgba(0,0,0,0.25); }
.package img {
    width: 100%;
    height: 180px;
    object-fit: cover;
    border-radius: 10px;
    margin-bottom: 10px;
}
.package p {
    margin: 6px 0;
    font-size: 1rem;
    font-weight: 500;
    color: #333;
}
.button1, .button2 {
    margin-top: 8px;
    padding: 8px 12px;
    border-radius: 6px;
    font-weight: 600;
}
.button2 { background: #28a745; }
.button1 { background: #dc3545; }
.button2 a, .button1 a {
    text-decoration: none;
    color: #fff;
    display: block;
}
</style>
</head>
<body>

<?php include "admin_header.php" ?>

<!-- Main Content -->
<div class="main-content1">
<div class="main-content">
    <h1>Package Information</h1>

    <div class="package-container">
<?php
try {
    $pdo = new PDO("mysql:host=$servername;dbname=$database", $userName, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = "SELECT package_id, location, duration, price, image FROM package";
    $stmt = $pdo->query($sql);

    if ($stmt->rowCount() > 0) {
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            echo "<div class='package'>";
            echo "<img src='uploads/" . htmlspecialchars($row['image']) . "' alt='Place Photo'>";
            echo "<p><b>ID:</b> " . htmlspecialchars($row['package_id']) . "</p>";
            echo "<p><b>Location:</b> " . htmlspecialchars($row['location']) . "</p>";
            echo "<p><b>Duration:</b> " . htmlspecialchars($row['duration']) . "</p>";
            echo "<p><b>Price:</b> RS " . htmlspecialchars($row['price']) . "</p>";
            echo "<div class='button2'><a href='package_update.php?id=" . urlencode($row['package_id']) . "'>Update</a></div>";
            echo "<div class='button1'><a href='package_delete.php?id=" . urlencode($row['package_id']) . "'>Delete</a></div>";
            echo "</div>";
        }
    } else { echo "<p style='color:white;'>No package records found.</p>"; }
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
$pdo = null;
?>
    </div>
</div>
</div>



</body>
</html>
