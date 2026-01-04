<?php
session_start();

/* ---------------- Validate Package ID ---------------- */
$package_id = isset($_GET['id']) ? $_GET['id'] : '';
if (empty($package_id) || !ctype_digit($package_id)) {
    header("Location: packages.php");
    exit;
}

/* ---------------- Fetch Package Duration ---------------- */
include 'connection.php';

$sql = "SELECT duration FROM package WHERE package_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $package_id);
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_assoc();

$duration = $row['duration'];   // e.g. 6Days/5Night, 3Days, 2Days/1Night

preg_match('/(\d+)/', $duration, $matches);
$days = (int)$matches[1];       // Extract number of days
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Book</title>

    <style>
        .booking {
            padding: 9rem 10%;
            background: #f9f9f9;
        }

        .heading-title {
            text-align: center;
            font-size: 5rem;
            color: #3c00a0;
            margin-bottom: 5rem;
            position: relative;
        }

        .heading-title::after {
            content: '';
            width: 100px;
            height: 4px;
            background: rgba(163, 16, 163, 1);
            position: absolute;
            bottom: -12px;
            left: 50%;
            transform: translateX(-50%);
            border-radius: 3px;
        }

        .book-form {
            max-width: 800px;
            margin: auto;
            background: #fff;
            padding: 3rem 4rem;
            border-radius: 24px;
            box-shadow: 0 0 15px rgba(0,0,0,0.1);
        }

        .book-form .flex {
            display: flex;
            flex-wrap: wrap;
            gap: 1.5rem;
        }

        .book-form .inputBox {
            flex: 1 1 45%;
            display: flex;
            flex-direction: column;
        }

        .book-form .inputBox span {
            font-weight: 600;
            color: #3c00a0;
            margin-bottom: 0.8rem;
            font-size: 1.2rem;
        }

        .book-form input {
            padding: 18px 22px;
            border-radius: 8px;
            border: none;
            background: #eaeaea;
            font-size: 1.1rem;
        }

        .book-form input:focus {
            outline: none;
            box-shadow: 0 0 8px rgba(142, 68, 173, 0.6);
        }

        .book-form input[type="submit"] {
            margin: 3rem auto 0;
            display: block;
            width: 220px;
            height: 55px;
            border-radius: 30px;
            background: #3c00a0;
            color: #fff;
            font-size: 1.4rem;
            cursor: pointer;
            border: none;
        }

        .heading {
            background: url('https://hips.hearstapps.com/hmg-prod/images/autumn-leaves-fallen-in-forest-royalty-free-image-1628717422.jpg') no-repeat center/cover;
            padding: 6rem 0;
            text-align: center;
            color: #fff;
            font-size: 3rem;
            text-transform: uppercase;
            letter-spacing: 4px;
        }

        @media (max-width: 768px) {
            .book-form .inputBox {
                flex: 1 1 100%;
            }
        }
    </style>
</head>

<body>

<?php include 'header.php'; ?>

<div class="heading">
    <h1>book now</h1>
</div>

<section class="booking">
    <h1 class="heading-title">book your trip!</h1>

    <form action="book_form.php?package_id=<?php echo htmlspecialchars($package_id); ?>" method="post" class="book-form">
        <div class="flex">

            <div class="inputBox">
                <span>Name:</span>
                <input type="text" name="name" required>
            </div>

            <div class="inputBox">
                <span>Email:</span>
                <input type="email" name="email" required>
            </div>

            <div class="inputBox">
                <span>Phone:</span>
                <input type="tel" name="phone" pattern="[9][7-8][0-9]{8}" required>
            </div>

            <div class="inputBox">
                <span>Address:</span>
                <input type="text" name="address" required>
            </div>

            <div class="inputBox">
                <span>How many guests:</span>
                <input type="number" name="guests" min="1" max="25" required>
            </div>

            <div class="inputBox">
                <span>Arrivals:</span>
                <input type="date" id="arrival-date" name="arrivals" required>
            </div>

            <div class="inputBox">
                <span>Leaving:</span>
                <input type="date" id="leaving-date" name="leaving" readonly required>
            </div>

        </div>

        <input type="submit" value="Submit" name="send">
    </form>
</section>

<?php include 'footer.php'; ?>

<script>
document.addEventListener('DOMContentLoaded', function () {

    const arrivalInput = document.getElementById('arrival-date');
    const leavingInput = document.getElementById('leaving-date');

    const packageDays = <?php echo $days; ?>;

    // Set arrival min = tomorrow
    const today = new Date();
    today.setDate(today.getDate() + 1);
    const tomorrow = today.toISOString().split('T')[0];
    arrivalInput.setAttribute('min', tomorrow);

    arrivalInput.addEventListener('change', function () {
        if (!this.value) return;

        let arrivalDate = new Date(this.value);
        arrivalDate.setDate(arrivalDate.getDate() + (packageDays - 1));

        leavingInput.value = arrivalDate.toISOString().split('T')[0];
    });
});
</script>

</body>
</html>
