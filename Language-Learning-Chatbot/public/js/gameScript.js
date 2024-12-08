let totalUserPoints = 320;
document.getElementById("totalUserPoints").innerHTML = `${totalUserPoints}`;

function openPopup() {
    document.getElementById("popupOverlay").style.display = "flex"; // Show the quiz popup
}
function openGameSectionPopup() {
    document.getElementById("gamespopupOverlay").style.display = "flex"; // Show the games popup
}
function openConfirmSubmitPopup() {
    document.getElementById("confirmSubmitPopup").style.display = "flex"; // Show the quiz popup
}
function showChallengePopup(title, description) {
    document.getElementById("popupTitle").innerText = title;
    document.getElementById("popupDescription").innerText = description;
    document.getElementById("challengePopupOverlay").style.display = "flex";
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


    const quizButtons = document.getElementById("quizButtons");
    quizButtons.innerHTML = '<button type="button" onclick="closePopup()">Close</button>';
    totalUserPoints+=points;
    document.getElementById("totalUserPoints").innerHTML = `${totalUserPoints}`;
}


function openGameInfoPopup(title, description, points, imageSrc) {
    document.getElementById("gameTitle").innerText = title;
    document.getElementById("gameDescription").innerText = description;
    document.getElementById("gamePoints").innerText = points;
    document.getElementById("game-pic").src = imageSrc; 
    document.getElementById("gameInfoPopup").style.display = "flex"; 
}

function closeGameInfoPopup() {
    document.getElementById("gameInfoPopup").style.display = "none"; // Hide the game info popup
}

function startGame() {
    const title = document.getElementById("gameTitle").innerText;
    console.log("Starting game:", title);
    closeGameInfoPopup(); // Close the popup after showing game info
    hideAllGameContainers(); // Hide all game popups

    switch (title) {
        case 'Word Guessing Game':
            document.getElementById("wordGuessingGame").style.display = "flex"; 
            startWordGuessingGame(); // Start the Word Guessing Game
            break;
        case 'Spelling Bee Game':
            document.getElementById("spellingBeeGame").style.display = "flex"; 
            startSpellingBeeGame();
            break;
        case 'Word Association Game':
            document.getElementById("wordAssociationGame").style.display = "flex";
            startWordAssociationGame();
            break;
        case 'Scrambled Words Game':
            document.getElementById("scrambledWordsGame").style.display = "flex"; 
            startScrambledWordsGame();
            break;
    }
}

function hideAllGameContainers() {
    document.getElementById("wordGuessingGame").style.display = "none";
    document.getElementById("spellingBeeGame").style.display = "none";
    document.getElementById("wordAssociationGame").style.display = "none";
    document.getElementById("scrambledWordsGame").style.display = "none";
}
function closeGameContainer(gameId) {
    document.getElementById(gameId).style.display = "none"; // Hide the specific game container
}
//Word Guessing Game
const words = [
    { word: "apple", hint: "A fruit that is red or green" },
    { word: "dog", hint: "A common pet, known as man's best friend" },
    { word: "computer", hint: "An electronic device for processing data" },
    { word: "ocean", hint: "A large body of saltwater" },
    { word: "book", hint: "A set of written or printed pages" }
];

let currentWord;
let currentHint;

function startWordGuessingGame() {
    const randomIndex = Math.floor(Math.random() * words.length);
    currentWord = words[randomIndex].word;
    currentHint = words[randomIndex].hint;

    document.getElementById("hint").innerText = currentHint;
    document.getElementById("result").innerText = "";
    document.getElementById("guess").value = "";

    document.getElementById("wordGuessingGame").style.display = "flex"; 
}

document.getElementById("submit").addEventListener("click", function() {
    const userGuess = document.getElementById("guess").value.toLowerCase();
    if (userGuess === currentWord) {
        document.getElementById("result").innerText = "Congratulations! You guessed it!";
        startWordGuessingGame(); // Start a new game after guessing correctly
    } else {
        document.getElementById("result").innerText = "Try again!";
    }
});


//Spelling Bee Game
const spellingWords = [
    { word: "accommodate", correct: "accommodate" },
    { word: "definitely", correct: "definitely" },
    { word: "independent", correct: "independent" },
    // More words will be added as needed
];

let currentSpellingIndex = 0;

function startSpellingBeeGame() {
    currentSpellingIndex = 0;
    document.getElementById("spelling-result").innerText = "";
    displaySpellingWord();
    document.getElementById("spellingBeeGame").style.display = "flex";
}

function displaySpellingWord() {
    const currentWord = spellingWords[currentSpellingIndex];
    const wordDisplay = document.getElementById("spelling-word");
    const resultDisplay = document.getElementById("spelling-result");

    wordDisplay.innerText = currentWord.word;

    // Hide the word after 3 seconds
    setTimeout(() => {
        wordDisplay.innerText = "___";
    }, 3000);
}

