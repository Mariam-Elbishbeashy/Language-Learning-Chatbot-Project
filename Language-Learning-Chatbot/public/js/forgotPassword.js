function validateEmail() {
    const email = document.getElementById("email").value.trim();
    const emailError = document.getElementById("emailError");

    // Reset error message
    emailError.textContent = "";

    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

    if (email === "") {
        emailError.textContent = "Please enter your email address";
    } else if (!email.match(emailRegex)) {
        emailError.textContent = "Please enter a valid email address";
    } else {
        goToResetCode();
    }
}

function goToResetCode() {
    window.location.href = '../public/reset-code.html';
}


