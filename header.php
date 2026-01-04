<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Tourmandu</title>

  <style>
    /* ---------------- Body ---------------- */
    body {
      margin: 0;
      font-family: 'Poppins', sans-serif;
      background: linear-gradient(to right, #f0f4f8, #d9e2ec);
      color: #333;
    }

    /* ---------------- Header ---------------- */
    .header {
      display: flex;
      align-items: center;
      justify-content: space-between;
      background: #1a73e8;
      padding: 15px 40px;
      box-shadow: 0 4px 12px rgba(0,0,0,0.15);
      position: sticky;
      top: 0;
      z-index: 100;
      border-radius: 0 0 12px 12px;
    }

    .header .logo h3 {
      margin: 0;
      font-size: 26px;
      font-weight: 700;
      color: #fff;
      letter-spacing: 2px;
      text-shadow: 1px 1px 5px rgba(0,0,0,0.3);
      transition: color 0.3s ease;
    }

    .header .logo h3:hover {
      color: #ffdd59;
    }

    /* ---------------- Navbar ---------------- */
    .navbar {
      display: flex;
      align-items: center;
      gap: 25px;
    }

    .navbar a {
      text-decoration: none;
      color: #fff;
      font-size: 17px;
      font-weight: 500;
      padding: 5px 10px;
      border-radius: 8px;
      transition: all 0.3s ease;
    }

    .navbar a:hover {
      background: #fff;
      color: #1a73e8;
    }

    /* ---------------- Search Form ---------------- */
    .search-form {
      display: flex;
      align-items: center;
      border-radius: 50px;
      overflow: hidden;
      background: #fff;
      box-shadow: 0 2px 10px rgba(0,0,0,0.1);
      border: 1px solid #eee;
      transition: all 0.3s ease;
    }

    .search-form__input {
      padding: 8px 15px;
      border: none;
      outline: none;
      font-size: 15px;
      width: 180px;
      transition: all 0.3s ease;
    }

    .search-form__input:focus {
      width: 220px;
      background: #f8f8f8;
    }

    .search-form__button {
      padding: 8px 16px;
      border: none;
      background: linear-gradient(135deg, #ff4d4d, #b22222);
      color: #fff;
      cursor: pointer;
      font-size: 16px;
      display: flex;
      align-items: center;
      justify-content: center;
      transition: all 0.3s ease;
    }

    .search-form__button:hover {
      background: linear-gradient(135deg, #b22222, #7a1414);
    }

    /* ---------------- Icons ---------------- */
    .icons a {
      margin-left: 20px;
      text-decoration: none;
      color: #fff;
      font-size: 16px;
      display: flex;
      align-items: center;
      gap: 6px;
      transition: color 0.3s ease;
    }

    .icons a:hover {
      color: #ffdd59;
    }

    /* ---------------- Responsive ---------------- */
    @media (max-width: 768px) {
      .header {
        flex-wrap: wrap;
        padding: 12px 20px;
      }
      .navbar {
        width: 100%;
        justify-content: center;
        margin: 10px 0;
        flex-wrap: wrap;
        gap: 15px;
      }
      .search-form {
        margin: 10px auto;
        width: 100%;
        max-width: 350px;
      }
      .search-form__input {
        width: 100%;
      }
    }
  </style>
</head>
<body>

<section class="header">
  <a href="home.php" class="logo"><h3>TOURMANDU</h3></a>

  <nav class="navbar">
    <a href="home.php">Home</a>
    <a href="about.php">About</a>
    <a href="package.php">Package</a>
    <a href="contact.php">Contact</a>

    <form action="binary.php" method="get" class="search-form">
      <input type="text" name="query" class="search-form__input" placeholder="Search..." required>
      <button type="submit" class="search-form__button">
        <i class="fa fa-search"></i>
      </button>
    </form>
  </nav>

  <div class="icons">
    <?php if (isset($_SESSION['customer_id'])): ?>
        <a href="logout.php"><i class="fa fa-sign-out-alt"></i> Logout</a>
    <?php else: ?>
        <a href="login.php"><i class="fa fa-user"></i> Login</a>
    <?php endif; ?>
  </div>
</section>

</body>
</html>
