<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chatrock</title>
    <link rel="stylesheet" href="./css/Stylehome.css">
    <link rel="stylesheet" href="./css/stylegame.css">
    <link rel="stylesheet" href="./css/styleReading.css">

</head>
<body>
    <div class="container">
        <?php include "../Language-Learning-Chatbot/views/partials/navbar.php"; ?>
        
        <div class="main-content">
            <form action="game.php">
                <button class="back-button">Back</button>
            </form>
            <div class="article-container">
                <h2>Bonfire Night</h2>
                <p>
                    <!-- Article content here -->
                     <p>
                        If you're ever in the UK on the evening of 5 November, you might wonder why you can hear fireworks. Bonfire Night is celebrated all over the country, but what is it about? Find out about the history of this well-loved event in this article.
                    </p>
                    <p>
                        Bonfire Night can be a hard celebration to explain. It’s also sometimes called Guy Fawkes Night – but who was Guy Fawkes and what’s it all about? Well, Guy Fawkes tried to blow up London’s Houses of Parliament in 1605 because he wanted to kill King James I. So British people celebrate that night, 5 November, with bonfire parties, including huge bonfires in public parks, and firework displays.
                    </p>
                    <p>
                        But isn’t it strange to celebrate a plot to kill the king?
                    </p>
                    <p>
                        Well, yes, it would be. But if you know more about the history of Bonfire Night and the Gunpowder Plot, its traditions make more sense. You see, the first Bonfire Night, on 5 November 1606, wasn’t exactly a celebration. It was a warning: ‘This is what happens if you commit treason.’
                    </p>
                    <h3>
                        Who was Guy Fawkes?
                    </h3>
                    <p>
                        Guy Fawkes was a soldier and he was not the only person involved in the plot to blow up Parliament. He made his plan with a group of 12 English Catholic gentlemen. The leader was Sir Robert Catesby. As a soldier, Fawkes was in charge of the gunpowder. The men rented a room underneath Parliament and filled 36 barrels with gunpowder – probably about 2,500 kilograms. Fawkes stayed to blow up the barrels and then escape. But someone sent a letter to Lord Monteagle, a Catholic, to tell him not to go to Parliament that day. In this way, the plot was discovered, and Guy Fawkes was caught before he could carry it out.
                    </p>
                    <p>
                        All the members of the plot were either killed or arrested and then killed in public. Parliament ordered a national day to give thanks for the safety of the king on 5 November. People had to go to church and they celebrated with a big bonfire. By the 1650s, the celebration included fireworks and later a ‘guy’ – a man made of straw and old clothes and burned on the bonfire.
                    </p>
                    <h3>
                        Why was there a plot?
                    </h3>
                    <p>
                        Guy Fawkes and the other members of the plot didn’t like the way Protestant James I (and Queen Elizabeth I before him) treated Catholics like them. At that time, Catholics couldn’t have their own churches. They had to practise their religion in secret, and it was very dangerous if they were caught. The Gunpowder Plot was not the first Catholic plan to try to kill the king, but it was the biggest. Afterwards, many people were suspicious of Catholics, even as late as the 18th and 19th centuries. This was very unfair, as most Catholics were peaceful and were also shocked by the plots.
                    </p>
                    <h3>
                        Bonfire Night today
                    </h3>
                    <p>
                        The celebrations have remained mostly the same for hundreds of years, although people nowadays don’t go to church as part of the day. Most towns and villages organise public displays where you can stand by huge bonfires and watch the fireworks as you eat a toffee apple or a hot snack. Many children learn this poem about Bonfire Night at school, and they look forward to a special evening out:
                    </p>
                    <blockquote>
                        <p>
                        Remember, remember the 5th of November,
                        <br>
                        Gunpowder, treason and plot.
                        <br>
                        I see no reason why gunpowder treason
                        <br>
                        Should ever be forgot.
                        <br>
                        So if you’re ever in the UK on 5 November, you’ll now know what all the noise is about!
                        </p>
                    </blockquote>
                </p>
                
            </div>
            
            
            <div class="notes-container">
                <div class="quiz-buttons">
                    <h3>Your Notes</h3>
                    <img class="note-pic" src="./images/note.png" alt="Note Picture">
                </div>
                <ul id="notesList">
                    <!-- List of user notes will be dynamically added here -->
                </ul>

                <div class="input-container">
                    <input type="text" id="noteInput" placeholder="Enter new word or note">
                    <button onclick="addNote()">Add Note</button>
                    <button class="complete-button" onclick="showScorePopup()">Complete</button>
                </div>
            </div>
            <!-- Score Popup -->
            <div id="scorePopup" class="popup-overlay" onclick="closeScorePopup()">
                <div class="popup-content" onclick="event.stopPropagation()">
                    <span class="close-btn" onclick="closeScorePopup()">×</span>
                    <img src="./images/test-results.png" alt="Reading" class="result-pic"> 
                    <h2 id="scoreMessage" >You Completed an article!</h2>
                    <div class="points" id="quiz-points">
                        <img src="./images/star.png" alt="Points Picture" class="points-pic" id="quiz-points-pic">
                        <span class="score" id="totalScore"></span>
                    </div>
                    <p>Points are added to your score.</p>
                    <button onclick="closeScorePopup()">Close</button>
                </div>
            </div>
        </div>
        
    </div>
    <script src="./js/readingScript.js"></script>
</body>
</html>
