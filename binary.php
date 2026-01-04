<?php
// Start session safely
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

include 'connection.php';

try {
    $pdo = new PDO("mysql:host=$servername;dbname=$database", $userName, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Accept search query from both GET and POST
    $search = '';
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($_POST['query'])) {
        $search = trim($_POST['query']);
    } elseif ($_SERVER['REQUEST_METHOD'] === 'GET' && !empty($_GET['query'])) {
        $search = trim($_GET['query']);
    }

    if (!empty($search)) {
        // Fetch packages matching the search term
        $stmt = $pdo->prepare("SELECT * FROM package WHERE location LIKE :search OR duration LIKE :search");
        $stmt->execute(['search' => "%$search%"]);
        $packages = $stmt->fetchAll(PDO::FETCH_ASSOC);
        ?>
        <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8" />
            <meta name="viewport" content="width=device-width, initial-scale=1" />
            <title>Search Results for "<?php echo htmlspecialchars($search); ?>"</title>
            <style>


/* ===== Heading ===== */
.heading {
    background-size: cover !important;
    background-position: center !important;
    padding: 4rem 0 3rem;
    display: flex;
    align-items: center;
    justify-content: center;
    text-align: center;
    color: #fff;
    text-shadow: 2px 2px 8px rgba(0,0,0,0.7);
}
.heading h1 {
    font-size: 4rem;
    text-transform: uppercase;
    font-weight: 800;
    background: linear-gradient(120deg, #00aaffff, #ffffffff);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
}

/* ===== Packages Grid ===== */
.box-container {
    display: flex;
    flex-wrap: wrap;
    gap: 2rem;
    justify-content: center;
    padding: 3rem 1rem;
}

/* ===== Individual Package Card ===== */
.box {
    background: #857d7dff;
    border-radius: 20px;
    overflow: hidden;
    width: 300px;
    display: flex;
    flex-direction: column;
    align-items: center;
    box-shadow: 0 10px 20px rgba(0,0,0,0.1);
    transition: transform 0.4s ease, box-shadow 0.4s ease;
    position: relative;
}
.box:hover {
    transform: translateY(-12px);
    box-shadow: 0 25px 40px rgba(0,0,0,0.2);
}

/* ===== Image Section ===== */
.box .image {
    width: 100%;
    height: 200px;
    overflow: hidden;
    border-top-left-radius: 20px;
    border-top-right-radius: 20px;
}
.box .image img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 0.5s ease;
}
.box:hover .image img {
    transform: scale(1.1);
}

/* ===== Content Section ===== */
.box .content {
    padding: 1.5rem;
    text-align: center;
    width: 100%;
}
.box .content h3 {
    font-size: 1.5rem;
    color: #b22222;
    margin-bottom: 0.5rem;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 0.5rem;
}
.box .content h3 i {
    color: #ff6b6b;
}
.box .content .price {
    font-size: 1.3rem;
    font-weight: 700;
    color: #222;
    margin: 0.5rem 0;
}
.box .content h4 {
    font-size: 1.1rem;
    color: #555;
    margin-bottom: 1rem;
}

/* ===== Book Now Button ===== */
.box .btn {
    display: inline-block;
    padding: 12px 25px;
    border-radius: 30px;
    background: linear-gradient(135deg, #ff6b6b, #feca57);
    color: #fff;
    font-weight: 600;
    text-decoration: none;
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}
.box .btn:hover {
    transform: scale(1.05);
    box-shadow: 0 0.5rem 1rem rgba(0,0,0,0.3);
}

/* ===== Responsive ===== */
@media (max-width: 1024px) {
    .box {
        width: 45%; /* 2 per row */
    }
}
@media (max-width: 768px) {
    .box {
        width: 90%; /* 1 per row */
    }
}
/* ===== Body ===== */
body {
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    background-color: #f2f2f2;
    margin: 0;
    padding: 0;
}
/* Modal container */
.modal {
    display: flex;
    align-items: center;
    justify-content: center;
    position: fixed;
    z-index: 9999;
    left: 0;
    top: 0;
    width: 100%;
    height: 100%;
    background: rgba(0, 0, 0, 0.6); /* dark overlay */
}

/* Modal box */
.modal-content {
    background: #fff;
    padding: 30px 40px;
    border-radius: 12px;
    text-align: center;
    width: 90%;
    max-width: 450px;
    box-shadow: 0 6px 20px rgba(0, 0, 0, 0.25);
    animation: fadeIn 0.3s ease-out;
}

/* Heading */
.modal-content h2 {
    margin-bottom: 15px;
    color: #e63946;
    font-size: 1.8rem;
}

/* Paragraph */
.modal-content p {
    font-size: 1rem;
    margin-bottom: 20px;
    color: #333;
}

/* Button */
.btn-close {
    display: inline-block;
    padding: 10px 18px;
    background: #457b9d;
    color: #fff;
    text-decoration: none;
    font-weight: bold;
    border-radius: 6px;
    transition: background 0.3s ease;
}

.btn-close:hover {
    background: #1d3557;
}

/* Fade-in animation */
@keyframes fadeIn {
    from {
        opacity: 0;
        transform: scale(0.9);
    }
    to {
        opacity: 1;
        transform: scale(1);
    }
}



            </style>
        </head>
        <body>
            

        <?php include 'header.php'; ?>

        <div class="heading" style="background:url('https://hips.hearstapps.com/hmg-prod/images/autumn-leaves-fallen-in-forest-royalty-free-image-1628717422.jpg') no-repeat">
            <h1>Search Results</h1>
        </div>

        <section class="packages">
            <h1 class="heading-title" style="text-align:center; margin-bottom: 1.5rem;"><br>
                Packages matching "<?php echo htmlspecialchars($search); ?>"
            </h1>
            <div class="box-container">
                <?php if (count($packages) > 0): ?>
                    <?php foreach ($packages as $row): ?>
                        <div class="box">
                            <div class="image">
                                <img src="uploads/<?php echo htmlspecialchars($row['image']); ?>" alt="Package Image">
                            </div>
                            <div class="content">
                                <h3><i class="fa fa-map-marker-alt"></i> <?php echo htmlspecialchars($row['location']); ?></h3>
                                <div class="price">Rs.<?php echo htmlspecialchars($row['price']); ?> (per person)</div>
                                <h4><?php echo htmlspecialchars($row['duration']); ?></h4>

                                <?php if (isset($_SESSION['customer_id'])): ?>
                                    <!-- Logged in user -->
                                    <a href="book.php?id=<?php echo $row['package_id']; ?>" class="btn">Book Now</a>
                                <?php else: ?>
                                    <!-- Guest user -->
                                    <a href="login.php" class="btn">Book Now</a>
                                <?php endif; ?>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>
        </section>

        <!-- Modal -->
        <?php if (count($packages) === 0): ?>
            <div id="noPackageModal" class="modal">
                <div class="modal-content">
                    <h2>No Packages Found</h2>
                    <p>Sorry, no packages found for '<?php echo htmlspecialchars($search); ?>'.</p>
                    <a href="package.php" class="btn-close">Go Back</a>
                </div>
            </div>
        <?php endif; ?>

        <script>
            <?php if (count($packages) === 0): ?>
                const modal = document.getElementById('noPackageModal');
                modal.style.display = 'flex';
                document.querySelector('.btn-close').addEventListener('click', function(e) {
                    e.preventDefault();
                    window.location.href = "package.php";
                });
                window.onclick = function(event) {
                    if (event.target === modal) {
                        window.location.href = "package.php";
                    }
                };
            <?php endif; ?>
        </script>

       
        </body>
        </html>
        <?php
    } else {
        // If no query entered
        header("Location: package.php");
        exit;
    }
} catch (PDOException $e) {
    echo "<p style='color:red; text-align:center; margin-top: 2rem;'>Error: " . htmlspecialchars($e->getMessage()) . "</p>";
}
?>
<?php include 'footer.php' ?>