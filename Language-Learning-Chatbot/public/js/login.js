window.onload = function() {
    const urlParams = new URLSearchParams(window.location.search);
    const isSignup = urlParams.get('signup');
    const flipElement = document.getElementById('flip');
    const container = document.querySelector('.container');
  
    container.classList.add('no-animation');
  
    if (isSignup === 'true') {
      flipElement.checked = true; 
    }
  
    flipElement.addEventListener('change', function() {
      container.classList.remove('no-animation');
    });
  };
  function validateLoginForm() {
    const email = document.getElementById("loginEmail").value.trim();
    const password = document.getElementById("loginPassword").value.trim();
    const emailError = document.getElementById("loginEmailError");
    const passwordError = document.getElementById("loginPasswordError");
    
    let isValid = true;

    emailError.textContent = "";
    passwordError.textContent = "";

    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    if (email === "") {
        emailError.textContent = "Please enter your email";
        isValid = false;
    } else if (!email.match(emailRegex)) {
        emailError.textContent = "Please enter a valid email address";
        isValid = false;
    }

    if (password === "") {
        passwordError.textContent = "Please enter your password";
        isValid = false;
    }

    return isValid;
}

function validateSignupForm() {
    const firstName = document.getElementById("firstName").value.trim();
    const lastName = document.getElementById("lastName").value.trim();
    const firstNameError = document.getElementById("firstNameError");
    const lastNameError = document.getElementById("lastNameError");

    let isValid = true;

    firstNameError.textContent = "";
    lastNameError.textContent = "";

    if (firstName === "") {
        firstNameError.textContent = "Please enter your first name";
        isValid = false;
    }

    if (lastName === "") {
        lastNameError.textContent = "Please enter your last name";
        isValid = false;
    }

    return isValid;
}
document.getElementById("loginForm").addEventListener("submit", function(event) {
    if (!validateLoginForm()) {
        event.preventDefault(); 
    }
});

document.getElementById("continueSignupBtn").addEventListener("click", function() {
    if (validateSignupForm()) {
        window.location.href = "../public/signup.php";
    }
});
