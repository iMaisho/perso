// Ce script permet d'afficher le menu au clic sur le burger
document.addEventListener("DOMContentLoaded", function () {
  var burgerMenu = document.querySelector(".burgerMenu");
  var navbar = document.querySelector(".navbar");

  function toggleNav() {
    navbar.classList.toggle("showNav");
  }

  burgerMenu.addEventListener("click", toggleNav);
});

// Ce script fait la transition entre les headers pour les grands écrans
// document.addEventListener("DOMContentLoaded", function () {
//   var header = document.querySelector("header");
//   var logo = document.querySelector(".logo");
//   window.addEventListener("scroll", function () {
//     var scroll = window.scrollY;
//     if (scroll >= 50 && window.innerWidth > 768) {
//       header.classList.add("header-alt");
//       logo.classList.remove("logo");
//       logo.classList.add("logo-alt");
//     } else {
//       header.classList.remove("header-alt");
//       logo.classList.remove("logo-alt");
//       logo.classList.add("logo");
//     }
//   });
// });

// Ce script permet de changer le mot important du Hero Banner
/* const words = ["PARTOUT.", "FORT.    ", "EMOUVANT.", "MAGIQUE.", "SUBLIME.  ", "CAPTIVANT.", "ESSENTIEL." , "IMMERSIF.", "VIBRANT.", "INTENSE."];
const letters = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
const numLetters = words.map(word => word.length);

let index = 0;
let animatedWord = document.getElementById("animated-word");
let intervalId = null;

setInterval(() => {
  index++;
  if (index >= words.length) {
    index = 0;
  }
  let newWord = words[index];
  let numIterations = animatedWord.dataset.value.length * 3; // 3 iterations per letter
  
  clearInterval(intervalId);
  
  let iteration = 0;
  intervalId = setInterval(() => {
    animatedWord.innerText = animatedWord.dataset.value
      .split("")
      .map((letter, index) => {
        if(index < iteration) {
          return newWord[index];
        }
      
        return letters[Math.floor(Math.random() * 26)]
      })
      .join("");
    
    if(iteration >= numIterations){ 
      clearInterval(intervalId);
      animatedWord.dataset.value = newWord;
    }
    
    iteration++;
  }, 30);
}, 5000);
 */
