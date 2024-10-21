
// notices cart
// let countNewProductOfCart = document.querySelector(".notices");
// let notices = document.querySelector(".notices span");
// let btnCart = document.querySelector(".notices-cart");

// // check count of notices in localStorage
// if(window.localStorage.getItem("notices")) {
//   notices.innerHTML = window.localStorage.getItem("notices");
//   countNewProductOfCart.style.display = "inline";
// } else {
//   countNewProductOfCart.style.display = "none";
// }

// if click cart 
// btnCart.addEventListener("click", () => {
//   window.localStorage.removeItem("notices");
// })

// search button 
let search = document.querySelector(".search");
let box_search = document.querySelector(".box-search");
let btn_close = document.querySelector(".btn-close");

// search input
search.addEventListener("click", () => {
  box_search.classList.toggle("active")
})


let main_product = document.querySelector(".products");

// Access parent div filter 
let select_categories = document.querySelectorAll(".categories div");

// Access products in shop page
let productItems = document.querySelectorAll(".products .product-item");

// Access btn next page and btn previous page

// evaluation product use start 
evaluation();

// if select categories filter
select_categories.forEach((title) => {
  title.addEventListener("click", () => {
    if (title.classList.contains("active")) {
      title.classList.remove("active");
      title.querySelector(".angle").className = "fa-solid fa-angle-down float-end bg-dark text-light angle";
      title.classList.add("active");
    }
  })
})


// evaluation function
function evaluation() {
  productItems.forEach((pro,index_pro) => {
    let li_start = pro.querySelectorAll(`.evaluation-start`);
    let random_start = (Math.ceil(Math.random()* 5));
    li_start.forEach((start,index_start) => {
    if(index_start < random_start) {
      start.classList.add("text-warning")
      start.classList.replace("fa-regular", "fa-solid");
    } else {
      start.classList.add("text-dark");
    }
  })
})
}

// Initialize tooltips
let tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
let tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
  return new bootstrap.Tooltip(tooltipTriggerEl);
})
