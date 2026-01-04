<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
        }

        body {
            background: #f5f5f5;
            min-height: 100vh;
        }

        .footer {
            background: linear-gradient(135deg, #2c3e50, #34495e);
            color: #fff;
            padding: 60px 0 20px;
            margin-top: 80px;
            position: relative;
            overflow: hidden;
        }

        .footer::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 5px;
            background: linear-gradient(90deg, #e74c3c, #f39c12, #2ecc71, #3498db);
        }

        .box-container {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 30px;
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
        }

        .box {
            padding: 20px;
            transition: transform 0.3s ease;
        }

        .box:hover {
            transform: translateY(-5px);
        }

        .box h3 {
            font-size: 22px;
            color: #f39c12;
            margin-bottom: 20px;
            position: relative;
            padding-bottom: 10px;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .box h3::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 50px;
            height: 2px;
            background: #f39c12;
        }

        .box a {
            display: block;
            color: #ecf0f1;
            text-decoration: none;
            margin-bottom: 12px;
            transition: all 0.3s ease;
            padding: 8px 0;
            border-radius: 5px;
        }

        .box a:hover {
            color: #f39c12;
            transform: translateX(10px);
            background: rgba(255, 255, 255, 0.1);
            padding-left: 15px;
        }

        .box a i {
            margin-right: 10px;
            width: 20px;
            text-align: center;
            color: #f39c12;
        }

        .credit {
            text-align: center;
            margin-top: 50px;
            padding: 20px;
            border-top: 1px solid rgba(255, 255, 255, 0.1);
            font-size: 16px;
            color: #bdc3c7;
        }

        .credit span {
            color: #f39c12;
            font-weight: bold;
        }

        /* Social media icons specific styling */
        .box:nth-child(4) a i {
            background: rgba(255, 255, 255, 0.1);
            padding: 10px;
            border-radius: 50%;
            transition: all 0.3s ease;
        }

        .box:nth-child(4) a:hover i {
            background: #f39c12;
            color: #2c3e50;
            transform: scale(1.1);
        }

        /* Responsive design */
        @media (max-width: 768px) {
            .box-container {
                grid-template-columns: 1fr;
                text-align: center;
            }

            .box h3::after {
                left: 50%;
                transform: translateX(-50%);
            }

            .box a:hover {
                transform: translateX(0);
            }
        }

        /* Animation */
        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .box {
            animation: fadeIn 0.6s ease-out;
        }

        .box:nth-child(2) { animation-delay: 0.1s; }
        .box:nth-child(3) { animation-delay: 0.2s; }
        .box:nth-child(4) { animation-delay: 0.3s; }
    </style>
</head>
<body>
    <section class="footer">
        <div class="box-container">
            <div class="box">
                <h3>quick links</h3>
                <a href="home.php"><i class="fas fa-angle-right"></i> Home</a>
                <a href="about.php"><i class="fas fa-angle-right"></i> About</a>
                <a href="package.php"><i class="fas fa-angle-right"></i> Package</a>
                <a href="book.php"><i class="fas fa-angle-right"></i> Book</a>
            </div>
            <div class="box">
                <h3>extra links</h3>
                <a href="contact.php"><i class="fas fa-angle-right"></i> ask questions</a>
                <a href="about.php"><i class="fas fa-angle-right"></i> about us</a>
                <!-- <a href="#"><i class="fas fa-angle-right"></i> privacy policy</a>
                <a href="#"><i class="fas fa-angle-right"></i> terms of use</a> -->
            </div>

            <div class="box">
    <h3>Contact Info</h3>

    <!-- Phone -->
    <a href="tel:+9779843238782">
        <i class="fas fa-phone"></i> +977 9843238782
    </a>

    <!-- Open Gmail directly -->
    <a href="https://mail.google.com/mail/?view=cm&fs=1&to=kafle07@gmail.com" target="_blank">
        <i class="fas fa-envelope"></i> kafle07@gmail.com
    </a>

    <!-- Location -->
    <a href="https://www.google.com/maps/search/?api=1&query=Bagmati+Province+Kathmandu+Nepal" target="_blank">
        <i class="fas fa-map"></i> Bagmati Province, Kathmandu, Nepal
    </a>
</div>


            <div class="box">
    <h3>Follow Us</h3>

    <a href="https://www.facebook.com/" target="_blank">
        <i class="fab fa-facebook-f"></i> Facebook
    </a>

    <a href="https://twitter.com/" target="_blank">
        <i class="fab fa-twitter"></i> Twitter
    </a>

    <a href="https://www.instagram.com/" target="_blank">
        <i class="fab fa-instagram"></i> Instagram
    </a>

    <a href="https://www.linkedin.com/" target="_blank">
        <i class="fab fa-linkedin"></i> LinkedIn
    </a>
</div>

        </div>
        <div class="credit">created by <span>mr.Kafle</span> | all rights reserved!</div>
    </section>
</body>
</html>