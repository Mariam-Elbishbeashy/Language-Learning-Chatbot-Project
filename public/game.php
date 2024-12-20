<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
session_start();
require_once '../Language-Learning-Chatbot/controllers/QuizzesController.php';
require_once '../Language-Learning-Chatbot/model/QuizzesModel.php';
require_once '../Language-Learning-Chatbot/db/dbh.inc.php';
require_once '../Language-Learning-Chatbot/controllers/ChallengesController.php';
require_once '../Language-Learning-Chatbot/model/ChallengesModel.php';

// Instantiate the controller
$challengeModel = new ChallengesModel($conn);
$controller = new ChallengesController($challengeModel);


if (!isset($_SESSION['userId'])) {
    header("Location: ../public/error.php");
    exit();
}

$quizModel = new QuizModel($conn);
$quizController = new QuizzesController($quizModel);

$userId = $_SESSION['userId']; // Get the logged-in user's ID from the session

// Variables to store quiz data and results
$isSubmitted = false;


$mcqQuestions = $quizModel->getQuestionsForUser($userId, 'MCQ');
$fillInTheBlankQuestion = $quizModel->getQuestionsForUser($userId, 'fill-in-the-blank')[0] ?? null;
$trueFalseQuestion = $quizModel->getQuestionsForUser($userId, 'true/false')[0] ?? null;


$quizQuestions = [
    'mcq1' => $mcqQuestions[0] ?? null,
    'mcq2' => $mcqQuestions[1] ?? null,
    'mcq3' => $mcqQuestions[2] ?? null,
    'fillInTheBlank' => $fillInTheBlankQuestion,
    'trueFalse' => $trueFalseQuestion
];


$feedback = [];
$isSubmitted = false;
$userAnswers = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['final_submit_quiz'])) {
    // Get user answers
    $userAnswers = $_POST['answers'] ?? [];

    // Pass data to the controller
    $quizResult = $quizController->handleQuizSubmission($quizQuestions, $userAnswers, $userId);

    // Extract feedback and score from the result
    $feedback = $quizResult['feedback'];
    $score = $quizResult['score'];

    // Store feedback and score in the session if needed
    $_SESSION['feedback'] = $feedback;
    $_SESSION['score'] = $score;
    $isSubmitted = true;
}

?>
<style>
      #confirmSubmitChallengePopup .popup-content{
    width: 20%;
    height: 30%;
    text-align: center;
  }
  #confirmSubmitVocabChallengePopup .popup-content{
  width: 20%;
  height: 30%;
  text-align: center;
}
#VocabscorePopup .popup-content {
    width: 20%;
    height: 40%;
    text-align: center;
  }
  #GrammarscorePopup .popup-content {
    width: 20%;
    height: 40%;
    text-align: center;
  }
</style>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chatrock</title>
    <link rel="stylesheet" href="./css/Stylehome.css">
    <link rel="stylesheet" href="./css/stylegame.css">

