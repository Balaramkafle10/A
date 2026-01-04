<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1" />
<title>Package</title>

<style>
:root {
    --main-color: #ff6b6b;
    --secondary-color: #feca57;
    --light-bg: #ffffff;
    --text-shadow: 2px 2px 8px rgba(0,0,0,0.4);
    --transition: 0.3s ease-in-out;
}

.heading {
    position: relative;
    background: url('https://hips.hearstapps.com/hmg-prod/images/autumn-leaves-fallen-in-forest-royalty-free-image-1628717422.jpg?crop=1xw:0.84375xh;center,top') no-repeat center/cover;
    padding: 4rem 1rem;
    display: flex;
    align-items: center;
    justify-content: center;
    text-align: center;
    overflow: hidden;
}

/* Overlay for readability */
.heading::before {
    content: '';
    position: absolute;
    top:0;
    left:0;
    width:100%;
    height:100%;
    background: rgba(0,0,0,0.4);
    z-index: 1;
}

.heading h1 {
    position: relative;
    z-index: 2;
    font-size: 6rem;
    text-transform: uppercase;
    background: linear-gradient(120deg, var(--main-color), var(--secondary-color));
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    text-shadow: var(--text-shadow);
    transition: transform var(--transition);
}

/* Optional hover effect */
.heading h1:hover {
    transform: scale(1.05);
}

/* Responsive adjustments */
@media(max-width: 1024px){
    .heading h1 {
        font-size: 4.5rem;
    }
}
@media(max-width: 768px){
    .heading h1 {
        font-size: 3rem;
    }
}

/* Package Section */
.packages {
    padding: 5rem 10%;
    background: #f9f9f9;
}
.packages .heading-title {
    font-size: 2.5rem;
    text-align: center;
    color: #ff6b6b;
    margin-bottom: 3rem;
    text-transform: uppercase;
    font-weight: 700;
}


/* Box Container */
.packages .box-container {
    display: flex;
    flex-wrap: wrap;
    gap: 2rem;
    justify-content: center;
}

/* Individual Package Box */
.packages .box-container .box {
    position: relative;
    flex: 1 1 calc(33.333% - 1.33rem); /* 3 items per row */
    max-width: 22.5rem;
    border-radius: 20px;
    overflow: hidden;
    background: #fff;
    box-shadow: 0 10px 20px rgba(0,0,0,0.1);
    transition: transform 0.4s ease, box-shadow 0.4s ease;
}
.packages .box-container .box:hover {
    transform: translateY(-10px);
    box-shadow: 0 15px 25px rgba(0,0,0,0.2);
}

/* Image */
.packages .box-container .box img {
    width: 100%;
    height: 22rem;
    object-fit: cover;
    border-top-left-radius: 20px;
    border-top-right-radius: 20px;
    transition: transform 0.6s ease;
}
.packages .box-container .box:hover img {
    transform: scale(1.1);
}

/* Content under image */
.packages .box-container .box .content {
    padding: 1.5rem 1rem;
    text-align: center;
    background: #fff;
}

/* Title */
.packages .box-container .box .content h3 {
    font-size: 1.5rem;
    color: #333;
    margin: 0.5rem 0;
}
.packages .box-container .box .content h3 i {
    color: #ff6b6b;
}

/* Price & Duration */
.packages .box-container .box .content .price {
    font-size: 1.2rem;
    color: #ff6b6b;
    margin: 0.3rem 0;
}
.packages .box-container .box .content h4 {
    font-size: 1rem;
    color: #555;
    margin-bottom: 0.8rem;
}

