initMultiStepForm();

function initMultiStepForm() {
    const progressNumber = document.querySelectorAll(".step").length;
    const slidePage = document.querySelector(".slide-page");
    const progressText = document.querySelectorAll(".step p");
    const progressCheck = document.querySelectorAll(".step .check");
    const bullet = document.querySelectorAll(".step .bullet");
    const pages = document.querySelectorAll(".page");
    const nextButtons = document.querySelectorAll(".next");
    const prevButtons = document.querySelectorAll(".prev");
    const stepsNumber = pages.length;

    if (progressNumber !== stepsNumber) {
        console.warn("Error, number of steps in progress bar do not match number of pages");
    }

    let current = 1;

    for (let i = 0; i < nextButtons.length; i++) {
        nextButtons[i].addEventListener("click", function (event) {
            event.preventDefault();

            let inputsValid = validateInputs(this, current);  

            if (inputsValid) {
                slidePage.style.marginLeft = `-${(100 / stepsNumber) * current}%`;
                bullet[current - 1].classList.add("active");
                progressCheck[current - 1].classList.add("active");
                progressText[current - 1].classList.add("active");
                current += 1;
            }
        });
    }

    for (let i = 0; i < prevButtons.length; i++) {
        prevButtons[i].addEventListener("click", function (event) {
            event.preventDefault();
            slidePage.style.marginLeft = `-${(100 / stepsNumber) * (current - 2)}%`;
            bullet[current - 2].classList.remove("active");
            progressCheck[current - 2].classList.remove("active");
            progressText[current - 2].classList.remove("active");
            current -= 1;
        });
    }

    function validateInputs(ths, currentStep) {
        let inputsValid = true;
        const inputs = ths.parentElement.parentElement.querySelectorAll("input, select");
        const errorContainers = ths.parentElement.parentElement.querySelectorAll(".error");

        errorContainers.forEach(error => error.textContent = "");  

        switch (currentStep) {
            case 1: // Contact step
                inputsValid = validateContactStep(inputs);
                break;
            case 2: // Security step
                inputsValid = validateSecurityStep(inputs);
                break;
            case 3: // Gender step
                inputsValid = validateGenderStep(inputs);
                break;
            case 4: // Role step
                inputsValid = validateRoleStep(inputs);
                break;
            case 5: // Language step
                inputsValid = validateLanguageStep(inputs);
                break;
        }
        return inputsValid;
    }

    // Validation for Contact Step
    function validateContactStep(inputs) {
        let isValid = true;
        const email = inputs[0].value.trim();
        const username = inputs[1].value.trim();
        const emailError = document.getElementById("emailError");
        const usernameError = document.getElementById("usernameError");

        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        if (email === "") {
            emailError.textContent = "Please enter your email";
            isValid = false;
        } else if (!email.match(emailRegex)) {
            emailError.textContent = "Please enter a valid email address";
            isValid = false;
        }

        if (username === "") {
            usernameError.textContent = "Please enter your username";
            isValid = false;
        }

        return isValid;
    }

   // Validation for Security Step
function validateSecurityStep(inputs) {
    let isValid = true;
    const password = inputs[0].value.trim();
    const confirmPassword = inputs[1].value.trim();
    const passwordError = document.getElementById("passwordError");
    const confirmPasswordError = document.getElementById("confirmPasswordError");

    const passwordRegex = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[\W_]).{8,}$/;

    passwordError.textContent = "";
    confirmPasswordError.textContent = "";

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

    return isValid;
}
// Validation for Gender Step
function validateGenderStep(inputs) {
    const genderError = document.getElementById("genderError");
    let selectedGender = false;
    
    inputs.forEach(input => {
        if (input.checked) {
            selectedGender = true;
        }
    });

    if (!selectedGender) {
        genderError.textContent = "Please select your gender";
        return false;
    }

    return true;
}


    // Validation for Role Step
    function validateRoleStep(inputs) {
        const roleError = document.getElementById("roleError");
        if (!inputs[0].checked && !inputs[1].checked) {
            roleError.textContent = "Please select a role";
            return false;
        }
        return true;
    }

    // Validation for Language Step
    function validateLanguageStep(inputs) {
        const languageError = document.getElementById("languageError");
        if (!inputs[0].value) {
            languageError.textContent = "Please select a language";
            return false;
        }
        return true;
    }
}
