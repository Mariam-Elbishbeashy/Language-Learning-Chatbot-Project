<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
session_start();

require_once '../Language-Learning-Chatbot/controllers/ChatbotController.php';
require_once '../Language-Learning-Chatbot/model/ChatbotModel.php';
require_once '../Language-Learning-Chatbot/db/dbh.inc.php';

if (!isset($_SESSION['userId'])) {
    header("Location: ../public/error.php");
    exit();
}

$userId = $_SESSION['userId'];
$newChatId = null;
$chatId = isset($_GET['chat_id']) ? (int)$_GET['chat_id'] : null;
$messages = [];

// Handle "New Chat" functionality
// Handle "New Chat" functionality
if (isset($_GET['new_chat']) && $_GET['new_chat'] == 1) {
    require_once '../Language-Learning-Chatbot/model/ChatbotModel.php';

    $ChatbotModel = new ChatbotModel($apiKey, $conn); // Instantiate the ChatbotModel
    $defaultTitle = "New Chat"; // Fallback title if title generation fails

    // Generate the dynamic chat title
    $chatTitle = $ChatbotModel->generateDynamicChatTitle("new") ?? $defaultTitle;

    // Insert the new chat with the generated title
    $stmt = $conn->prepare("INSERT INTO Chats (user_id, title, created_at) VALUES (?, ?, NOW())");
    $stmt->bind_param("is", $userId, $chatTitle);

    if ($stmt->execute()) {
        $newChatId = $conn->insert_id;
        header("Location: home.php?chat_id=$newChatId");
        exit();
    } else {
        echo "<p>Error: Could not create a new chat. Please try again.</p>";
    }
}

// Fetch all chats for the user
$stmt = $conn->prepare("SELECT * FROM Chats WHERE user_id = ? ORDER BY created_at DESC");
$stmt->bind_param("i", $userId);
$stmt->execute();
$chatsResult = $stmt->get_result();
$chats = $chatsResult->fetch_all(MYSQLI_ASSOC);

// Fetch messages for the selected chat
if ($chatId) {
    $stmt = $conn->prepare("SELECT * FROM ChatMessages WHERE chat_id = ? ORDER BY timestamp ASC");
    $stmt->bind_param("i", $chatId);
    $stmt->execute();
    $result = $stmt->get_result();

    while ($row = $result->fetch_assoc()) {
        $messages[] = $row;
    }
}



?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chatrock</title>
    <link rel="stylesheet" href="css/Stylehome.css">
</head>
<body>
    <div class="container">
        <?php include "../Language-Learning-Chatbot/views/partials/navbar.php"; ?>
        <div class="main-content">
            <h1 class="logo2">Chatrock</h1>
            <p class="intro">Delve into profound perspectives, participate in enriching dialogues, and discover fresh opportunities with Chatrock.</p>

            <div id="chatContent">
    <?php if ($chatId): ?>
        <?php if (!empty($messages)): ?>
            <?php foreach ($messages as $message): ?>
                <!-- Display user message -->
                <div class="message user-message">
                    <p><strong>User:</strong> <?= htmlspecialchars($message['message']) ?></p>
                    <small><?= htmlspecialchars($message['timestamp']) ?></small>
                </div>
                
                <!-- Display bot response if it exists -->
                <?php if (!empty($message['response'])): ?>
                    <div class="message bot-message">
                        <p><strong>Bot:</strong> <?= htmlspecialchars($message['response']) ?></p>
                        <small><?= htmlspecialchars($message['timestamp']) ?></small>
                    </div>
                <?php endif; ?>
            <?php endforeach; ?>
        <?php endif; ?>
    <?php endif; ?>
</div>



<style>
/* Position the chat buttons at the bottom left corner */
/* Chat container */
.chat-container {
    position: absolute;
    bottom: 200px; /* Adjust this to control overall positioning on the screen */
    left: 10px;
    z-index: 1000;
    max-width: 300px;  /* You can adjust this based on how wide you want the container */
}

/* Heading style */
/* Heading style */
.chat-container h3 {
    font-size: 24px;  /* Make the font size bigger */
    color: #ffffff;  /* Set text color to white */
    margin: 0;  /* Remove margin to prevent shifting */
    padding-bottom: 10px;  /* Space between the heading and buttons */
    font-weight: bold;  /* Optionally, make the font bold for emphasis */
    right: 5px;
}


/* Chat buttons container */
.chat-buttons {
    max-height: 100px; /* You can adjust this based on how many buttons you expect */
    overflow-y: auto;  /* Allow scrolling if buttons exceed the height */
}