</head>
<body>
    
    <div class="container">
        
        <?php include "../Language-Learning-Chatbot/views/partials/navbar.php"; ?>
        <div class="main-content">
            <div class="quiz-buttons">
                <div class="profile">
                    <img src="../public/<?= $_SESSION['profileImage'] ?? '../public/images/user.png' ?>" alt="Profile Picture" class="profile-pic">
                    <span class="username">Hi <?=$_SESSION['firstName']?>!</span>
                </div>
                <div class="points">
                    <img src="./images/star.png" alt="Points Picture" class="points-pic">
                    <span class="score" id="totalUserPoints"><?= $_SESSION['score']?></span>
                </div>
            </div>
            <div class="plan-section">
            <h2>Your Today's Plan</h2>
            <div class="cards">
                <div class="card listening">
                    <div class= "card-content">
                        <h3>Quizzes</h3>
                        <p>     
                            <div class="points">
                                <img src="./images/star.png" alt="Points Picture" class="points-pic" id="quiz-total-points-pic">
                                <span class="score" id="quiz-total-points-score" >25</span>
                            </div>
                        </p>
                        <button onclick="openPopup()">Start</button>
                    </div>
                    <img src="./images/online-exam.png" alt="Listening">
                        <div id="popupOverlay" class="popup-overlay" onclick="confirmCancel()">
                            <div class="popup-content" onclick="event.stopPropagation()">
                                <span class="close-btn" onclick="confirmCancel()">&times;</span>
                                <form id="quizForm" method="POST" action="game.php">
                                    <?php if ($quizQuestions): ?>
                                        <?php foreach ($quizQuestions as $key => $question): ?>
                                            <?php if ($question): ?>
                                                <div class="question">
                                                    <p><strong><?= htmlspecialchars($question['question_text']) ?></strong></p>

                                                    <?php if ($question['question_type'] == 'MCQ'): ?>
                                                        <input type="radio" name="answers[<?= $question['question_id'] ?>]" value="<?= htmlspecialchars($question['option_a']) ?>" <?= isset($userAnswers[$question['question_id']]) && $userAnswers[$question['question_id']] == $question['option_a'] ? 'checked' : '' ?> required> <?= htmlspecialchars($question['option_a']) ?><br>
                                                        <input type="radio" name="answers[<?= $question['question_id'] ?>]" value="<?= htmlspecialchars($question['option_b']) ?>" <?= isset($userAnswers[$question['question_id']]) && $userAnswers[$question['question_id']] == $question['option_b'] ? 'checked' : '' ?>> <?= htmlspecialchars($question['option_b']) ?><br>
                                                        <input type="radio" name="answers[<?= $question['question_id'] ?>]" value="<?= htmlspecialchars($question['option_c']) ?>" <?= isset($userAnswers[$question['question_id']]) && $userAnswers[$question['question_id']] == $question['option_c'] ? 'checked' : '' ?>> <?= htmlspecialchars($question['option_c']) ?><br>
                                                        <input type="radio" name="answers[<?= $question['question_id'] ?>]" value="<?= htmlspecialchars($question['option_d']) ?>" <?= isset($userAnswers[$question['question_id']]) && $userAnswers[$question['question_id']] == $question['option_d'] ? 'checked' : '' ?>> <?= htmlspecialchars($question['option_d']) ?><br>
                                                    <?php elseif ($question['question_type'] == 'fill-in-the-blank'): ?>
                                                        <input type="text" name="answers[<?= $question['question_id'] ?>]" value="<?= htmlspecialchars($userAnswers[$question['question_id']] ?? '') ?>" required>
                                                    <?php elseif ($question['question_type'] == 'true/false'): ?>
                                                        <input type="radio" name="answers[<?= $question['question_id'] ?>]" value="True" <?= isset($userAnswers[$question['question_id']]) && $userAnswers[$question['question_id']] == 'True' ? 'checked' : '' ?>> True<br>
                                                        <input type="radio" name="answers[<?= $question['question_id'] ?>]" value="False" <?= isset($userAnswers[$question['question_id']]) && $userAnswers[$question['question_id']] == 'False' ? 'checked' : '' ?>> False<br>
                                                    <?php endif; ?>
                                                </div>
                                            <?php endif; ?>
                                        <?php endforeach; ?>
                                    <?php else: ?>
                                        <p>No quiz questions available.</p>
                                    <?php endif; ?>

                                    <div class="quiz-buttons">
                                        <button type="submit" name="final_submit_quiz" >Submit</button>
                                        <button type="button" onclick="confirmCancel()">Cancel</button>
                                    </div>
                                </form>

                                <?php if ($isSubmitted): ?>
                                    <h3>Quiz Feedback</h3>
                                    <?php foreach ($feedback as $questionId => $item): ?>
                                        <div class="question-feedback">
                                            <?php
                                            $questionText = null;
                                            foreach ($quizQuestions as $question) {
                                                if ($question && $question['question_id'] == $questionId) {
                                                    $questionText = htmlspecialchars($question['question_text']);
                                                    break;
                                                }
                                            }
                                            ?>
                                            <p><strong>Question: <?= $questionText ?: 'Question not found' ?></strong></p>
                                            <?php if ($item['is_correct']): ?>
                                                <span style="color: green;">Correct!</span>
                                            <?php else: ?>
                                                <span style="color: red;">Incorrect! Correct answer: <?= htmlspecialchars($item['correct_answer'] ?? 'N/A') ?></span>
                                            <?php endif; ?>
                                        </div>
                                    <?php endforeach; ?>
                                    <p>Total Score: <?= $_SESSION['score'] ?? 0 ?> out of 5!</p>

                                <?php endif; ?>
                            </div>
                    </div>
                    <!-- Confirmation Popup -->
                    <div id="confirmPopup" class="popup-overlay" onclick="closeConfirmPopup()">
                        <div class="popup-content" onclick="event.stopPropagation()">
                            <span class="close-btn" onclick="closeConfirmPopup()">×</span>
                            <img src="./images/research.png" alt="confirmation"> 
                            <h2>Are you sure you want to cancel?</h2>
                            <p>Your answers will not be saved, and points will not be added.</p>
                            <div class="quiz-buttons">
                                <button onclick="closeBothPopups()">Yes</button>
                                <button onclick="closeConfirmPopup()">No</button>
                            </div>

                        </div>
                    </div>
                    <div id="confirmSubmitPopup" class="popup-overlay" onclick="closeConfirmPopup()">
                        <div class="popup-content" onclick="event.stopPropagation()">
                            <span class="close-btn" onclick="closeConfirmPopup()">×</span>
                            <img src="./images/research.png" alt="confirmation"> 
                            <h2>Are you sure you want to submit?</h2>   
                            <form id="confirmSubmit" method="POST" action="game.php">          
                            <div class="quiz-buttons">
                                <button type="submit" name="submit_quiz" onclick="submitQuiz()">Yes</button>
                                <button onclick="closeConfirmSubmitPopup()">No</button>
                            </div>
                            </form>
                        </div>
                    </div>
                    <!-- Score Popup -->
                    <div id="scorePopup" class="popup-overlay" onclick="closeScorePopup()">
                        <div class="popup-content" onclick="event.stopPropagation()">
                            <span class="close-btn" onclick="closeScorePopup()">×</span>
                            <img src="./images/test-results.png" alt="Reading"> 
                            <h2 id="scoreMessage" >You scored <?= htmlspecialchars($_SESSION['score']) ?> out of 5!</h2>
                            <div class="points" id="quiz-points">
                                <img src="./images/star.png" alt="Points Picture" class="points-pic" id="quiz-points-pic">
                                <span class="score" id="totalScore"><?= htmlspecialchars($_SESSION['score']) ?></span>
                            </div>
                            <p>Points are added to your score.</p>
                            <button onclick="closeScorePopup()">Close</button>
                        </div>
                    </div>
                </div>
                <div class="card reading">
                    <div class= "card-content">
                        <h3>Reading</h3>
                        <p>1290 Characters</p>
                        <form action="reading.php">
                         <button href>Start</button>
                        </form>
                    </div>
                    <img src="./images/chat-app.png" alt="Reading"> 
                </div>
                <div class="card learn-words">
                    <div class= "card-content"> 
                        <h3>Games</h3>
                        <p>4 Vocabulary Games</p>
                        <button onclick="openGameSectionPopup()">Start</button>
                    </div>
                    <img src="./images/struggle.png" alt="Learn Words">
                    <!-- Games options popup -->
                    <div id="gamespopupOverlay" class="popup-overlay" onclick="closeGamesPopup()">
                        <div class="popup-content" onclick="event.stopPropagation()">
                            <span class="close-btn" onclick="closeGamesPopup()">&times;</span>

                            <form id="gamesForm">
                                <div class="quiz-buttons">
                                    <h2>Select a Game</h2>
                                    <img src="./images/game-console.png" class="games-pic" alt="Learn Words">
                                </div>
                                <ul>
                                    <li><button type="button" onclick="openGameInfoPopup('Word Guessing Game', 'Guess the word based on the hint.', 40, './images/ask.png')">Word Guessing Game</button></li>
                                    <li><button type="button" onclick="openGameInfoPopup('Spelling Bee Game', 'Spell the word correctly, the word will appear only for 3 seconds.', 15,'./images/bee.png')">Spelling Bee Game</button></li>
                                    <li><button type="button" onclick="openGameInfoPopup('Word Association Game', 'Match words to their meanings.', 20, './images/link.png')">Word Association Game</button></li>
                                    <li><button type="button" onclick="openGameInfoPopup('Scrambled Words Game', 'Unscramble the letters to form the correct word.', 30, './images/shuffle-arrows.png')">Scrambled Words Game</button></li>
                                </ul>
                            </form>
                        </div>
                    </div>

                    <!-- Game Info Popup -->
                    <div id="gameInfoPopup" class="popup-overlay" onclick="closeGameInfoPopup()">
                        <div class="popup-content" onclick="event.stopPropagation()">
                            <span class="close-btn" onclick="closeGameInfoPopup()">&times;</span>
                            <img class="games-pic" alt="Learn Words" id="game-pic">
                            <h2 id="gameTitle"></h2>
                            <p id="gameDescription"></p>
                            <div class="points" id="quiz-points">
                                <img src="./images/star.png" alt="Points Picture" class="points-pic" id="quiz-points-pic">
                                <span class="score" id="gamePoints"></span>
                            </div>
                            <button onclick="startGame()">Start</button>
                        </div>
                    </div>
                    <!-- Word Guessing Game Popup -->
                    <div id="wordGuessingGame" class="popup-overlay" style="display: none;">
                        <div class="popup-content">
                            <span class="close-btn" onclick="closeGameContainer('wordGuessingGame')">&times;</span>
                            <p id="hint"></p>
                            <input type="text" id="guess" placeholder="Type your guess here" />
                            <button id="submit">Submit Guess</button>
                            <p id="result"></p>
                        </div>
                    </div>

                    <!-- Spelling Bee Game Popup -->
                    <div id="spellingBeeGame" class="popup-overlay" style="display: none;">
                        <div class="popup-content">
                            <span class="close-btn" onclick="closeGameContainer('spellingBeeGame')">&times;</span>
                            <h2>Spelling Bee</h2>
                            <p id="spelling-word"></p>
                            <input type="text" id="spelling-guess" placeholder="Type your guess here" />
                            <button id="submit-spelling">Submit Guess</button>
                            <p id="spelling-result"></p>
                        </div>
                    </div>

                    <!-- Word Association Game Popup -->
                    <div id="wordAssociationGame" class="popup-overlay" style="display: none;">
                        <div class="popup-content">
                            <span class="close-btn" onclick="closeGameContainer('wordAssociationGame')">&times;</span>
                            <h2>Word Association</h2>
                            <p id="association-word"></p>
                            <input type="text" id="association-guess" placeholder="Type your related word here" />
                            <button id="submit-association">Submit</button>
                            <p id="association-result"></p>
                        </div>
                    </div>
                    <!-- Scrambled Words Game Popup -->
                    <div id="scrambledWordsGame" class="popup-overlay" style="display: none;">
                        <div class="popup-content">
                            <span class="close-btn" onclick="closeGameContainer('scrambledWordsGame')">&times;</span>
                            <h2>Scrambled Words Game</h2>
                            <p id="scrambled-word"></p>
                            <input type="text" id="scrambled-guess" placeholder="Type your guess here" />
                            <button id="submit-scrambled">Submit Guess</button>
                            <p id="scrambled-result"></p>
                        </div>
                    </div>

                </div>
            </div>
            </div>

            <div class="training-section">
                <h2>Training</h2>
                <div class="cards">
                    <div class="card grammar">
                        <div class= "card-content">
                            <h3>Grammar Training challenge</h3>
                            <p>Present Simple</p>
                            <button onclick="showGrammarChallengePopup()">Continue</button>
                        </div>
                        <img src="./images/robot-assistant.png" alt="Grammar Training">
                    </div> 
                    <div class="card grammar">
                        <div class= "card-content">
                            <h3>Vocabulary Training Challenge</h3>
                            <p>3 lessons</p>
                            <button onclick="showVocabChallengePopup()">Continue</button>
                        </div>
                        <img src="./images/pinch.png" alt="Grammar Training">
                    </div>
                </div>
            </div>
            <!-- Grammar Challenge Popup  -->
            <div class="popup-overlay" id="grammarchallengePopupOverlay" onclick="confirmCancelChallenge()" style="display: none; z-index:200;">
                <div class="popup-content" onclick="event.stopPropagation()">
                    <span class="close-btn"  onclick="confirmCancelChallenge()">&times;</span>
                    <form id="challengeForm">

                        <div class="challenge-buttons">
                            <h3 id="popupTitle">
                                Grammar Training Challenge - Present Simple Practice'
                            </h3>
                            <img class="challenge-pic" src="./images/effect.png" alt="target">
                        </div>
                        <div class="points" id="challenge-points">
                                    <img src="./images/star.png" alt="Points Picture" class="points-pic" id="quiz-points-pic">
                                    <span class="score" id="gamePoints">40</span>
                        </div>
                        <h4 id="popupDescription">
                        <?php   
                            $userId = $_SESSION['userId'];
                            $category = 'grammar';
                            $questionText = $controller->getQuestionForUser($userId, $category);      
                        ?>
                        </h4>
                        <!-- Added Textarea for User Input -->
                        <textarea id="challengeResponse" placeholder="Write your response here..." rows="6" style="width: 100%;"></textarea>
                        <div class="quiz-buttons" id="quizButtons">
                            <button type="button" onclick="openConfirmSubmitChallengePopup()">Submit</button>
                            <button type="button" onclick="confirmCancelChallenge()">Cancel</button>
                        </div>
                    </form>
                </div>
            </div>
            <!-- Challenges Submit Confirm Popup 1 -->
            <div id="confirmSubmitChallengePopup" class="popup-overlay" onclick="closeConfirmSubmitChallengePopup()">
                <div class="popup-content" onclick="event.stopPropagation()">
                    <span class="close-btn" onclick="closeConfirmSubmitChallengePopup()">×</span>
                    <img class="Csubmit-pic" src="./images/research.png" alt="confirmation"> 
                    <h2>Are you sure you want to submit?</h2>
                    <div class="quiz-buttons">
                        <button onclick="submitGrammarChallenge()">Yes</button>
                        <button onclick="closeConfirmSubmitChallengePopup()">No</button>
                    </div>
                </div>
            </div>
            <!--Challenge Score Popup -->
            <div id="GrammarscorePopup" class="popup-overlay" onclick="closeGrammarScorePopup()">
                <div class="popup-content" onclick="event.stopPropagation()">
                    <span class="close-btn" onclick="closeGrammarScorePopup()">×</span>
                    <img src="./images/test-results.png" alt="Reading" style="width: 110px; height: 120px;"> 
                    <h2 id="scoreMessage" >Your Score</h2>
                    <div class="points" id="quiz-points">
                        <img src="./images/star.png" alt="Points Picture" class="points-pic" id="quiz-points-pic">
                        <span class="score" id="totalScore">
                            <!-- Score hereeee -->
                        </span>
                    </div>
                    <p>Points are added to your score.</p>
                    <button onclick="closeGrammarScorePopup()">Close</button>
                </div>
            </div>
            <!-- Vocabulary Challenge Popup  -->
            <div class="popup-overlay" id="vocabchallengePopupOverlay" onclick="confirmCancelChallenge()" style="display: none; z-index:200;">
                <div class="popup-content" onclick="event.stopPropagation()">
                    <span class="close-btn"  onclick="confirmCancelChallenge()">&times;</span>
                    <form id="challengeForm">

                        <div class="challenge-buttons">
                            <h3 id="vocabpopupTitle">
                                Vocabulary Training Challenge - Building Associations
                            </h3>
                            <img class="challenge-pic" src="./images/effect.png" alt="target">
                        </div>
                        <div class="points" id="challenge-points">
                                    <img src="./images/star.png" alt="Points Picture" class="points-pic" id="quiz-points-pic">
                                    <span class="score" id="gamePoints">40</span>
                        </div>
                        <h4 id="vocabpopupDescription">
                        <?php   
                            $userId = $_SESSION['userId'];
                            $category = 'vocabulary';
                            $questionText = $controller->getQuestionForUser($userId, $category);      
                        ?>                        </h4>
                        <!-- Added Textarea for User Input -->
                        <textarea id="challengeResponse" placeholder="Write your response here..." rows="6" style="width: 100%;"></textarea>
                        <div class="quiz-buttons" id="quizButtons">
                            <button type="button" onclick="openConfirmSubmitVocabChallengePopup()">Submit</button>
                            <button type="button" onclick="confirmCancelChallenge()">Cancel</button>
                        </div>
                    </form>
                </div>
            </div>
             <!-- Challenges Submit Confirm Popup 2 (For Vocabulary) -->
             <div id="confirmSubmitVocabChallengePopup" class="popup-overlay" onclick="closeConfirmSubmitVocabChallengePopup()">
                <div class="popup-content" onclick="event.stopPropagation()">
                    <span class="close-btn" onclick="closeConfirmSubmitVocabChallengePopup()">×</span>
                    <img class="Csubmit-pic" src="./images/research.png" alt="confirmation"> 
                    <h2>Are you sure you want to submit?</h2>
                    <div class="quiz-buttons">
                        <button onclick="submitVocabChallenge()">Yes</button>
                        <button onclick="closeConfirmSubmitVocabChallengePopup()">No</button>
                    </div>
                </div>
            </div>
            <!--Challenge Score Popup (For Vocabulary) -->
            <div id="VocabscorePopup" class="popup-overlay" onclick="closeVocabScorePopup()">
                <div class="popup-content" onclick="event.stopPropagation()">
                    <span class="close-btn" onclick="closeVocabScorePopup()">×</span>
                    <img src="./images/test-results.png" alt="Reading" class="score-result-pic" style="width: 110px; height: 120px;"> 
                    <h2 id="scoreMessage" >Your Score</h2>
                    <div class="points" id="quiz-points">
                        <img src="./images/star.png" alt="Points Picture" class="points-pic" id="vocab-points-pic">
                        <span class="score" id="totalScore">
                            <!-- Score hereeee -->
                        </span>
                    </div>
                    <p>Points are added to your score.</p>
                    <button onclick="closeVocabScorePopup()">Close</button>
                </div>
            </div>

        </div>
    </div>
    <script src="./js/gameScript.js"></script>
</body>
</html>