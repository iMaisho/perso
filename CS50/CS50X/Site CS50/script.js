// Ce script permet d'afficher le menu au clic sur le burger
document.addEventListener("DOMContentLoaded", function () {
  var burgerMenu = document.querySelector(".burgerMenu");
  var navbar = document.querySelector(".navbar");
  var body = document.querySelector("body");

  function toggleNav() {
    navbar.classList.toggle("showNav");
  }
  function noScroll() {
    body.classList.toggle("noScroll");
  }

  burgerMenu.addEventListener("click", toggleNav);
  burgerMenu.addEventListener("click", noScroll);
});
