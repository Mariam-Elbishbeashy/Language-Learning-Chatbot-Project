function validateEmail() {
    const email = document.getElementById("email").value.trim();
    const emailError = document.getElementById("emailError");
    emailError.textContent = "";

    const emailRegex = /^[^\s@]+@[^\s@]+\.[a-zA-Z]{2,6}$/;

    if (email === "") {
        emailError.textContent = "Please enter your email address";
        return false;
    } else if (!email.match(emailRegex)) {
        emailError.textContent = "Please enter a valid email address";
        return false;
    }

    return true;
}
