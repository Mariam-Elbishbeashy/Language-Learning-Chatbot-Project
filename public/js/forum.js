document.addEventListener("DOMContentLoaded", function () {
    const commentLinks = document.querySelectorAll(".q-type238");

    commentLinks.forEach(link => {
        link.addEventListener("click", function (event) {
            event.preventDefault(); // Prevent default link behavior

            const parentPost = link.closest(".question-type2033");
            const commentsList = parentPost.querySelector(".comments-lists");

            // Log for debugging
            console.log('Toggle button clicked');
            console.log('Parent Post:', parentPost);
            console.log('Comments List:', commentsList);

            if (commentsList) {
                // Toggle the visibility of the comments list
                commentsList.style.display = commentsList.style.display === "block" ? "none" : "block";
                // Additional log for state change
                console.log('Comments List new state:', commentsList.style.display);
            } else {
                console.log('Comments list not found');
            }
        });
    });

    const commentSections = document.querySelectorAll(".toggle-comment");

    commentSections.forEach(link => {
        link.addEventListener("click", function (event) {
            event.preventDefault(); // Prevent default link behavior

            const parentPost = link.closest(".question-type2033");
            const commentsSection = parentPost.querySelector(".comments-section");

            console.log('Toggle comment clicked');
            console.log('Parent Post:', parentPost);
            console.log('Comments Section:', commentsSection);

            if (commentsSection) {
                // Toggle the visibility of the comments section
                commentsSection.style.display = commentsSection.style.display === "block" ? "none" : "block";
                console.log('Comments Section toggled');
            } else {
                console.log('Comments Section not found');
            }
        });
    });
});

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
