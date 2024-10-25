document.getElementById("sendMessage").addEventListener("click", sendMessage);

document.getElementById("messageInput").addEventListener("keydown", function(event) {
    if (event.key === "Enter") {
        event.preventDefault(); // Prevent the default form submission (if applicable)
        sendMessage(); // Call the sendMessage function
    }
});

function sendMessage() {
    // Get the message input value
    const message = document.getElementById("messageInput").value;

    if (message.trim() !== "") {
        // Create a new paragraph element for the message
        const newMessage = document.createElement("p");
        newMessage.textContent = message;
        newMessage.classList.add("new-message"); // Add the new-message class

        // Show the new message
        newMessage.style.display = "block"; // Display the message after sending

        // Add the message to the chat content
        document.getElementById("chatContent").appendChild(newMessage);

        // Clear the input field
        document.getElementById("messageInput").value = "";

        // Hide the features section
        document.querySelector(".features").style.display = "none";
        document.querySelector(".logo2").style.display = "none";
        document.querySelector(".intro").style.display = "none";
    }
}
