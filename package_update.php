<?php
include 'connection.php';
session_start();

// ✅ Correct session check
if (!isset($_SESSION['customer_id']) || !isset($_SESSION['is_admin']) || $_SESSION['is_admin'] != 1) {
    header('Location: login.php');
    exit();
}

// Get package ID
if (!isset($_GET['id'])) {
    header('Location: package_list.php');
    exit();
}

$id = $_GET['id'];

// Fetch package data
$query = "SELECT * FROM package WHERE package_id = '$id'";
$result = mysqli_query($conn, $query);
$row = mysqli_fetch_assoc($result);

if (!$row) {
    echo "<script>alert('Package record not found.'); window.location.href='package_list.php';</script>";
    exit;
}

$image = $row['image'];
$location = $row['location'];
$duration = $row['duration'];
$price = $row['price'];

// Handle form submission
if (isset($_POST['submit'])) {
    $location = $_POST['location'];
    $duration = $_POST['duration'];
    $price = $_POST['price'];

    if (isset($_FILES['image']['name']) && $_FILES['image']['name'] != '') {
        $image = $_FILES['image']['name'];
        $target_dir = "uploads/";
        $target_file = $target_dir . basename($image);

        if (!file_exists($target_dir)) {
            mkdir($target_dir, 0777, true);
        }

        if (!move_uploaded_file($_FILES['image']['tmp_name'], $target_file)) {
            echo "<script>alert('Error uploading image.');</script>";
            exit();
        }

        $query = "UPDATE package SET image='$image', location='$location', duration='$duration', price='$price' WHERE package_id='$id'";
    } else {
        $query = "UPDATE package SET location='$location', duration='$duration', price='$price' WHERE package_id='$id'";
    }

    $result = mysqli_query($conn, $query);

    if ($result) {
        header('Location: package_list.php?msg=updated');
        exit();
    } else {
        echo "Error updating package: " . mysqli_error($conn);
    }
}

mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Update Package</title>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
<style>
:root {
    --main-color: #3214b7ff;
    --accent-color: #1a73e8;
    --hover-color: #ffd700;
    --shadow-color: rgba(0,0,0,0.25);
    --transition: 0.3s ease-in-out;
    --form-bg: rgba(255,255,255,0.9);
}

/* ---------------- Body ---------------- */
body {
    font-family: 'Poppins', sans-serif;
    margin: 0;
    background: linear-gradient(rgba(0,0,0,0.5), rgba(0,0,0,0.5)), url('https://assets.thehansindia.com/h-upload/2019/12/27/248830-worldtour.jpg') no-repeat center center fixed;
    background-size: cover;
}



/* ---------------- Form Container ---------------- */
.container {
    display: flex;
    justify-content: center;
    align-items: center;
    min-height: 90vh;
    padding: 20px;
    margin-top:-10px;
}
.form {
    background: var(--form-bg);
    padding: 40px 30px;
    border-radius: 20px;
    box-shadow: 0 8px 25px var(--shadow-color);
    width: 100%;
    max-width: 500px;
    text-align: center;
    transition: transform var(--transition);
}
.form:hover {
    transform: translateY(-5px);
}
.form h2 {
    margin-bottom: 25px;
    font-size: 2rem;
    color: var(--main-color);
}
.form img {
    border-radius: 12px;
    margin-bottom: 15px;
    box-shadow: 0 4px 15px var(--shadow-color);
}
.form input[type="text"], .form input[type="number"], .form input[type="file"] {
    width: 90%;
    padding: 12px;
    margin: 10px 0;
    border-radius: 8px;
    border: 1px solid #ccc;
    transition: var(--transition);
}
.form input[type="text"]:focus, .form input[type="number"]:focus, .form input[type="file"]:focus {
    border-color: var(--main-color);
    outline: none;
}
.form button {
    width: 95%;
    padding: 12px;
    margin-top: 20px;
    border: none;
    border-radius: 8px;
    background: var(--main-color);
    color: #fff;
    font-size: 1.1rem;
    font-weight: 600;
    cursor: pointer;
    transition: var(--transition);
}
.form button:hover {
    background: var(--accent-color);
    transform: translateY(-2px);
}

/* ---------------- Responsive ---------------- */
@media (max-width: 600px) {
    .form { padding: 30px 20px; }
}
</style>
</head>
<body>

<?php include "admin_header.php" ?>

<div class="container">
    <div class="form">
        <h2>Update Package</h2>
        <form method="post" enctype="multipart/form-data">
            <label>Current Image:</label><br>
            <img src="uploads/<?php echo htmlspecialchars($image); ?>" width="60%"><br>

            <label>New Image:</label>
            <input type="file" name="image"><br>

            <label>Location:</label>
            <input type="text" name="location" value="<?php echo htmlspecialchars($location); ?>" required><br>

            <label>Duration:</label>
            <input type="text" name="duration" value="<?php echo htmlspecialchars($duration); ?>" required><br>

            <label>Price:</label>
            <input type="number" name="price" value="<?php echo htmlspecialchars($price); ?>" required><br>

            <button type="submit" name="submit">Update</button>
        </form>
    </div>
</div>

</body>
</html>
