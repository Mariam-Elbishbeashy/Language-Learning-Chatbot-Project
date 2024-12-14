document.getElementById("sendMessage").addEventListener("click", sendMessage);

document.getElementById("messageInput").addEventListener("keydown", function (event) {
    if (event.key === "Enter") {
        event.preventDefault(); // Prevent default form submission
        sendMessage();
    }
});

function sendMessage() {
    const messageInput = document.getElementById("messageInput");
    const chatContent = document.getElementById("chatContent");
    const message = messageInput.value.trim();

    if (message !== "") {
        // Display the user message immediately
        const newMessage = document.createElement("div");
        newMessage.textContent = message;
        newMessage.classList.add("new-message");
        newMessage.style.display = "block";
        chatContent.appendChild(newMessage);

        // Clear the input field
        messageInput.value = "";

        // Hide unnecessary UI sections
        document.querySelector(".features").style.display = "none";
        document.querySelector(".logo2").style.display = "none";
        document.querySelector(".intro").style.display = "none";

        // Scroll to the latest message (user's message)
        chatContent.scrollTop = chatContent.scrollHeight;

        // Send the message to the backend (chatbot handler)
        fetch("../Language-Learning-Chatbot/controllers/chatbotController.php", {
            method: "POST",
            headers: {
                "Content-Type": "application/x-www-form-urlencoded",
            },
            body: new URLSearchParams({ message: message }),
        })
        .then((response) => response.json())
        .then((data) => {
            if (data.reply) {
                const botReply = document.createElement("div");
                botReply.classList.add("chatbot-response");
                botReply.textContent = data.reply;
                botReply.classList.add("bot-message");
                chatContent.appendChild(botReply);

                // Scroll to the latest message (bot's reply)
                chatContent.scrollTop = chatContent.scrollHeight;
            } else {
                console.error("No reply received from the chatbot.");
            }
        })
        .catch((error) => {
            console.error("Error communicating with the chatbot:", error);

            // Display an error message in the chat
            const errorMessage = document.createElement("p");
            errorMessage.textContent = "An error occurred. Please try again.";
            errorMessage.classList.add("error-message");
            chatContent.appendChild(errorMessage);
        });
    }
}
