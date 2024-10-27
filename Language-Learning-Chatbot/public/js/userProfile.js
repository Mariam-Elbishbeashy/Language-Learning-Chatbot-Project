
document.getElementById('update').addEventListener('click', function() {

    const firstName = document.getElementById('firstName');
    const lastName = document.getElementById('lastName');
    const gender = document.getElementById('gender');
    const email = document.getElementById('email');
    const password = document.getElementById('password');
    const confirmPassword = document.getElementById('confirmPassword');

    clearErrors();

    let isValid = true;
    
    function displayError(input, message) {
        const error = document.createElement('small');
        error.className = 'form-text text-danger';
        error.innerText = message;
        input.parentElement.appendChild(error);
    }

    function clearErrors() {
        document.querySelectorAll('.text-danger').forEach(el => el.remove());
    }

    if (firstName.value.trim() === '') {
        displayError(firstName, 'First name is required');
        isValid = false;
    }
    if (lastName.value.trim() === '') {
        displayError(lastName, 'Last name is required');
        isValid = false;
    }

    if (gender.value === '') {
        displayError(gender, 'Gender is required');
        isValid = false;
    }

    if (email.value.trim() === '') {
        displayError(email, 'Email is required');
        isValid = false;
    }

    if (role.value === '') {
        displayError(role, 'Role is required');
        isValid = false;
    }
    
    if (language.value === '') {
        displayError(language, 'Language is required');
        isValid = false;
    }

    if (password.value.trim() === '') {
        displayError(password, 'Password is required');
        isValid = false;
    }
    if (confirmPassword.value.trim() === '') {
        displayError(confirmPassword, 'Confirm password is required');
        isValid = false;
    }

    const emailPattern = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,6}$/;
    if (email.value && !emailPattern.test(email.value)) {
        displayError(email, 'Invalid email format');
        isValid = false;
    }

    const passwordPattern = /^(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/;
    if (password.value && !passwordPattern.test(password.value)) {
        displayError(password, 'Password must be at least 8 characters long and include a number and a special character');
        isValid = false;
    }

    if (password.value && confirmPassword.value && password.value !== confirmPassword.value) {
        displayError(confirmPassword, 'Passwords do not match');
        isValid = false;
    }

    if (isValid) {
        alert('Form is valid! Submitting...');
    }
});