function revealOnScroll() {
  var navbarLoaded = false;
  var reveals = document.querySelectorAll(".reveal");

  function reveal() {
    var windowHeight = window.innerHeight;

    for (var i = 0; i < reveals.length; i++) {
      var elementTop = reveals[i].getBoundingClientRect().top;
      var elementVisible = 150;

      if (elementTop < windowHeight - elementVisible) {
        reveals[i].classList.add("active");
      }
    }
  }

  reveal();

  window.addEventListener("scroll", reveal);
}

document.addEventListener("DOMContentLoaded", revealOnScroll);
