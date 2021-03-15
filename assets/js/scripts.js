// Burger-menu
const menuToggle = $(".header-menu-toggle");
menuToggle.on("click", (event) => {
  event.preventDefault();
  $(".header-nav").slideToggle(200);
});

// Slider
const swiper = new Swiper(".swiper-container", {
  // Optional parameters
  autoplay: {
    delay: 5000,
  },
  loop: true,

  // If we need pagination
  pagination: {
    el: ".swiper-pagination",
  },
});