/* Individual Chat Button */
.chat-button {
    display: block;
    padding: 6px 10px;
    background-color: #6139b9;
    color: #ffffff;
    text-decoration: none;
    font-size: 12px;
    border-radius: 6px;
    text-align: center;
    margin-bottom: 8px;
    transition: background-color 0.3s ease, box-shadow 0.3s ease, transform 0.3s ease, color 0.3s ease;
}

.chat-button:hover {
    background-color: rgba(97, 57, 185, 0.1); /* Now this is transparent */
    transform: translateY(-3px);
    color: #f0f0f0;
}

/* Active Click Effect */
.chat-button:active {
    transform: translateY(0);
    box-shadow: 0 2px 8px rgba(0, 86, 179, 0.2);
}



/* No Chats Found Message */
.chat-container p {
    text-align: center;
    font-size: 12px;
    color: #666;
}


</style>


            <!-- Features Section -->
            <div class="features">
                <div class="feature">
                <span class="main-icon">
                        <i class="bi bi-stars"></i>
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-stars" viewBox="0 0 16 16">
                            <path d="M7.657 6.247c.11-.33.576-.33.686 0l.645 1.937a2.89 2.89 0 0 0 1.829 1.828l1.936.645c.33.11.33.576 0 .686l-1.937.645a2.89 2.89 0 0 0-1.828 1.829l-.645 1.936a.361.361 0 0 1-.686 0l-.645-1.937a2.89 2.89 0 0 0-1.828-1.828l-1.937-.645a.361.361 0 0 1 0-.686l1.937-.645a2.89 2.89 0 0 0 1.828-1.828zM3.794 1.148a.217.217 0 0 1 .412 0l.387 1.162c.173.518.579.924 1.097 1.097l1.162.387a.217.217 0 0 1 0 .412l-1.162.387A1.73 1.73 0 0 0 4.593 5.69l-.387 1.162a.217.217 0 0 1-.412 0L3.407 5.69A1.73 1.73 0 0 0 2.31 4.593l-1.162-.387a.217.217 0 0 1 0-.412l1.162-.387A1.73 1.73 0 0 0 3.407 2.31zM10.863.099a.145.145 0 0 1 .274 0l.258.774c.115.346.386.617.732.732l.774.258a.145.145 0 0 1 0 .274l-.774.258a1.16 1.16 0 0 0-.732.732l-.258.774a.145.145 0 0 1-.274 0l-.258-.774a1.16 1.16 0 0 0-.732-.732L9.1 2.137a.145.145 0 0 1 0-.274l.774-.258c.346-.115.617-.386.732-.732z"/>
                        </svg>
                    </span>
                    <h3>Key Features</h3>
                    <ul>
                        <li>User Registration & Authentication for students, instructors, and admins</li>
                        <li>Dynamic course adjustment based on real-time performance</li>
                        <li>Personalized learning paths tailored to individual needs</li>
                        <li>Immediate feedback from quizzes and assessments</li>
                    </ul>
                </div>
                <div class="feature">
                <span class="main-icon">
                        <i class="bi bi-cpu"></i>
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-cpu" viewBox="0 0 16 16">
                            <path d="M5 0a.5.5 0 0 1 .5.5V2h1V.5a.5.5 0 0 1 1 0V2h1V.5a.5.5 0 0 1 1 0V2h1V.5a.5.5 0 0 1 1 0V2A2.5 2.5 0 0 1 14 4.5h1.5a.5.5 0 0 1 0 1H14v1h1.5a.5.5 0 0 1 0 1H14v1h1.5a.5.5 0 0 1 0 1H14v1h1.5a.5.5 0 0 1 0 1H14a2.5 2.5 0 0 1-2.5 2.5v1.5a.5.5 0 0 1-1 0V14h-1v1.5a.5.5 0 0 1-1 0V14h-1v1.5a.5.5 0 0 1-1 0V14h-1v1.5a.5.5 0 0 1-1 0V14A2.5 2.5 0 0 1 2 11.5H.5a.5.5 0 0 1 0-1H2v-1H.5a.5.5 0 0 1 0-1H2v-1H.5a.5.5 0 0 1 0-1H2v-1H.5a.5.5 0 0 1 0-1H2A2.5 2.5 0 0 1 4.5 2V.5A.5.5 0 0 1 5 0m-.5 3A1.5 1.5 0 0 0 3 4.5v7A1.5 1.5 0 0 0 4.5 13h7a1.5 1.5 0 0 0 1.5-1.5v-7A1.5 1.5 0 0 0 11.5 3zM5 6.5A1.5 1.5 0 0 1 6.5 5h3A1.5 1.5 0 0 1 11 6.5v3A1.5 1.5 0 0 1 9.5 11h-3A1.5 1.5 0 0 1 5 9.5zM6.5 6a.5.5 0 0 0-.5.5v3a.5.5 0 0 0 .5.5h3a.5.5 0 0 0 .5-.5v-3a.5.5 0 0 0-.5-.5z"/>
                        </svg>
                    </span>
                    <h3>Capabilities</h3>
                    <ul>
                        <li>Adjusts content difficulty in real-time</li>
                        <li>Provides a discussion forum for student interaction</li>
                        <li>Tracks progress and performance in a personalized dashboard</li>
                        <li>Awards certificates upon course completion</li>
                    </ul>
                </div>
                <div class="feature">
                <span class="main-icon">
                        <i class="bi bi-exclamation-octagon"></i>
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-exclamation-octagon" viewBox="0 0 16 16">
                            <path d="M4.54.146A.5.5 0 0 1 4.893 0h6.214a.5.5 0 0 1 .353.146l4.394 4.394a.5.5 0 0 1 .146.353v6.214a.5.5 0 0 1-.146.353l-4.394 4.394a.5.5 0 0 1-.353.146H4.893a.5.5 0 0 1-.353-.146L.146 11.46A.5.5 0 0 1 0 11.107V4.893a.5.5 0 0 1 .146-.353zM5.1 1 1 5.1v5.8L5.1 15h5.8l4.1-4.1V5.1L10.9 1z"/>
                            <path d="M7.002 11a1 1 0 1 1 2 0 1 1 0 0 1-2 0M7.1 4.995a.905.905 0 1 1 1.8 0l-.35 3.507a.552.552 0 0 1-1.1 0z"/>
                        </svg>
                    </span>
                    <h3>Limitations</h3>
                    <ul>
                        <li>May struggle to accurately assess unique learning styles</li>
                        <li>Dependent on the quality of data input for performance adjustments</li>
                        <li>Limited in addressing non-academic student needs</li>
                        <li>Potential technical issues affecting content delivery</li>
                    </ul>
                </div>
            </div>

            <div class="chat-container">
    <h3>Chats</h3> <!-- Heading stays fixed -->
    <div class="chat-buttons">
        <?php if (!empty($chats)): ?>
            <?php foreach ($chats as $chat): ?>
                <a href="home.php?chat_id=<?= $chat['id'] ?>" class="chat-button">
                    <?= htmlspecialchars($chat['title']) ?>
                </a>
            <?php endforeach; ?>
        <?php else: ?>
            <p>No previous chats found.</p>
        <?php endif; ?>
    </div>
