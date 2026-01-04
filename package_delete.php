<?php
include 'connection.php';

if (isset($_GET['id']) && !empty($_GET['id'])) {
    $package_id = intval($_GET['id']); // sanitize input

    // Delete related bookings first
    $deleteBookings = "DELETE FROM book_form WHERE package_id = $package_id";
    mysqli_query($conn, $deleteBookings);

    // Delete the package
    $deletePackage = "DELETE FROM package WHERE package_id = $package_id";
    if (mysqli_query($conn, $deletePackage)) {
        mysqli_close($conn);
        header("Location: package_list.php?msg=deleted");
        exit();
    } else {
        mysqli_close($conn);
        header("Location: package_list.php?msg=error");
        exit();
    }
} else {
    mysqli_close($conn);
    header("Location: package_list.php?msg=invalid");
    exit();
}
?>
