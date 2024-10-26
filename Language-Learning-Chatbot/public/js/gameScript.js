let totalUserPoints = 320;
document.getElementById("totalUserPoints").innerHTML = `${totalUserPoints}`;
function openPopup() {
    document.getElementById("popupOverlay").style.display = "flex"; // Show the quiz popup
}
function openConfirmSubmitPopup() {
    document.getElementById("confirmSubmitPopup").style.display = "flex"; // Show the quiz popup
}

let isSubmitted = false;
function confirmCancel() {

    if (isSubmitted) {
        closePopup(); // Close quiz popup if already submitted
    } else {
        document.getElementById("confirmPopup").style.display = "flex"; // Show confirmation popup if not submitted
    }
}




// Function to close both popups when confirming cancellation
function closeBothPopups() {
    closePopup(); // Close the quiz popup
    closeConfirmPopup(); // Close the confirmation popup
}
function submitQuiz() {
    let points = 0;
    closeConfirmSubmitPopup();
    isSubmitted = true;
    // Get the form and initialize score
    const form = document.getElementById("quizForm");
    let score = 0;

    // Correct answers for the quiz
    const correctAnswers = {
        question1: "Cold",
        question2: "went", 
        question3: "True",
        question4: "Children",
        question5: "Joyful"
    };

    // Check each question
    for (let i = 1; i <= 5; i++) {
        const question = "question" + i;
        const userAnswer = form[question].value;
        
        // Handle feedback for each question
        const feedbackElement = document.getElementById(`feedback${i}`);
        if (userAnswer) {
            if (userAnswer === correctAnswers[question]) {
                points +=5;
                score++;
                feedbackElement.innerHTML = "<span style='color: green;'>Correct!</span>";
            } else {
                feedbackElement.innerHTML = `<span style='color: red;'>Wrong! The correct answer is: ${correctAnswers[question]}</span>`;
            }
        } else {
            feedbackElement.innerHTML = "<span style='color: red;'>You must answer this question!</span>";
        }
    }

    // Show score popup
    document.getElementById("scoreMessage").innerText = `You scored ${score} out of 5!`;
    document.getElementById("totalScore").innerText = `${points}`;
    document.getElementById("scorePopup").style.display = "flex";

    // Optionally, you can add the score to the user's total points here.
    // addPoints(score); // Implement this function as needed

    const quizButtons = document.getElementById("quizButtons");
    quizButtons.innerHTML = '<button type="button" onclick="closePopup()">Close</button>';
    totalUserPoints+=points;
    document.getElementById("totalUserPoints").innerHTML = `${totalUserPoints}`;
}

function closePopup() {
    document.getElementById("popupOverlay").style.display = "none"; // Hide the quiz popup
}
function closeConfirmPopup() {
    document.getElementById("confirmPopup").style.display = "none"; // Hide the confirmation popup
}
function closeConfirmSubmitPopup() {
    document.getElementById("confirmSubmitPopup").style.display = "none"; // Hide the confirmation popup
}

function closeScorePopup() {
    document.getElementById("scorePopup").style.display = "none";
}