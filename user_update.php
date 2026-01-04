<?php
include 'connection.php';
session_start();
if (!isset($_SESSION['customer_id']) || !isset($_SESSION['is_admin']) || !$_SESSION['is_admin']) {
    header('Location: login.php');
    exit();
}

if (isset($_GET['customer_id'])) {
    $id = $_GET['customer_id'];

    $query = "SELECT * FROM customers WHERE customer_id = '$id'";
    $result = mysqli_query($conn, $query);
    $row = mysqli_fetch_assoc($result);

    if ($row) {
        $name = $row['Name'];
        $address = $row['Address'];
        $email = $row['Email'];
        $phoneNumber = $row['phoneNumber'];
        $userName = $row['userName'];
        $password = $row['Password'];
    } else {
        echo "Customer record not found.";
        exit;
    }
}

if (isset($_POST['submit'])) {
    $name = $_POST['Name'];
    $address = $_POST['Address'];
    $email = $_POST['Email'];
    $phoneNumber = $_POST['phoneNumber'];
    $userName = $_POST['userName'];
    $password = $_POST['Password'];

    $query = "UPDATE customers SET Name='$name', Address='$address', Email='$email', phoneNumber='$phoneNumber', userName='$userName', Password='$password' WHERE customer_id='$id'";
    $result = mysqli_query($conn, $query);

    if ($result) {
        echo "Customer record updated successfully.";
    } else {
        echo "Error updating customer record: " . mysqli_error($conn);
    }
}
mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Customer Update</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <link rel="stylesheet" href="style2.css">
    <style>
        .container {
            height: 100vh;
            width: 100%;
            background-image: linear-gradient(rgba(100, 100, 237, 0.8), rgba(300, 143, 241, 0.8)), url(https://assets.thehansindia.com/h-upload/2019/12/27/248830-worldtour.jpg);
            background-size: cover;
            background-position: center;
            margin-top:-10px;
        }
        
        
       
        .form {
            border-radius: 24px;
            width: 90%;
            max-width: 450px;
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -40%);
            background: lightblue;
            padding: 50px 60px 70px; 
            text-align: center;
            font-size: 15px;
        }
        .form-box {
            width: 100%;
            background: transparent;
            border: 0;
            outline: 0;
            padding: 19px 20px;
        }
        .btn {
            background-color: var(--main-color);
        }
        .user {
            text-transform: lowercase;
        }
    </style>
</head>
<body>

<?php include "admin_header.php" ?>

<div class="container">
    <div class="form">
        <h1>Update Customer Record</h1>
        <form method="POST" action="" class="form-box">
            <label for="Name">Name:</label>
            <input type="text" name="Name" value="<?php echo $name; ?>" required><br><br>
            <label for="Address">Address:</label>
            <input type="text" name="Address" value="<?php echo $address; ?>" required><br><br>
            <label for="Email">Email:</label>
            <input type="email" name="Email" value="<?php echo $email; ?>" required><br><br>
            <label for="phoneNumber">Phone Number:</label>
            <input type="text" name="phoneNumber" value="<?php echo $phoneNumber; ?>" required><br><br>
            <label for="userName">User Name:</label>
            <input type="text" class="user" name="userName" value="<?php echo $userName; ?>" required><br><br>
            <label for="Password">Password:</label>
            <input type="text" name="Password" value="<?php echo $password; ?>" required><br><br>
            <button type="submit" src="user_list.php" name="submit" class="btn">Update</button><br><br>
        </form>
    </div>
</div>
</body>
</html>
