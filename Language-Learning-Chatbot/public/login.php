<?php 
session_start();
include_once "../config/dbh.inc.php";

//Sign Up
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Store first name and last name in session variables for signup
    if (isset($_POST['firstName']) && isset($_POST['lastName'])) {
        $_SESSION['firstName'] = htmlspecialchars($_POST['firstName']);
        $_SESSION['lastName'] = htmlspecialchars($_POST['lastName']);
        header("Location: ../public/signup.php");
        exit();
    }

  //Login
    if (isset($_POST['loginEmail']) && isset($_POST['loginPassword'])) {
        $loginEmail = htmlspecialchars($_POST['loginEmail']);
        $loginPassword = $_POST['loginPassword'];

        // Query to find the user by email
        $sql = "SELECT * FROM users WHERE email='$loginEmail'";
        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) > 0) {
            $user = mysqli_fetch_assoc($result);

            // Verify password
            if (password_verify($loginPassword, $user['password'])) {
                // Check the user's role
                $_SESSION['userId'] = $user['Id']; // Store user ID in session
                $_SESSION['firstName'] = $user['firstName']; // Optional: store first name
                $_SESSION['lastName'] = $user['lastName']; // Optional: store last name
                $_SESSION['role'] = $user['role']; // Store role in session

                // Redirect based on role
                switch ($user['role']) {
                    case 'student':
                        header("Location: ../public/home.php");
                        exit();
                    case 'tutor':
                        header("Location: ../public/forum.php");
                        exit();
                    case 'admin':
                        header("Location: ../public/admindashboard.php");
                        exit();
                    default:
                        // Optionally handle unexpected roles
                        echo "Unexpected role.";
                        break;
                }
            } else {
                // Invalid password
                $loginError = "Incorrect password. Please try again.";
            }
        } else {
            // No account found with that email
            $loginError = "It looks like you don't have an account. Please sign up.";
        }
    }
}
?>
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
