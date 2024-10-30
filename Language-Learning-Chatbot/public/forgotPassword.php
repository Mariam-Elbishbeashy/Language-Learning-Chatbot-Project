<?php include '../controllers/PasswordController.php';?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Forgot Password</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="../public/css/forgotPassword.css">
    <script src="../public/js/forgotPassword.js"></script> 
</head>
<body>
    <div class="container">
        <div class="form-container row">
            <div class="col-md-6 d-flex justify-content-center align-items-center">
                <img src="./images/password.png" class="img-fluid password-image" alt="Password Reset Image">
            </div>
            <div class="col-md-6">
                <form id="forgotPasswordForm" action="forgotPassword.php" method="post" autocomplete="off" onsubmit="return validateEmail()">
                    <h2 class="text-center">Forgot Password</h2>
                    <p class="text-center">Enter your email address</p>
                    <div class="form-group">
                        <input class="form-control" type="email" id="email" name="email" placeholder="Enter email address" required>
                        <div class="error text-danger" id="emailError"><?php echo $message; ?></div>
                    </div>
                    <div class="form-group">
                        <input class="form-control button" type="submit" value="Continue">
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
