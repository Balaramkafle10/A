<?php
include 'connection.php';
session_start();

// Admin session check
if (!isset($_SESSION['is_admin']) || $_SESSION['is_admin'] !== true) {
    header('Location: login.php');
    exit();
}

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $location = $_POST["location"];
    $duration = $_POST["duration"];
    $price = $_POST["price"];

    // Create uploads folder if not exists
    $upload_dir = "uploads/";
    if (!is_dir($upload_dir)) mkdir($upload_dir, 0777, true);

    // File upload
    if (isset($_FILES["image"]) && $_FILES["image"]["error"] == 0) {
        $file_name = basename($_FILES["image"]["name"]);
        $target_file = $upload_dir . $file_name;
        $file_type = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
        $allowed_types = ['jpg','jpeg','png','gif'];

        if (!in_array($file_type, $allowed_types)) die("Only JPG, JPEG, PNG & GIF files allowed.");

        if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
            $query = "INSERT INTO package (image, location, duration, price) VALUES (?, ?, ?, ?)";
            $stmt = $conn->prepare($query);
            $stmt->bind_param("ssss", $file_name, $location, $duration, $price);
            $stmt->execute();
            $stmt->close();
        } else {
            echo "Error uploading image.";
        }
    } else {
        echo "No image selected or upload error.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Packages</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">

    <style>
        :root {
            --main-color: #180766ff;
            --secondary-color: #feca57;
            --transition: 0.3s ease-in-out;
        }

       
        

        /* ---------------- Form Section ---------------- */
        .container {
            height: 100vh;
            width: 100%;
            background-image: linear-gradient(rgba(100,100,237,0.6), rgba(255,143,241,0.6)), 
                              url(https://assets.thehansindia.com/h-upload/2019/12/27/248830-worldtour.jpg);
            background-size: cover;
            background-position: center;
            display: flex;
            align-items: center;
            justify-content: center;
            padding-top: 100px;
            margin-top: -20px;
        }

        .form {
            border-radius: 24px;
            width: 90%;
            max-width: 500px;
            background: rgba(255,255,255,0.95);
            padding: 50px 60px 70px;
            text-align: center;
            box-shadow: 0 1rem 2rem rgba(0,0,0,0.2);
            transition: transform var(--transition), box-shadow var(--transition);
        }
        .form:hover { transform: translateY(-5px); box-shadow: 0 2rem 3rem rgba(0,0,0,0.25); }
        .form h1 { font-size: 2.5rem; color: var(--main-color); margin-bottom: 2rem; text-transform: uppercase; }

        .form-box { width: 100%; padding: 15px 20px; margin-bottom: 20px; border: 1px solid #ccc; border-radius: 12px; font-size: 1rem; }
        .btn { width: 100%; padding: 15px; border: none; border-radius: 12px; background: linear-gradient(135deg, var(--main-color), var(--secondary-color)); color: #fff; font-size: 1.2rem; cursor: pointer; }
        .btn:hover { transform: scale(1.05); box-shadow: 0 0.5rem 1rem rgba(0,0,0,0.3); }

        .image-preview { border: 2px dashed #ccc; border-radius: 12px; padding: 10px; position: relative; overflow: hidden; background: #fafafa; margin-bottom: 15px; }
        .image-preview:hover { border-color: var(--main-color); }
        .image-preview__image { width: 100%; height: auto; display: none; border-radius: 12px; }
        .image-preview__default-text { font-size: 1rem; color: #aaa; }
        /* FORCE DESKTOP NAVBAR */
@media (min-width: 901px) {
    .navbar {
        position: static !important;
        display: flex !important;
        flex-direction: row !important;
        width: auto !important;
        height: auto !important;
        background: none !important;
    }
}

    </style>
</head>
<body>

<?php include"admin_header.php" ?>

<div class="container">
    <div class="form">
        <h1>Add Packages</h1>
        <form class="form-box" method="post" enctype="multipart/form-data">
            <label for="image">Image*:</label>
            <input type="file" id="image" name="image" accept="image/*" required><br><br>
            <div class="image-preview" id="imagePreview">
                <img src="" alt="Image Preview" class="image-preview__image"/>
                <span class="image-preview__default-text">Image Preview</span>
            </div>

            <label for="location">Location*:</label>
            <input type="text" id="location" name="location" required><br><br>

            <label for="duration">Time Duration*:</label>
            <input type="text" name="duration" required><br><br>

            <label for="price">Price*:</label>
            <input type="number" id="price" name="price" required><br><br>

            <button type="submit" class="btn">Add</button>
        </form>
    </div>
</div>

<?php include 'footer.php'; ?>

<script>
document.getElementById("image").addEventListener("change", function() {
    const file = this.files[0];
    if (file) {
        const reader = new FileReader();
        const preview = document.querySelector(".image-preview__image");
        const previewDefaultText = document.querySelector(".image-preview__default-text");

        reader.addEventListener("load", function() {
            preview.setAttribute("src", this.result);
            preview.style.display = "block";
            previewDefaultText.style.display = "none";
        });
        reader.readAsDataURL(file);
    }
});

// // Mobile menu toggle
// const menuBtn = document.getElementById('menu-btn');
// const navbar = document.querySelector('.navbar');
// menuBtn.addEventListener('click', () => { navbar.classList.toggle('active'); });
 </script>

</body>
</html>