/* Book Now Button */
.packages .box-container .box .content .btn {
    display: inline-block;
    margin-top: 0.5rem;
    padding: 10px 25px;
    border-radius: 30px;
    background: linear-gradient(135deg, #ff6b6b, #feca57);
    color: #fff;
    font-weight: 600;
    font-size: 1rem;
    text-decoration: none;
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}
.packages .box-container .box .content .btn:hover {
    transform: scale(1.05);
    box-shadow: 0 8px 15px rgba(0,0,0,0.3);
}

/* Responsive Adjustments */
@media(max-width: 1024px) {
    .packages .box-container .box {
        flex: 1 1 calc(50% - 1rem); /* 2 items per row */
    }
    .packages .box-container .box img {
        height: 20rem;
    }
}
@media(max-width: 768px) {
    .packages .box-container .box {
        flex: 1 1 90%; /* 1 item per row */
    }
    .packages .box-container .box img {
        height: 18rem;
    }
}
</style>


</head>
<body>
<?php include 'header.php'; ?>

<div class="heading" style="background:url('https://hips.hearstapps.com/hmg-prod/images/autumn-leaves-fallen-in-forest-royalty-free-image-1628717422.jpg?crop=1xw:0.84375xh;center,top') no-repeat">
   <h1>Packages</h1>
</div>

<section class="packages">
    <h1 class="heading-title">Top Destinations</h1>
    <div class="box-container">
        <?php
        include 'connection.php';

        try {
            $pdo = new PDO("mysql:host=$servername;dbname=$database;charset=utf8mb4", $userName, $password);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $sql = "SELECT package_id, location, duration, price, image FROM package";
            $stmt = $pdo->query($sql);

            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                echo "<div class='box'>";
                echo "<div class='image'><img src='uploads/" . htmlspecialchars($row['image']) . "' alt='Place Photo'></div>";
                echo "<div class='content'>";
                echo "<h3><i class='fa fa-map-marker-alt' style='color:darkred'></i> " . htmlspecialchars($row['location']) . "</h3>";
                echo "<div class='price'>Rs." . htmlspecialchars($row['price']) . " (per person)</div>";
                echo "<h4>" . htmlspecialchars($row['duration']) . "</h4>";

                // ✅ Book Now button with login redirect
                if (isset($_SESSION['customer_id'])) {
                    echo "<a href='book.php?id=" . intval($row['package_id']) . "' class='btn'>Book Now</a>";
                } else {
                    echo "<a href='login.php?redirect=book.php?id=" . intval($row['package_id']) . "' class='btn'>Book Now</a>";
                }

                echo "</div></div>";
            }
        } catch (PDOException $e) {
            echo "Error: " . htmlspecialchars($e->getMessage());
        }
        ?>
    </div>
</section>

<?php
// ✅ Popular Packages by most booked
try {
    $sql = "SELECT p.package_id, p.location, p.duration, p.price, p.image, COUNT(b.book_id) AS total_bookings
            FROM package p
            LEFT JOIN book_form b ON p.package_id = b.package_id
            GROUP BY p.package_id
            ORDER BY total_bookings DESC
            LIMIT 3";
    $stmt = $pdo->query($sql);
    $popularPackages = $stmt->fetchAll(PDO::FETCH_ASSOC);

    if ($popularPackages) {
        echo "<section class='packages'>";
        echo "<h1 class='heading-title'>🔥 Popular Packages</h1>";
        echo "<div class='box-container'>";
        foreach ($popularPackages as $package) {
            echo "<div class='box'>";
            echo "<div class='image'><img src='uploads/" . htmlspecialchars($package['image']) . "' alt='Place Photo'></div>";
            echo "<div class='content'>";
            echo "<h3><i class='fa fa-map-marker-alt' style='color:darkred'></i> " . htmlspecialchars($package['location']) . "</h3>";
            echo "<div class='price'>Rs." . htmlspecialchars($package['price']) . " (per person)</div>";
            echo "<h4>" . htmlspecialchars($package['duration']) . "</h4>";
            echo "<p>📌 Booked: " . intval($package['total_bookings']) . " times</p>";

            if (isset($_SESSION['customer_id'])) {
                echo "<a href='book.php?id=" . intval($package['package_id']) . "' class='btn'>Book Now</a>";
            } else {
                echo "<a href='login.php?redirect=book.php?id=" . intval($package['package_id']) . "' class='btn'>Book Now</a>";
            }

            echo "</div></div>";
        }
        echo "</div></section>";
    }
} catch (PDOException $e) {
    echo "Error: " . htmlspecialchars($e->getMessage());
}
?>

<?php include 'footer.php'; ?>
<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
<script src="script.js"></script>
</body>
</html>
