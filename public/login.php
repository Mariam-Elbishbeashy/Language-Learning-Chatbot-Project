<?php include '../Language-Learning-Chatbot/controllers/LoginController.php';?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
    <meta charset="UTF-8">
    <title>Login and Registration Form in HTML & CSS | CodingLab</title>
    <link rel="stylesheet" href="../public/css/login.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
  <div class="container">
    <input type="checkbox" id="flip">
    <div class="cover">
      <div class="front">
        <img src="./images/chatImage.gif" alt="">
        <div class="text">
          <span class="text-1">Unlocking worlds one word at a time<br>Step into a new language adventure!</span>
          <span class="text-2">Start your learning journey now!</span>
        </div>
      </div>
      <div class="back">
        <img class="backImg" src="./images/chatbotGIF.gif" alt="">
        <div class="text">
          <span class="text-1">Complete miles of journey <br> with one step</span>
          <span class="text-2">Let's get started</span>
        </div>
      </div>
    </div>
    <div class="forms">
        <div class="form-content">
          <div class="login-form">
            <div class="title">Login</div>
            <form action="../public/login.php" id="loginForm" method="post">
              <div class="input-boxes">
                <div class="input-box">
                  <i class="fas fa-envelope"></i>
                  <input type="text" id="loginEmail" name="loginEmail" placeholder="Enter your email">
                </div>
                <div class="error" id="loginEmailError"></div>
                <div class="input-box">
                  <i class="fas fa-lock"></i>
                  <input type="password" id="loginPassword" name="loginPassword" placeholder="Enter your password">
                </div>
                <div class="error" id="loginPasswordError"></div>
                <div class="text"><a href="../public/forgotPassword.php">Forgot password?</a></div>
                <div class="button input-box">
                  <input type="submit" value="Submit">
                </div>
                <div class="text sign-up-text">Don't have an account? <label for="flip">Signup now</label></div>
              </div>
            </form>
            <?php if (isset($loginError)) : ?>
                <div class="error"><?php echo $loginError; ?></div>
            <?php endif; ?>
          </div>
          <div class="signup-form">
            <div class="title">Signup</div>
            <form action="" id="signupForm" method="post">
              <div class="input-boxes">
                <div class="welcome-message">Welcome! Let's create your account.</div>
                <div class="input-box">
                  <i class="fas fa-user"></i>
                  <input type="text" id="firstName" name="firstName" placeholder="Enter your first name">
                </div>
                <div class="error" id="firstNameError"></div>
                <div class="input-box">
                  <i class="fas fa-user"></i>
                  <input type="text" id="lastName" name="lastName" placeholder="Enter your last name">
                </div>
                <div class="error" id="lastNameError"></div>
                <div class="button input-box">
                <button type="submit" class="continue-signup-btn" id="continueSignupBtn">Continue to Signup</button>
                </div>
                <div class="text sign-up-text">Already have an account? <label for="flip">Login now</label></div>
              </div>
            </form>
          </div>
        </div>
    </div>
  </div>

  <script src="../public/js/login.js"></script> 
</body>
</html>