document.getElementById("submit-spelling").onclick = function() {
    const guess = document.getElementById("spelling-guess").value;
    const correctWord = spellingWords[currentSpellingIndex].correct;
    const resultDisplay = document.getElementById("spelling-result");

    // Check if the guess is correct and display feedback
    if (guess.toLowerCase() === correctWord.toLowerCase()) {
        resultDisplay.innerText = "Correct!";
    } else {
        resultDisplay.innerText = `Wrong! The correct spelling is "${correctWord}".`;
    }

    // Show feedback for 3 seconds, then clear it and display the next word
    setTimeout(() => {
        resultDisplay.innerText = ""; // Clear feedback
        currentSpellingIndex++; // Move to the next word

        if (currentSpellingIndex < spellingWords.length) {
            displaySpellingWord(); // Display the next word
            document.getElementById("spelling-guess").value = ""; // Clear the input
        } else {
            resultDisplay.innerText = "Spelling Bee completed!";
        }
    }, 3000); // Show feedback for 3 seconds
}


//Word Association Game
const associationWords = [
        { word: "Ocean", related: "Water" },
        { word: "Sun", related: "Light" },
        { word: "Tree", related: "Leaf" },
       // More words will be added as needed
    ];

    let currentAssociationIndex = 0;

    function startWordAssociationGame() {
        currentAssociationIndex = 0;
        document.getElementById("association-result").innerText = "";
        displayAssociationWord();
        document.getElementById("wordAssociationGame").style.display = "flex"; 
    }

    function displayAssociationWord() {
        const currentWord = associationWords[currentAssociationIndex];
        document.getElementById("association-word").innerText = currentWord.word;
        document.getElementById("association-guess").value = ""; // Clear previous input
    }

    document.getElementById("submit-association").onclick = function() {
        const guess = document.getElementById("association-guess").value;
        const correctWord = associationWords[currentAssociationIndex].related;

        if (guess.toLowerCase() === correctWord.toLowerCase()) {
            document.getElementById("association-result").innerText = "Correct!";
        } else {
            document.getElementById("association-result").innerText = `Wrong! A related word is "${correctWord}".`;
        }

        currentAssociationIndex++;
        if (currentAssociationIndex < associationWords.length) {
            displayAssociationWord();
        } else {
            document.getElementById("association-result").innerText += " Word Association completed!";
        }
    }


    //Scrambled Words Game
    const scrambledWords = [
        { word: "apple", scrambled: "leapp" },
        { word: "banana", scrambled: "nanaab" },
        { word: "cherry", scrambled: "yrceh" },
        { word: "grape", scrambled: "earpg" },
        { word: "orange", scrambled: "geonra" }
        // More words will be added as needed
    ];
    
    let currentScrambledIndex = 0;
    
    function startScrambledWordsGame() {
        currentScrambledIndex = 0;
        document.getElementById("scrambled-result").innerText = "";
        displayScrambledWord(); // to display the first scrambled word
        document.getElementById("scrambledWordsGame").style.display = "flex"; 
    }
    
    function displayScrambledWord() {
        if (currentScrambledIndex < scrambledWords.length) {
            const currentWord = scrambledWords[currentScrambledIndex];
            document.getElementById("scrambled-word").innerText = currentWord.scrambled;
            document.getElementById("scrambled-guess").value = ""; // Clear previous input
        }
    }
    
    document.getElementById("submit-scrambled").onclick = function() {
        const guess = document.getElementById("scrambled-guess").value;
        const correctWord = scrambledWords[currentScrambledIndex].word;
    
        if (guess.toLowerCase() === correctWord.toLowerCase()) {
            document.getElementById("scrambled-result").innerText = "Correct!";
        } else {
            document.getElementById("scrambled-result").innerText = `Wrong! The correct word is "${correctWord}".`;
        }
        setTimeout(() => {
            document.getElementById("scrambled-result").innerText = "";
        }, 2000);
        currentScrambledIndex++;
        
        // Check if there are more words to display
        if (currentScrambledIndex < scrambledWords.length) {
            displayScrambledWord(); // Display the next scrambled word
        } else {
            document.getElementById("scrambled-result").innerText += " Game completed!";
            // Optionally, reset the game or show total score
        }
    }


function closePopup() {
    document.getElementById("popupOverlay").style.display = "none"; 
}
function closeConfirmPopup() {
    document.getElementById("confirmPopup").style.display = "none"; 
}
function closeConfirmSubmitPopup() {
    document.getElementById("confirmSubmitPopup").style.display = "none"; 
}

function closeScorePopup() {
    document.getElementById("scorePopup").style.display = "none";
}

function closeGamesPopup() {
    document.getElementById("gamespopupOverlay").style.display = "none";
}
function closeChallengePopup() {
    document.getElementById("challengePopupOverlay").style.display = "none";
}
