function addNote() {
    const noteInput = document.getElementById("noteInput");
    const notesList = document.getElementById("notesList");

    // Create a new list item with the user's note
    if (noteInput.value.trim()) {
        const noteItem = document.createElement("li");
        noteItem.textContent = noteInput.value;
        notesList.appendChild(noteItem);

        // Clear the input field after adding the note
        noteInput.value = "";
    }
}
function closeScorePopup() {
    document.getElementById("scorePopup").style.display = "none";
    window.location.href = 'game.php';
}
function showScorePopup(){
let points = 40;
document.getElementById("totalScore").innerText = `${points}`;
document.getElementById("scorePopup").style.display = "flex";
}