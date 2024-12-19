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
    // Single event listener to handle both the comment box and comment icons
    const commentButtons = document.querySelectorAll(".fa-question-circle-o, .q-type238");

    commentButtons.forEach(button => {
        button.addEventListener("click", function (event) {
            event.preventDefault();

            const parentPost = button.closest(".question-type2033");
            let commentBox = parentPost.querySelector(".comment-box");
            const commentsList = parentPost.querySelector(".comments-lists");

            if (button.classList.contains("fa-question-circle-o")) {
                // Toggle comment box visibility
                if (commentBox) {
                    commentBox.style.display = commentBox.style.display === "none" ? "block" : "none";
                } else {
                    // Create a new comment box
                    commentBox = document.createElement("div");
                    commentBox.className = "comment-box";
                    commentBox.innerHTML = `
                        <textarea class="form-control mt-2" placeholder="Write your comment here..." rows="2"></textarea>
                        <button class="btn btn-comment btn-sm mt-2">Post Comment</button>
                    `;
                    parentPost.appendChild(commentBox);

                    // Add event listener for the "Post Comment" button
                    const postButton = commentBox.querySelector(".btn-comment");
                    postButton.addEventListener("click", function () {
                        const commentText = commentBox.querySelector("textarea").value.trim();

                        if (commentText) {
                            // Create a new comment element
                            const commentElement = document.createElement("div");
                            commentElement.className = "user-comment";
                            commentElement.innerHTML = `
                                <p class="comment-name">John Doe</p>
                                <p>${commentText}</p>
                            `;

                            // Append the new comment to the comments list
                            if (!commentsList) {
                                commentsList = document.createElement("div");
                                commentsList.className = "comments-lists";
                                parentPost.appendChild(commentsList);
                            }
                            commentsList.appendChild(commentElement);

                            // Clear the textarea and hide the comment box
                            commentBox.querySelector("textarea").value = "";
                            commentBox.style.display = "none";
                        } else {
                            alert("Please write a comment!");
                        }
                    });
                }
            } else if (button.classList.contains("q-type238")) {
                // Toggle comments list visibility
                commentsList.style.display = commentsList.style.display === "none" ? "block" : "none";
            }
        });
    });
});
