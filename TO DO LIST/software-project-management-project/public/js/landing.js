let slideIndex = 0;

function showSlide(n) {
  let i;
  let slides = document.getElementsByClassName("slide");
  let dots = document.getElementsByClassName("dot");

  if (n >= slides.length) { slideIndex = 0; }
  if (n < 0) { slideIndex = slides.length - 1; }

  for (i = 0; i < slides.length; i++) {
    slides[i].style.display = "none";
  }

  for (i = 0; i < dots.length; i++) {
    dots[i].className = dots[i].className.replace(" active", "");
  }

  slides[slideIndex].style.display = "block";
  dots[slideIndex].className += " active";
}

function changeSlide(n) {
  slideIndex += n;
  showSlide(slideIndex);
}

function autoSlide() {
  slideIndex++;
  showSlide(slideIndex);
  setTimeout(autoSlide, 3000); // Change image every 3 seconds
}

function setSlide(n) {
  slideIndex = n - 1;
  showSlide(slideIndex);
}

// Initialize slideshow
showSlide(slideIndex);
autoSlide();

