<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);

include 'connection.php';

$success = '';
$error = '';

// Make sure the user is logged in

if (!isset($_SESSION['customer_id'])) {
    echo "
    <script>
        alert('Login to contact us.');
        window.location.href = 'login.php';
    </script>
    ";
    exit();
}


// Get the logged-in customer ID
$customer_id = $_SESSION['customer_id'];

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $name    = trim($_POST['name'] ?? '');
    $email   = trim($_POST['email'] ?? '');
    $message = trim($_POST['message'] ?? '');

    if ($name === '' || $email === '' || $message === '') {
        $error = "All fields are required.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = "Invalid email format.";
    } else {
        // Insert with customer_id
        $query = "INSERT INTO contactus (customer_id, Name, Email, Message) VALUES (?, ?, ?, ?)";
        $stmt = $conn->prepare($query);
        if ($stmt === false) {
            $error = "Prepare failed: " . $conn->error;
        } else {
            $stmt->bind_param("isss", $customer_id, $name, $email, $message);
            if ($stmt->execute()) {
                $stmt->close();
                $conn->close();
                header("Location: contact.php?success=1");
                exit();
            } else {
                $error = "Execute failed: " . $stmt->error;
            }
            $stmt->close();
        }
    }
}

if (isset($_GET['success']) && $_GET['success'] == '1') {
    $success = "Message sent successfully!";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width,initial-scale=1">
<title>Contact Us</title>

<style>
:root {
    --main-color: #6a0dad;
    --secondary-color: #9c27b0;
    --accent-color: #ff6b6b;
    --light-bg: #ffffff;
    --transition: 0.3s ease-in-out;
}

/* Header icons */
.header .icons a {
    font-size: 1rem;
    color: #fff;
    cursor: pointer;
    margin-right: 1.5rem;
    transition: transform var(--transition), color var(--transition);
}
.header .icons a:hover {
    color: var(--accent-color);
    transform: scale(1.2);
}

/* Full page login background */
.login-container {
    height: 100vh;
    width: 100%;
    background-image: linear-gradient(rgba(106, 0, 173, 0.7), rgba(156, 39, 176, 0.7)), 
                      url('https://assets.thehansindia.com/h-upload/2019/12/27/248830-worldtour.jpg');
    background-size: cover;
    background-position: center;
    display: flex;
    align-items: center;
    justify-content: center;
}

/* Login form box */
.form-box {
    border-radius: 30px;
    width: 90%;
    max-width: 450px;
    background: rgba(255, 255, 255, 0.95);
    padding: 50px 60px 70px;
    text-align: center;
    box-shadow: 0 1rem 2rem rgba(0,0,0,0.3);
    position: relative;
    transition: transform var(--transition), box-shadow var(--transition);
}
.form-box:hover {
    transform: translateY(-5px);
    box-shadow: 0 2rem 3rem rgba(0,0,0,0.4);
}

/* Form heading */
.form-box h1 {
    font-size: 2.5rem;
    margin-bottom: 25px;
    color: var(--main-color);
    position: relative;
    font-weight: 700;
}
.form-box h1::after {
    content: '';
    width: 60px;
    height: 4px;
    border-radius: 3px;
    background: var(--secondary-color);
    position: absolute;
    bottom: -15px;
    left: 50%;
    transform: translateX(-50%);
}

/* Input field wrapper */
.input-field {
    background: #f0f0f0;
    margin: 15px 0;
    border-radius: 8px;
    display: flex;
    align-items: center;
    overflow: hidden;
    transition: box-shadow var(--transition);
}
.input-field:focus-within {
    box-shadow: 0 0 10px var(--main-color);
}
.input-field i {
    margin-left: 15px;
    color: var(--main-color);
}

/* Inputs and textarea */
input, textarea {
    width: 100%;
    background: transparent;
    border: 0;
    outline: 0;
    padding: 19px 20px;
    font-size: 1rem;
    color: #333;
    font-weight: 500;
}

/* Button */
.btn-field {
    width: 100%;
    margin-top: 20px;
    display: grid;
    place-items: center;
}
.btn-field button {
    height: 4rem;
    width: 12rem;
    background: linear-gradient(135deg, var(--main-color), var(--secondary-color));
    color: #fff;
    border-radius: 25px;
    cursor: pointer;
    font-size: 1.2rem;
    font-weight: 600;
    border: none;
    transition: transform var(--transition), box-shadow var(--transition);
}
.btn-field button:hover {
    transform: scale(1.05);
    box-shadow: 0 0.5rem 1rem rgba(0,0,0,0.4);
}

/* Messages */
.message {
    color: green;
    margin-bottom: 10px;
    font-weight: 600;
}
.error {
    color: red;
    margin-bottom: 10px;
    font-weight: 600;
}

</style>
</head>
<body>
<?php include 'header.php'; ?>

<div class="login-container">
  <div class="form-box">
    <h1 id="title">Contact Us</h1>

    <?php if ($success) echo "<p class='message'>".htmlspecialchars($success)."</p>"; ?>
    <?php if ($error)   echo "<p class='error'>".htmlspecialchars($error)."</p>"; ?>

    <form action="contact.php" method="POST">
      <div class="input-group">
        <div class="input-field">
          <i class="fa-solid fa-user"></i>
          <!-- name attributes are lowercase to match PHP -->
          <input type="text" name="name" placeholder="Full Name" required>
        </div>

        <div class="input-field">
          <i class="fa-solid fa-envelope"></i>
          <input type="email" name="email" placeholder="Email" required>
        </div>

        <div class="input-field" style="align-items:flex-start;">
          <i class="fa-solid fa-message" style="margin-top:20px;"></i>
          <textarea name="message" placeholder="Write your message..." rows="4" required></textarea>
        </div>
      </div>

      <div class="btn-field">
        <button type="submit">Send</button>
      </div>
    </form>
  </div>
</div>

<?php include 'footer.php'; ?>
</body>
</html>
