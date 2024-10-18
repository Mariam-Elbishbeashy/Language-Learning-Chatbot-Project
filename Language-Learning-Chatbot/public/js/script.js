const hamburger = document.getElementById('hamburger');
const navLinks = document.getElementById('nav-links');

hamburger.addEventListener('click', () => {
  navLinks.classList.toggle('active');
});

let slideIndex = 0;

function showSlides() {
    const slides = document.getElementsByClassName("slide");
    const dots = document.getElementsByClassName("dot");

    // Hide all slides
    for (let i = 0; i < slides.length; i++) {
        slides[i].style.display = "none";
    }

    // Remove the "active" class from all dots
    for (let i = 0; i < dots.length; i++) {
        dots[i].classList.remove("active");
    }

    slideIndex++;

    // Reset the index if it exceeds the total number of slides
    if (slideIndex > slides.length) {
        slideIndex = 1;
    }

    // Display the current slide and add the "active" class to the corresponding dot
    slides[slideIndex - 1].style.display = "flex"; // Flex layout for hero content
    dots[slideIndex - 1].classList.add("active");

    setTimeout(showSlides, 3000);
}

// Show a specific slide when a dot is clicked
function currentSlide(n) {
    const slides = document.getElementsByClassName("slide");
    const dots = document.getElementsByClassName("dot");

    // Hide all slides
    for (let i = 0; i < slides.length; i++) {
        slides[i].style.display = "none";
    }

    // Remove the "active" class from all dots
    for (let i = 0; i < dots.length; i++) {
        dots[i].classList.remove("active");
    }

    // Show the clicked slide and activate the corresponding dot
    slides[n - 1].style.display = "flex";
    dots[n - 1].classList.add("active");

    // Reset slideIndex to the selected slide
    slideIndex = n;
}

// Initialize slideshow
showSlides();