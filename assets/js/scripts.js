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

let contactsForm = $(".contacts-form");

contactsForm.on("submit", function (event) {
  event.preventDefault();

  let formData = new FormData(this);
  formData.append("action", "contacts_form");

  $.ajax({
    type: "POST",
    url: adminAjax.url,
    data: formData,
    contentType: false,
    processData: false,
    success: function (response) {
      alert("Ответ сервера " + response);
    },
  });
});
