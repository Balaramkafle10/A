<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>about</title>
    <link
  rel="stylesheet"
  href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
   
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

/* Optional overlay for better text readability */
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
 
/* Responsive */
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

.about {
    display: flex;
    align-items: center;
    flex-wrap: wrap;
    gap: 3rem;
    padding: 5rem 2rem;
    background: #fff;
    border-radius: 1rem;
    box-shadow: 0 1rem 2rem rgba(0,0,0,0.1);
}
.about .image {
    flex: 1 1 41rem;
    overflow: hidden;
    border-radius: 1rem;
}
.about .image img {
    width: 100%;
    transition: transform var(--transition);
}
.about .image img:hover {
    transform: scale(1.05);
}
.about .content {
    flex: 1 1 41rem;
    text-align: center;
    padding: 1rem;
}
.about .content h3 {
    font-size: 3rem;
    color: var(--black);
    margin-bottom: 1rem;
}
.about .content p {
    font-size: 1.5rem;
    color: var(--light-black);
    line-height: 2;
    padding: 1rem 0;
}
.about .content .icons-container {
    margin-top: 2rem;
    display: flex;
    flex-wrap: wrap;
    gap: 1.5rem;
    justify-content: center;
}
.about .content .icons-container .icons {
    background: var(--light-bg);
    padding: 2rem;
    flex: 1 1 16rem;
    border-radius: 1rem;
    box-shadow: 0 0.5rem 1rem rgba(0,0,0,0.1);
    transition: transform var(--transition), box-shadow var(--transition);
    cursor: pointer;
}
.about .content .icons-container .icons:hover {
    transform: translateY(-10px);
    box-shadow: 0 1rem 2rem rgba(0,0,0,0.2);
}
.about .content .icons-container .icons i {
    font-size: 4rem;
    margin-bottom: 1rem;
    color: var(--main-color);
}
.about .content .icons-container .icons span {
    font-size: 1.5rem;
    color: var(--black);
    display: block;
}

