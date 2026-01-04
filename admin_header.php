<?php
// admin_header.php
?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">

<style>
:root {
    --main-color: #1e2aac;
    --accent-color: #ffd700;
    --text-color: #ffffff;
}

/* RESET */
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

body {
    padding-top: 70px;
    overflow-x: hidden;
}

/* HEADER */
.header {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 65px;
    background: var(--main-color);
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding: 0 25px;
    z-index: 1000;
    box-shadow: 0 4px 10px rgba(0,0,0,0.25);
}

/* LOGO */
.logo h3 {
    color: var(--text-color);
    font-size: 1.5rem;
    letter-spacing: 2px;
}

/* NAVBAR – ALWAYS DESKTOP */
.navbar {
    display: flex;
    gap: 18px;
}

.navbar a {
    color: var(--text-color);
    text-decoration: none;
    font-size: 0.95rem;
    padding: 6px 10px;
    border-radius: 5px;
}

.navbar a:hover {
    background: rgba(255,255,255,0.2);
    color: var(--accent-color);
}

/* ICON */
.icons a {
    color: var(--text-color);
    text-decoration: none;
    padding: 6px 10px;
    border-radius: 5px;
    background: rgba(255,255,255,0.15);
}

.icons a:hover {
    background: rgba(255,255,255,0.3);
    color: var(--accent-color);
}
</style>

<header class="header">
    <a href="home.php" class="logo">
        <h3>TOURMANDU</h3>
    </a>

    <nav class="navbar">
        <a href="addPackages.php">Add Package</a>
        <a href="package_list.php">Package Info</a>
        <a href="user_list.php">Users</a>
        <a href="booked.php">Bookings</a>
        <a href="contact_list.php">Contact</a>
    </nav>

    <div class="icons">
        <a href="login.php"><i class="fas fa-sign-out-alt"></i> Logout</a>
    </div>
</header>
