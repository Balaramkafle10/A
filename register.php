<?php
include 'connection.php'; // Your DB connection file

// Define variables and initialize with empty values
$Name = $Address = $phoneNumber = $Email = $userName = $Password = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $Name = $_POST['Name'];
    $Address = $_POST['Address'];
    $phoneNumber = $_POST['phoneNumber'];
    $Email = $_POST['Email'];
    $userName = $_POST['userName'];
    $Password = $_POST['Password']; // Store raw password (Not Recommended!)

    // Prepare the insert query
    $query = "INSERT INTO customers (Name, Address, phoneNumber, Email, userName, Password) 
              VALUES (?, ?, ?, ?, ?, ?)";

    if ($stmt = $conn->prepare($query)) {
        $stmt->bind_param("ssssss", $Name, $Address, $phoneNumber, $Email, $userName, $Password);

        if ($stmt->execute()) {
            // Registration success: redirect to login
            header("Location: login.php");
            exit;
        } else {
            echo "Error executing statement: " . $stmt->error;
        }

        $stmt->close();
    } else {
        echo "Error preparing statement: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Signup</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" />
    <link rel="stylesheet" href="style2.css" />
    <style>
        .header .icons a {
            font-size: 1.7rem;
            color: #fff;
            cursor: pointer;
            margin-right: 1.5rem;
        }
        .header .icons a:hover {
            color: var(--main-color);
        }
        .login-container {
            height: 100vh;
            width: 100%;
            background-image: linear-gradient(rgba(141, 141, 237, 0.8), rgba(143, 143, 241, 0.8)), url(https://assets.thehansindia.com/h-upload/2019/12/27/248830-worldtour.jpg);
            background-size: cover;
            background-position: center;
        }
        .form-box {
            border-radius: 24px;
            width: 90%;
            max-width: 450px;
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -40%);
            background: white;
            padding: 50px 60px 70px;
            text-align: center;
        }
        .form-box h1 {
            font-size: 2.2rem;
            margin-bottom: 20px;
            color: #3c00a0;
            position: relative;
        }
        .form-box h1::after {
            content: '';
            width: 50px;
            height: 4px;
            border-radius: 3px;
            background: rgb(128, 79, 128);
            position: absolute;
            bottom: -12px;
            left: 50%;
            transform: translateX(-50%);
        }
        .input-field {
            background: #eaeaea;
            margin: 15px 0px;
            border-radius: 3px;
            display: flex;
            align-items: center;
            max-height: 65px;
            transition: max-height 0.5s;
            overflow: hidden;
            position: relative;
        }
        .input-field i {
            margin-left: 15px;
            cursor: pointer;
            color: #666;
        }
        input {
            width: 100%;
            background: transparent;
            border: 0;
            outline: 0;
            padding: 19px 40px 19px 20px;
            font-size: 1.1rem;
        }
        form p {
            text-align: left;
            font-size: 15px;
        }
        form p a {
            text-decoration: none;
            color: #3c00a0;
        }
        .btn-field {
            width: 100%;
            margin-top: 10px;
            padding: 10px 0px;
            display: grid;
            text-align: center;
        }
        .btn-field button {
            text-align: center;
            height: 4rem;
            width: 10rem;
            flex-basis: 60%;
            background: #3c00a0;
            color: #fff;
            border-radius: 25px;
            cursor: pointer;
        }
        /* Position the eye icon inside the input */
        .input-field .fa-eye,
        .input-field .fa-eye-slash {
            position: absolute;
            right: 20px;
            top: 50%;
            transform: translateY(-50%);
            font-size: 1.3rem;
            color: #555;
        }
    </style>
</head>
<body>
<?php include 'header.php' ?>

<div class="login-container">
    <div class="form-box">
        <h1 id="title">Register</h1>
        <form action="register.php" method="POST" id="myForm">
            <div class="input-group">
                <div class="input-field" id="nameField">
                    <i class="fa-solid fa-user"></i>
                    <input type="text" name="Name" placeholder="Full Name" pattern="[A-Za-z]+\s[A-Za-z]+" title="Please enter at least two words (name and surname)" required />
                </div>
                <div class="input-field" id="nameField">
                    <i class="fa-solid fa-map-marker-alt"></i>
                    <input type="text" name="Address" placeholder="Address" required />
                </div>
                <div class="input-field" id="nameField">
                    <i class="fa-solid fa-envelope"></i>
                    <input type="email" name="Email" placeholder="Email" pattern="[a-zA-Z._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}" required />
                </div>
                <div class="input-field" id="nameField">
                    <i class="fa-solid fa-phone"></i>
                    <input type="text" name="phoneNumber" placeholder="Phone Number" pattern="[9][7-8][0-9]{8}" title="Please enter a 10-digit number" required />
                </div>
                <div class="input-field" id="nameField">
                    <i class="fa-solid fa-user-circle"></i>
                    <input type="text" name="userName" placeholder="Username" pattern="[A-Za-z][A-Za-z0-9]*" title="Username must start with a letter and can contain letters and numbers" required />
                </div>
                <div class="input-field">
                    <i class="fa-solid fa-lock"></i>
                    <input type="password" name="Password" id="password" placeholder="Password" pattern="(?=.*[A-Z])(?=.*[a-z])(?=.*\d)(?=.*[!@#$%^&*()]).{8,}" required />
                    <i class="fa-solid fa-eye" id="togglePassword" title="Show/Hide Password"></i>
                </div>
            </div>

            <div>
                <label for="check">I agree to all <a href="#">terms & conditions.</a></label>
                <input type="checkbox" name="check" id="check" required />
            </div>

            <div class="btn-field">
                <button type="submit" id="login">Signup</button>
            </div>
            <h3>Already have an account? <a href="login.php">Login</a></h3>
        </form>
    </div>
</div>

<?php include 'footer.php' ?>

<script>
    const togglePassword = document.querySelector('#togglePassword');
    const password = document.querySelector('#password');

    togglePassword.addEventListener('click', () => {
        // Toggle the type attribute
        const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
        password.setAttribute('type', type);

        // Toggle the icon class to switch between eye and eye-slash
        togglePassword.classList.toggle('fa-eye-slash');
    });
</script>

</body>
</html>
