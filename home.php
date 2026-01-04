<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">

    <style>
        /* ---------------- Body ---------------- */
        body {
            margin: 0;
            font-family: 'Poppins', sans-serif;
            background: #f0f2f5;
            color: #333;
        }

        /* ---------------- Buttons ---------------- */
        .btn {
            display: inline-block;
            padding: 10px 25px;
            background: linear-gradient(135deg, #ff4d4d, #b22222);
            color: #fff;
            border-radius: 50px;
            text-decoration: none;
            font-weight: 500;
            transition: all 0.3s ease;
        }
        .btn:hover {
            background: linear-gradient(135deg, #b22222, #7a1414);
        }

        /* ---------------- Headings ---------------- */
        h1, h2, h3, h4 {
            color: #1a73e8;
            text-transform: uppercase;
            letter-spacing: 1px;
            margin-bottom: 10px;
        }

        /* ---------------- Home Slider ---------------- */
  .home {
    position: relative;
    width: 100%;
    height: 100%;
}

.home .swiper-slide {
    display: flex;
    justify-content: center;
    align-items: center;
    background-size: cover;   /* full image coverage */
    background-position: center;
    width: 100%;
    height: 600px;
    position: relative;
}

.home .swiper-slide .content {
    background: rgba(0,0,0,0.5);
    padding: 2rem 3rem;
    border-radius: 12px;
    text-align: center;
    color: #fff;
    animation: fadeIn 1s ease forwards;
}

.home .swiper-slide .content span {
    color: #ffd700;
    display: block;
    margin-bottom: 0.5rem;
    font-size: 1.2rem; /* slightly bigger */
}

.home .swiper-slide .content h3 {
    font-size: 3rem; /* bigger heading */
    margin-bottom: 1rem;
}


        
        @keyframes fadeIn {
            0% {opacity: 0; transform: translateY(50px);}
            100% {opacity: 1; transform: translateY(0);}
        }
        .swiper-button-next, .swiper-button-prev {
            color: #fff;
            width: 45px;
            height: 45px;
            background: rgba(0,0,0,0.4);
            border-radius: 50%;
        }
        .swiper-button-next:hover, .swiper-button-prev:hover {
            background: rgba(0,0,0,0.7);
        }

        /* ---------------- About Section ---------------- */
        .home-about {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 3rem;
            padding: 4rem 2rem;
            flex-wrap: wrap;
        }
        .home-about .image img {
            max-width: 400px;
            width: 100%;
            border-radius: 12px;
            box-shadow: 0 6px 20px rgba(0,0,0,0.15);
            transition: transform 0.3s ease;
        }
        .home-about .image img:hover {
            transform: scale(1.05);
        }
        .home-about .content {
            max-width: 500px;
        }
        .home-about .content h3 {
            font-size: 2rem;
            margin-bottom: 1rem;
        }
        .home-about .content p {
            font-size: 1rem;
            line-height: 1.8;
            margin-bottom: 1.5rem;
        }

        /* ---------------- Packages ---------------- */
        .home-packages {
            padding: 4rem 2rem;
            text-align: center;
        }
        .home-packages .heading-title {
            font-size: 2.5rem;
            margin-bottom: 3rem;
        }
        .home-packages .box-container {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 2rem;
        }
        .home-packages .box {
            background: #fff;
            width: 300px;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 6px 20px rgba(0,0,0,0.1);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
        .home-packages .box:hover {
            transform: translateY(-10px);
            box-shadow: 0 10px 30px rgba(0,0,0,0.2);
        }
        .home-packages .box .image img {
            width: 100%;
            height: 200px;
            object-fit: cover;
            transition: transform 0.3s ease;
        }
        .home-packages .box:hover .image img {
            transform: scale(1.1);
        }
        .home-packages .box .content {
            padding: 1.5rem;
        }
        .home-packages .box .content h3 {
            font-size: 1.5rem;
            margin-bottom: 0.5rem;
        }
        .home-packages .box .content p {
            font-size: 1rem;
            margin-bottom: 1rem;
        }
        .home-packages .load-more {
            margin-top: 2rem;
        }

        /* ---------------- Offer Section ---------------- */
        .home-offer {
            background: linear-gradient(135deg, #ff4d4d, #b22222);
            color: #fff;
            text-align: center;
            padding: 4rem 2rem;
            border-radius: 12px;
            margin: 3rem 2rem;
        }
        .home-offer h3 {
            font-size: 2rem;
            margin-bottom: 1rem;
        }
        .home-offer p {
            font-size: 1rem;
            margin-bottom: 1.5rem;
        }

        /* ---------------- Services Section ---------------- */
        .services {
            padding: 4rem 2rem;
            text-align: center;
        }
        .services .heading-title {
            font-size: 2.5rem;
            margin-bottom: 3rem;
        }
        .services .box-container {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 2rem;
        }
        .services .box {
            background: #fff;
            padding: 2rem;
            width: 200px;
            border-radius: 12px;
            box-shadow: 0 6px 20px rgba(0,0,0,0.1);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
        .services .box:hover {
            transform: translateY(-10px);
            box-shadow: 0 10px 30px rgba(0,0,0,0.2);
        }
        .services .box img {
            width: 80px;
            margin-bottom: 1rem;
        }
        .services .box h3 {
            font-size: 1.2rem;
        }


        /* ---------------- Responsive ---------------- */
        @media(max-width:768px){
            .home-about, .home-packages .box-container, .services .box-container {
                flex-direction: column;
                align-items: center;
            }
            .home-about .content, .home-about .image {
                max-width: 90%;
            }
            .home-packages .box, .services .box {
                width: 90%;
            }
        }
    </style>
</head>
<body>

<?php
include 'header.php';
?>

<!-- ---------------- Home Slider ---------------- -->
<section class="home">
    <div class="swiper home-slider">
        <div class="swiper-wrapper">
            <div class="swiper-slide" style="background-image: url('https://www.traveltalktours.com/wp-content/uploads/2017/01/Photo-Nepal-Essential.jpg');">
                <div class="content">
                    <span>explore, discover, travel</span>
                    <h3>travel around the world</h3>
                    <a href="package.php" class="btn">discover more</a>
                </div>
            </div>
            <div class="swiper-slide" style="background-image: url('https://www.outlooktravelmag.com/media/RFqCz9uB1611926508-1-1611926508.4x-jpg.webp');">
                <div class="content">
                    <span>explore, discover, travel</span>
                    <h3>discover the new places</h3>
                    <a href="package.php" class="btn">discover more</a>
                </div>
            </div>
            <div class="swiper-slide" style="background-image: url('https://www.natureloverstrek.com/pagegallery/everything-you-need-to-know-about-khaptad-national-park-%7C-interesting-things-about-khaptad-national-park16.jpg');">
                <div class="content">
                    <span>explore, discover, travel</span>
                    <h3>make your tour worthwhile</h3>
                    <a href="package.php" class="btn">discover more</a>
                </div>
            </div>
        </div>
        <div class="swiper-button-next"></div>
        <div class="swiper-button-prev"></div>
    </div>
</section>

<!-- ---------------- About ---------------- -->
<section class="home-about">
    <div class="image">
        <img src="https://english.pardafas.com/wp-content/uploads/2023/07/Tourist-Nepal.jpg" alt="">
    </div>
    <div class="content">
        <h3>about us</h3>
        <p> Welcome to TOURMANDU, your gateway to extraordinary adventures and unforgettable experiences.
        At Tour&Travel, we're passionate about travel. Our mission is to inspire, empower, and connect travelers 
        to the world through immersive journeys that go beyond the ordinary.</p>
        <a href="about.php" class="btn">read more</a>
    </div>
</section>

<!-- ---------------- Packages ---------------- -->
<section class="home-packages">
    <h1 class="heading-title">our packages</h1>
    <div class="box-container">
        <div class="box">
            <div class="image">
                <img src="https://www.travelandtourworld.com/wp-content/uploads/2022/07/Nepal.jpg" alt="">
            </div>
            <div class="content">
                <h3>adventure & tour</h3>
                <p>Swayambhunath is an ancient religious complex atop a hill in the Kathmandu city.</p>
                <a href="package.php" class="btn">book now</a>
            </div>
        </div>
        <div class="box">
            <div class="image">
                <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/1/1f/Pashupatinath_Temple-2020.jpg/1200px-Pashupatinath_Temple-2020.jpg" alt="">
            </div>
            <div class="content">
                <h3>adventure & tour</h3>
                <p>The Pashupatinath Temple is a Hindu temple located in Kathmandu, Nepal.</p>
                <a href="package.php" class="btn">book now</a>
            </div>
        </div>
        <div class="box">
            <div class="image">
                <img src="https://media.tacdn.com/media/attractions-splice-spp-674x446/06/e6/b3/0e.jpg" alt="">
            </div>
            <div class="content">
                <h3>adventure & tour</h3>
                <p>Pokhara is a city on Phewa Lake, in central Nepal.</p>
                <a href="package.php" class="btn">book now</a>
            </div>
        </div>
    </div>
    <div class="load-more">
        <a href="package.php" class="btn">load more</a>
    </div>
</section>

<!-- ---------------- Offer ---------------- -->
<section class="home-offer">
    <div class="content">
        <h3>upto 50% off</h3>
        <p>this offer is valid upto 30th november on the occasion of dashain & tihar.</p>
        <a href="package.php" class="btn">book now</a>
    </div>
</section>

<!-- ---------------- Services ---------------- -->
<section class="services">
    <h1 class="heading-title">our services</h1>
    <div class="box-container">
        <div class="box">
            <img src="https://english.onlinekhabar.com/wp-content/uploads/2023/08/adventure-tourism-activities.png" alt="">
            <h3>adventure</h3>
        </div>
        <div class="box">
            <img src="https://travelumpire.com/wp-content/uploads/2022/02/EBC-Trek-with-G.jpg" alt="">
            <h3>tour guide</h3>
        </div>
        <div class="box">
            <img src="https://www.nepaltrekkinginhimalaya.com/images/articles/PXRP3-doga-yuruyusunde-bilinmesi-gerekenler.jpg" alt="">
            <h3>trekking</h3>
        </div>
        <div class="box">
            <img src="https://static.vecteezy.com/system/resources/previews/027/104/762/large_2x/nepal-s-traditional-method-of-cooking-using-wood-fire-free-photo.jpg" alt="">
            <h3>camp fire</h3>
        </div>
        <div class="box">
            <img src="https://www.trekkingtrail.com/uploads/articles/images/self-drive-road-trip-upper-mustang-nepal.jpg" alt="">
            <h3>off road</h3>
        </div>
    </div>
</section>

<?php
include 'footer.php';
?>

<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
<script>
    const swiper = new Swiper('.home-slider', {
        loop: true,
        grabCursor: true,
        effect: 'fade',
        autoplay: {
            delay: 3500,
            disableOnInteraction: false,
        },
        navigation: {
            nextEl: '.swiper-button-next',
            prevEl: '.swiper-button-prev',
        },
    });
</script>

</body>
</html>
