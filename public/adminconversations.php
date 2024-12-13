<?php
include '../Language-Learning-Chatbot/controllers/restrict.php';
restrictPageAccess('admin', '../public/home.php'); // Redirect non-admin users to home page
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chatbot Admin Dashboard</title>
    <!-- ======= Styles ====== -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Sharp:opsz,wght,FILL,GRAD@48,400,0,0" />
    <link rel="stylesheet" href="../public/css/styleadmin.css">
    <link rel="stylesheet" href="../public/css/admintable.css">
</head>

<body>
    <!-- =============== Navigation ================ -->
    <?php include "../Language-Learning-Chatbot/views/partials/adminnavbar.php"; ?>
<!------------------------------ User Management Section ---------------------------->
            <section>
                <div class="user-management">
                
                    <table>
                        <thead>
                            <tr>
                                <th>User Name</th>
                                <th>Role</th>
                                <th>Language</th>
                                <th>Email</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody id="user-list">
                            <tr>
                                <td>John Doe</td>
                                <td>Student</td>
                                <td>English</td>
                                <td>john@example.com</td>
                                <td>
                                    <button onclick="showChatHistory(0)">Chat History</button>
                                </td>
                            </tr>
                            <tr>
                                <td>Jane Smith</td>
                                <td>Tutor</td>
                                <td>Spanish</td>
                                <td>jane@example.com</td>
                                <td>
                                    <button onclick="showChatHistory(1)">Chat History</button>
                                </td>
                            </tr>
                            <tr>
                                <td>Michael Johnson</td>
                                <td>Student</td>
                                <td>French</td>
                                <td>michael@example.com</td>
                                <td>
                                    <button onclick="showChatHistory(2)">Chat History</button>
                                </td>
                            </tr>
                            <tr>
                                <td>Emily Davis</td>
                                <td>Tutor</td>
                                <td>German</td>
                                <td>emily@example.com</td>
                                <td>
                                    <button onclick="showChatHistory(3)">Chat History</button>
                                </td>
                            </tr>
                            <tr>
                                <td>James Brown</td>
                                <td>Student</td>
                                <td>Mandarin</td>
                                <td>james@example.com</td>
                                <td>
                                    <button onclick="showChatHistory(4)">Chat History</button>
                                </td>
                            </tr>
                            <tr>
                                <td>Alice Wilson</td>
                                <td>Tutor</td>
                                <td>English</td>
                                <td>alice@example.com</td>
                                <td>
                                    <button onclick="showChatHistory(5)">Chat History</button>
                                </td>
                            </tr>
                            <tr>
                                <td>David Miller</td>
                                <td>Student</td>
                                <td>Spanish</td>
                                <td>david@example.com</td>
                                <td>
                                    <button onclick="showChatHistory(6)">Chat History</button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                
                <div id="chatModal" class="modal">
                    <div class="modal-content">
                        <span class="close" id="closeModal">&times;</span>
                        <h2>Chat History</h2>
                        <div id="chat-history">
                           
                        </div>
                    </div>
                </div>
                
    </div>

    <script src="https://unpkg.com/ionicons@5.5.2/dist/ionicons.js"></script>
    <script src="../public/js/adminmainjs.js"></script>
    <script>
      const userForm = document.getElementById('user-form');
const userList = document.getElementById('user-list');
const chatModal = document.getElementById('chatModal');
const closeModal = document.getElementById('closeModal');
const chatHistoryDiv = document.getElementById('chat-history');
const users = [
    {
        name: "John Doe",
        role: "Student",
        language: "English",
        email: "john@example.com",
        chatHistory: [
            "What is the best way to learn a new language?",
            "Can you recommend some good resources for Spanish?"
        ]
    },
    {
        name: "Jane Smith",
        role: "Tutor",
        language: "Spanish",
        email: "jane@example.com",
        chatHistory: [
            "Hello! How can I assist you today?",
            "Do you need help with grammar?"
        ]
    },
    {
        name: "Michael Johnson",
        role: "Student",
        language: "French",
        email: "michael@example.com",
        chatHistory: [
            "How can I improve my speaking skills?",
            "What are some tips for pronunciation?"
        ]
    },
];

function showChatHistory(index) {
    const user = users[index];
    chatHistoryDiv.innerHTML = user.chatHistory.map(message => `<p>${message}</p>`).join('');
    chatModal.style.display = "block";
}

closeModal.onclick = function() {
    chatModal.style.display = "none";
}

window.onclick = function(event) {
    if (event.target == chatModal) {
        chatModal.style.display = "none";
    }
}

userForm.addEventListener('submit', function(event) {
    event.preventDefault();
    const newUser = {
        name: document.getElementById('username').value,
        role: document.getElementById('role').value,
        language: document.getElementById('language').value,
        email: document.getElementById('email').value,
        chatHistory: [] // Initialize with empty chat history
    };
    users.push(newUser);
    const newRow = `<tr>
                        <td>${newUser.name}</td>
                        <td>${newUser.role}</td>
                        <td>${newUser.language}</td>
                        <td>${newUser.email}</td>
                        <td>
                            <button onclick="showChatHistory(${users.length - 1})">Chat History</button>
                        </td>
                    </tr>`;
    userList.insertAdjacentHTML('beforeend', newRow);
    userForm.reset(); 
});

    </script>
</body>

</html>
