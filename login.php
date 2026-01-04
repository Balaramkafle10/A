<?php
include 'connection.php';
session_start();

$userName = $Password = "";
$username_err = $password_err = "";

// Capture redirect if provided
$redirect = isset($_GET['redirect']) ? $_GET['redirect'] : '';

// Process form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $userName = trim($_POST['userName']);
    $Password = trim($_POST['Password']);
    $redirect = isset($_POST['redirect']) ? $_POST['redirect'] : '';

    // Query user regardless of admin or customer
    $stmt = $conn->prepare("SELECT customer_id, userName, Password, is_admin FROM customers WHERE userName = ?");
    $stmt->bind_param("s", $userName);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        // Check password (plain text here, change to password_verify() if hashed)
        if ($Password === $row['Password']) {
            $_SESSION["customer_id"] = $row["customer_id"];
            $_SESSION["is_admin"] = ($row["is_admin"] == 1) ?true: false;

            // Redirect based on admin status
            if ($_SESSION["is_admin"]) {
                header('Location: addPackages.php'); // Admin page
                exit;
            } else {
                if (!empty($redirect)) {
                    header("Location: " . $redirect); // Redirect if provided
                } else {
                    header("Location: package.php"); // Regular user page
                }
                exit;
            }
        } else {
            $password_err = "Invalid password";
            echo "<script>alert('Invalid username or password.');</script>";
        }
    } else {
        $username_err = "User not found";
        echo "<script>alert('Invalid username or password.');</script>";
    }

    $stmt->close();
}
$conn->close();
?>


<?php if (isset($_GET['message']) && $_GET['message'] == 'please_login'): ?>
    <p style="color:red;">⚠️ Please login to book a package</p>
<?php endif; ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Login</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" />
   
    <style>
        .header .icons a {
            font-size: 1rem;
            color: #fff;
            cursor: pointer;
            margin-right: 1.5rem;
        }
        .header .icons a:hover { color: var(--main-color); }
        .login-container {
            height: 100vh; width: 100%;
            background-image: linear-gradient(rgba(141, 141, 237, 0.8), rgba(143, 143, 241, 0.8)), 
                              url(https://assets.thehansindia.com/h-upload/2019/12/27/248830-worldtour.jpg);
            background-size: cover; background-position: center;
        }
        .form-box {
            border-radius: 24px; width: 90%; max-width: 450px;
            position: absolute; top: 50%; left: 50%; transform: translate(-50%, -40%);
            background: white; padding: 50px 60px 70px; text-align: center;
        }
        .form-box h1 { font-size: 2.2rem; margin-bottom: 20px; color: #3c00a0; position: relative; }
        .form-box h1::after {
            content: ''; width: 50px; height: 4px; border-radius: 3px; background: rgb(128, 79, 128);
            position: absolute; bottom: -12px; left: 50%; transform: translateX(-50%);
        }
        .input-field {
            background: #eaeaea; margin: 15px 0; border-radius: 3px;
            display: flex; align-items: center; max-height: 65px;
            transition: max-height 0.5s; overflow: hidden; position: relative;
        }
        .input-field i { margin-left: 15px; color: #666; cursor: pointer; }
        input {
            width: 100%; background: transparent; border: 0; outline: 0;
            padding: 19px 40px 19px 20px; font-size: 1.1rem;
        }
        form p { text-align: left; font-size: 15px; }
        form p a { text-decoration: none; color: #3c00a0; }
        .btn-field { width: 100%; margin-top: 10px; padding: 10px 0; display: grid; text-align: center; }
        .btn-field button {
            text-align: center; height: 4rem; width: 10rem;
            background: #3c00a0; color: #fff; border-radius: 25px; cursor: pointer;
        }
        .input-field .fa-eye, .input-field .fa-eye-slash {
            position: absolute; right: 20px; top: 50%; transform: translateY(-50%);
            font-size: 1.3rem; color: #555;
        }
        .case { text-transform: lowercase; }
    </style>
</head>
<body>

<?php include 'header.php' ?>

<div class="login-container">
    <div class="form-box">
        <h1 id="title">Login</h1>
        <form action="login.php" method="POST" id="myForm">
            <input type="hidden" name="redirect" value="<?php echo htmlspecialchars($redirect); ?>">
            
            <div class="input-group">
                <div class="input-field" id="nameField">
                    <i class="fa-solid fa-user"></i>
                    <input type="text" class="case" name="userName" id="userName" placeholder="username" required />
                </div>
                <div class="input-field">
                    <i class="fa-solid fa-lock"></i>
                    <input type="password" name="Password" id="Password" placeholder="password" required />
                    <i class="fa-solid fa-eye" id="togglePassword" title="Show/Hide Password"></i>
                </div>
            </div>

            <div class="btn-field">
                <button type="submit" id="login">Login</button>
            </div>

            <h3><a href="#">Forget Password?</a></h3>
            <h3>Don't have account? <a href="register.php">Create account.</a></h3>
        </form>
        <p id="error-message" class="error-message" style="color: red;"></p>
    </div>
</div>

<?php include 'footer.php' ?>

<script>
    const togglePassword = document.querySelector('#togglePassword');
    const password = document.querySelector('#Password');

    togglePassword.addEventListener('click', () => {
        const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
        password.setAttribute('type', type);
        togglePassword.classList.toggle('fa-eye-slash');
    });
</script>

</body>
</html>
