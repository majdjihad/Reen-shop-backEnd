// access elements 
let mainImageProduct = document.querySelector(".cover-img");
let subsImageProduct = document.querySelectorAll(".product_details .child-img");
let productPrice = document.querySelector(".price-product");
let productPriceOriginal = document.querySelector(".price-original");

// add src in sub images 
subsImageProduct.forEach((sub, indexSub) => {
  // if mouseover in img
  sub.addEventListener("mouseover", () => {
    mainImageProduct.setAttribute("src", sub.getAttribute("src"));
    })
})
// add price 
productPriceOriginal.textContent = `${parseInt(productPrice.textContent)+70}.99$`;

// products show
let mainProduct = document.querySelector(".swiper-wrapper");


let productsSwiper = document.querySelectorAll(".swiper-wrapper .swiper-slide");
let productItems = document.querySelectorAll(".swiper-wrapper .product-item");


// search click 
let search = document.querySelector(".search");
let box_search = document.querySelector(".box-search");
let btn_close = document.querySelector(".btn-close");

// open search input 
search.addEventListener("click", () => {
  search.style = "display: none !important";
  box_search.classList.add("active")
})

// close search input 
btn_close.addEventListener("click", () => {
  box_search.classList.remove("active");
  search.style = "display: block !important";
})

// Initialize tooltips
let tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
let tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
  return new bootstrap.Tooltip(tooltipTriggerEl);
})

// slides Products
let swiper = new Swiper(".mySwiper", {
  slidesPerView: window.innerWidth > 991 ? 3 : window.innerWidth > 676 ? 2 : 1,
  spaceBetween: 30,
  slidesPerGroup: window.innerWidth > 991 ? 3 : window.innerWidth > 676 ? 2 : 1,
  loop: true,
  loopFillGroupWithBlank: true,
  pagination: {
    el: ".swiper-pagination",
    clickable: true,
  },
  navigation: {
    nextEl: ".swiper-button-next",
    prevEl: ".swiper-button-prev",
  },
});

// Listen for window resize events
window.addEventListener('resize', function() {
  // Check screen width
  if (window.matchMedia("(max-width: 676px)").matches) {
    swiper.params.slidesPerView = 1;
    swiper.params.slidesPerGroup = 1;
  } else if (window.matchMedia("(max-width: 991px)").matches) {
    swiper.params.slidesPerView = 2;
    swiper.params.slidesPerGroup = 2;
  } else {
    swiper.params.slidesPerView = 3;
    swiper.params.slidesPerGroup = 3;
  }

  // Update Swiper
  swiper.update();
});