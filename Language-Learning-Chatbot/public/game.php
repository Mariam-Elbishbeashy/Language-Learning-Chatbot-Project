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
        <?php include "../views/partials/navbar.php"; ?>

        <div class="main-content">
            <div class="quiz-buttons">
                <div class="profile">
                    <img src="./images/1458201.png" alt="Profile Picture" class="profile-pic">
                    <span class="username">Hi Danish!</span>
                </div>
                <div class="points">
                    <img src="./images/star.png" alt="Points Picture" class="points-pic">
                    <span class="score" id="totalUserPoints"></span>
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

                            <form id="quizForm">
                                <div class="quiz-buttons">
                                    <!-- Question 1: Multiple Choice -->
                                    <div class="question">
                                        <p><strong>1. What is the opposite of 'hot'?</strong></p>
                                        <input type="radio" name="question1" value="Cold" required> Cold<br>
                                        <input type="radio" name="question1" value="Warm"> Warm<br>
                                        <input type="radio" name="question1" value="Cool"> Cool<br>
                                        <span class="feedback" id="feedback1"></span> <!-- Feedback placeholder -->
                                    </div>
                                    <img src="./images/quiz.png" alt="quiz picture">
                                </div>
                                <!-- Question 2: Fill in the Blank -->
                                <div class="question">
                                    <p><strong>2. I ___ to the store yesterday. (go)</strong></p>
                                    <input type="text" name="question2" required>
                                    <span class="feedback" id="feedback2"></span> <!-- Feedback placeholder -->
                                </div>

                                <!-- Question 3: True/False -->
                                <div class="question">
                                    <p><strong>3. The sky is blue. (True/False)</strong></p>
                                    <input type="radio" name="question3" value="True" required> True<br>
                                    <input type="radio" name="question3" value="False"> False<br>
                                    <span class="feedback" id="feedback3"></span> <!-- Feedback placeholder -->
                                </div>

                                <!-- Question 4: Multiple Choice -->
                                <div class="question">
                                    <p><strong>4. What is the plural of 'child'?</strong></p>
                                    <input type="radio" name="question4" value="Children" required> Children<br>
                                    <input type="radio" name="question4" value="Childs"> Childs<br>
                                    <input type="radio" name="question4" value="Childes"> Childes<br>
                                    <span class="feedback" id="feedback4"></span> <!-- Feedback placeholder -->
                                </div>

                                <!-- Question 5: Matching -->
                                <div class="question">
                                    <p><strong>5. Match the word with its meaning:</strong></p>
                                    <label for="match1">Happy:</label>
                                    <select name="question5" id="match1" required>
                                        <option value="">Select...</option>
                                        <option value="Sad">Sad</option>
                                        <option value="Joyful">Joyful</option>
                                        <option value="Angry">Angry</option>
                                    </select>
                                    <span class="feedback" id="feedback5"></span> <!-- Feedback placeholder -->
                                </div>
                                <div class="quiz-buttons" id="quizButtons">
                                    <button type="button" onclick="openConfirmSubmitPopup()">Submit</button>
                                    <button type="button" onclick="confirmCancel()">Cancel</button>
                                </div>
                            </form>
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
                            <div class="quiz-buttons">
                                <button onclick="submitQuiz()">Yes</button>
                                <button onclick="closeConfirmSubmitPopup()">No</button>
                            </div>
                        </div>
                    </div>
                    <!-- Score Popup -->
                    <div id="scorePopup" class="popup-overlay" onclick="closeScorePopup()">
                        <div class="popup-content" onclick="event.stopPropagation()">
                            <span class="close-btn" onclick="closeScorePopup()">×</span>
                            <img src="./images/test-results.png" alt="Reading"> 
                            <h2 id="scoreMessage" >Your Score</h2>
                            <div class="points" id="quiz-points">
                                <img src="./images/star.png" alt="Points Picture" class="points-pic" id="quiz-points-pic">
                                <span class="score" id="totalScore"></span>
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
                            <button onclick="showChallengePopup('Grammar Training Challenge - Present Simple Practice','Write a short diary entry describing a typical day. Use only present simple tense verbs to describe actions, routines, and preferences. Focus on accuracy and consistency with the present simple tense.')">Continue</button>
                        </div>
                        <img src="./images/robot-assistant.png" alt="Grammar Training">
                    </div>
                    <div class="card grammar">
                        <div class= "card-content">
                            <h3>Vocabulary Training Challenge</h3>
                            <p>3 lessons</p>
                            <button onclick="showChallengePopup('Vocabulary Training Challenge - Building Associations','Create a word web for the topic &quot;Daily Routine&quot;. List related words or phrases for each item, including activities, objects, or people involved in your routine.')">Continue</button>
                        </div>
                        <img src="./images/pinch.png" alt="Grammar Training">
                    </div>
                </div>
            </div>
            <!-- Challenge Popup  -->
            <div class="popup-overlay" id="challengePopupOverlay">
                <div class="popup-content">
                    <span class="close-btn" onclick="closeChallengePopup()">&times;</span>
                    <div class="quiz-buttons">
                        <h3 id="popupTitle"></h3>
                        <img class="challenge-pic" src="./images/effect.png" alt="target">
                    </div>
                    <div class="points" id="challenge-points">
                                <img src="./images/star.png" alt="Points Picture" class="points-pic" id="quiz-points-pic">
                                <span class="score" id="gamePoints">40</span>
                            </div>
                    <h4 id="popupDescription"></h4>
                    <button class="challenge-closeBtn" onclick="closeChallengePopup()">Close</button>
                </div>
            </div>

        </div>
    </div>
    <script src="./js/gameScript.js"></script>
</body>
</html>