</div>


<style>
    /* New Chat Button */
.btn-new-chat {
    display: inline-block;
    padding: 12px 24px;
    background: linear-gradient(135deg, #4a90e2, #0056b3);
    color: #ffffff;
    font-size: 16px;
    font-weight: bold;
    text-decoration: none;
    border: none;
    border-radius: 8px;
    transition: all 0.3s ease;
    box-shadow: 0 4px 12px rgba(74, 144, 226, 0.3);
    text-align: center;
    position: absolute;
    left: 0;
    bottom: 60px; /* Increased value to move it up */
    margin-left: 20px; /* Slight spacing from the edge */
}

/* Hover Effect */
.btn-new-chat:hover {
    background: linear-gradient(135deg, #0056b3, #004080);
    box-shadow: 0 6px 16px rgba(0, 86, 179, 0.4);
    transform: translateY(-3px);
    color: #f0f0f0;
}

/* Active Click Effect */
.btn-new-chat:active {
    transform: translateY(0);
    box-shadow: 0 2px 8px rgba(0, 86, 179, 0.2);
}

</style>


            <!-- New Chat and Send Message -->
            <div class="prompt-box">
            <a href="home.php?new_chat=1" class="btn btn-new-chat">New Chat</a>
                <input type="text" id="messageInput" placeholder="Enter a prompt here...">
                <button class="send-btn" id="sendMessage">
                    <i class="bi bi-send-fill"></i>
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-send-fill" viewBox="0 0 16 16">
                    <path d="M15.964.686a.5.5 0 0 0-.65-.65L.767 5.855H.766l-.452.18a.5.5 0 0 0-.082.887l.41.26.001.002 4.995 3.178 3.178 4.995.002.002.26.41a.5.5 0 0 0 .886-.083zm-1.833 1.89L6.637 10.07l-.215-.338a.5.5 0 0 0-.154-.154l-.338-.215 7.494-7.494 1.178-.471z"/>
                </svg>
                </button>
            </div>
        </div>
    </div>

    

    <script src="./js/homeScript.js"></script>
</body>
</html>
