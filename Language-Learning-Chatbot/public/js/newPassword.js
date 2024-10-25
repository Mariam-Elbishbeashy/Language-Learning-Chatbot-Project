function validateNewPassword() {
    const password = document.getElementById("newPassword").value.trim();
    const confirmPassword = document.getElementById("confirmNewPassword").value.trim();
    const passwordError = document.getElementById("newPasswordError");
    const confirmPasswordError = document.getElementById("confirmNewPasswordError");

    const passwordRegex = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[\W_]).{8,}$/;

    // Reset error messages
    passwordError.textContent = "";
    confirmPasswordError.textContent = "";

    let isValid = true;

    if (password === "") {
        passwordError.textContent = "Please enter a password";
        isValid = false;
    } else if (!password.match(passwordRegex)) {
        passwordError.textContent = "Password must be at least 8 characters long, contain one uppercase letter, one lowercase letter, one number, and one special character.";
        isValid = false;
    }

    if (confirmPassword === "") {
        confirmPasswordError.textContent = "Please confirm your password";
        isValid = false;
    } else if (password !== confirmPassword) {
        confirmPasswordError.textContent = "Passwords do not match";
        isValid = false;
    }

    if (isValid) {
        goToLogin();
    }
}

function goToLogin() {
    window.location.href = '../public/login.html';
}
