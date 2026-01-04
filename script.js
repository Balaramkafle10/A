let menu = document.querySelector('#menu-btn');
let navbar= document.querySelector('.header .navbar');

menu.onclick = () =>{
    menu.classList.toggle('fa-times');
    navbar.classList.toggle('active');
};

menu.onscroll = () =>{
    menu.classList.remove('fa-times');
    navbar.classList.remove('active');
};

var swiper = new Swiper(".home-slider", {
  loop:true,
  navigation: {
    nextEl: ".swiper-button-next",
    prevEl: ".swiper-button-prev",
  },
});

var swiper = new Swiper(".reviews-slider", {
  spaceBetween: 20,
  loop:true,
   autoplay:{
      delay: 2500,
      disableOnInteraction:false,
   },
  breakpoints:{
    640: {
      slidesPerView: 1,
      
    },
    768: {
      slidesPerView: 2,
      
    },
    1024: {
      slidesPerView: 3,
      
    },
  },
});


