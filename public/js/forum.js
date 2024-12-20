var slideIndex = 0;
showSlides();

function showSlides() {
    var i;
    var slides = document.getElementsByClassName("mySlides");
    for (i = 0; i < slides.length; i++) {
        slides[i].style.display = "none";  
    }
    slideIndex++;
    if (slideIndex > slides.length) {slideIndex = 1}
    slides[slideIndex-1].style.display = "block";  
    setTimeout(showSlides, 5000); // Change content every 5 seconds
}

document.addEventListener("DOMContentLoaded", function () {
    const commentLinks = document.querySelectorAll(".toggle-comment");

    commentLinks.forEach(link => {
        link.addEventListener("click", function (event) {
            event.preventDefault(); // Prevent default link behavior

            const parentPost = link.closest(".question-type2033");
            const commentsSection = parentPost.querySelector(".comments-section");

            // Toggle the visibility of the comments section
            commentsSection.style.display = commentsSection.style.display === "none" ? "block" : "none";
        });
    });
});