/* Reviews Section */
.reviews {
    background: linear-gradient(120deg, #ffe0e0, #fff5e6);
    padding: 5rem 2rem;
}
.reviews h1.heading-title {
    text-align: center;
    font-size: 3.5rem;
    margin-bottom: 4rem;
    color: var(--main-color);
    text-transform: uppercase;
    letter-spacing: 2px;
}
.reviews .slide {
    display: grid;
    padding: 2rem;
    text-align: center;
    box-shadow: 0 1rem 2rem rgba(0, 0, 0, 0.1);
    border-radius: 1rem;
    background: #fff;
    transition: transform var(--transition), box-shadow var(--transition);
}
.reviews .slide:hover {
    transform: translateY(-10px);
    box-shadow: 0 2rem 3rem rgba(0,0,0,0.15);
}
.reviews .slide .stars {
    padding-bottom: 1rem;
}
.reviews .slide .stars i {
    font-size: 1.7rem;
    color: var(--main-color);
}
.reviews .slide p {
    font-size: 1.5rem;
    color: var(--light-black);
    line-height: 2;
    padding: 1.5rem 0;
}
.reviews .slide h3 {
    font-size: 2rem;
    color: var(--black);
    margin-bottom: 0.5rem;
}
.reviews .slide span {
    font-size: 1.5rem;
    color: var(--secondary-color);
    display: block;
}
.reviews .slide img {
    height: 13rem;
    width: 13rem;
    border-radius: 50%;
    object-fit: cover;
    margin-top: 1rem;
    border: 3px solid var(--main-color);
}
</style>

</head>
<body>
<?php
include 'header.php';
?>

<div class="heading" style="background:url(https://hips.hearstapps.com/hmg-prod/images/autumn-leaves-fallen-in-forest-royalty-free-image-1628717422.jpg?crop=1xw:0.84375xh;center,top) no-repeat">
   <h1>about us</h1>
</div>

<section class="about">
    <div class="image">
        <img src="https://english.pardafas.com/wp-content/uploads/2023/07/Tourist-Nepal.jpg" alt="">
    </div>
    <div class="content">
        <h3> why choose us?</h3>
        <p>Choose us for your travel needs because we offer personalized service, exclusive deals,
             and 24/7 support. With years of expertise, wide-ranging options, and a commitment to safety,
              we ensure unforgettable experiences tailored just for you. Book now for peace of mind and unbeatable adventures!</p>
              <div class="icons-container">
                <div class="icons">
                    <i class="fas fa-map"></i>
                    <span>top destinations</span>
                </div>
                <div class="icons">
                    <i class="fas fa-hand-holding-usd"></i>
                    <span>affordable price</span>
                </div>
                <div class="icons">
                    <i class="fas fa-headset"></i>
                    <span>24/7 guide service</span>
                </div>
              </div>
</div>
</section>

<section class="reviews">
<h1 class="heading-title">client review</h1>
    <div class="swiper reviews-slider">
        <div class="swiper-wrapper">
            
        <div class="swiper-slider slide">
           
            <div class="stars">
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="far fa-star"></i>
            </div> 
            <p>I had an incredible experience booking my vacation through this tour website. 
                The attention to detail and personalized recommendations made my trip unforgettable. Highly recommend!</p>
                <h3>Rajesh Hamal</h3>
                <span>actor</span>
                <img src="https://i0.wp.com/english.khabarhub.com/wp-content/uploads/2020/07/Rajesh-Hamal.jpg?fit=960%2C640&ssl=1" alt="">
      

            
            
        </div>
        <div class="swiper-slider slide">
            <div class="stars">
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="far fa-star"></i>
            </div>
            <p>I loved using this tour website for my recent trip. 
                The curated experiences and insider tips made all the difference. 
                Can’t wait to plan my next adventure with them!</p>
            <h3>Dayahang Rai</h3>
            <span>actor</span>
            <img src="https://www.imnepal.com/wp-content/uploads/2017/09/dayahang-rai.jpg" alt="">
        </div>
        <div class="swiper-slider slide">
            <div class="stars">
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
            </div>
            <p>This tour company exceeded all my expectations. Their professional team ensured 
                everything was smooth and memorable. A must-try for any traveler looking for a premium experience.</p>
            <h3>Keki Adhikari</h3>
            <span>actress</span>
            <img src="https://sumitsharmasameer.com/wp-content/uploads/2023/11/keki-adhikari-1.jpeg" alt="">
        </div>
   
        <div class="swiper-slider slide">
            <div class="stars">
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="far fa-star"></i>
                <i class="far fa-star"></i>
            </div>
            <p>From start to finish, this tour website was incredible. The unique experiences and flawless 
                organization made it a trip to remember. Can't wait to book again!</p>
            <h3>Gagan Thapa</h3>
            <span>politician</span>
            <img src="https://assets-cdn.kathmandupost.com/uploads/source/news/2022/news/gaganthapaTKP-1669096736.jpg" alt="">
        </div>
        <div class="swiper-slider slide">
            <div class="stars">
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="far fa-star"></i>
            </div>
            <p>This tour company is the real deal. Everything was perfectly organized and the
                 tours were truly immersive. An excellent choice for any traveler.</p>
            <h3>Anjan Bista</h3>
            <span>footballer</span>
            <img src="https://pbs.twimg.com/media/FdqUUsWaMAAdbUo.jpg" alt="">
        </div>
        <div class="swiper-slider slide">
            <div class="stars">
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
            </div>
            <p>Booking with this tour service was a breeze. The user-friendly website and 
                fantastic customer service made it a joy to plan my trip. Five stars all the way!</p>
            <h3>Prakash Saput</h3>
            <span>Singer</span>
            <img src="https://images.genius.com/ffba7bd6069f67436542f5621888f096.698x698x1.jpg" alt="">
        </div>
        
        </div>
    </div>
</section>



<?php
include 'footer.php';
?>

<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
<!-- <script src="script.js"></script> -->
    

    
</body>
</html>