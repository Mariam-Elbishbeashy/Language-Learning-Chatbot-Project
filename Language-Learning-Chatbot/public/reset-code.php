<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Code Verification</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="../public/css/forgotPassword.css">
</head>
<body>
    <div class="container">
        <div class="form-container row">
            <div class="col-md-6 d-flex justify-content-center align-items-center">
                <img src="./images/password.png" class="img-fluid password-image" alt="Verification Code Image">
            </div>
            <div class="col-md-6">
                <form id="resetCodeForm" autocomplete="off">
                    <h2 class="text-center">Code Verification</h2>
                    <div class="form-group">
                        <input class="form-control" type="number" name="otp" placeholder="Enter code" required>
                    </div>
                    <div class="form-group">
                        <input class="form-control button" type="button" value="Submit" onclick="goToNewPassword()">
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script src="../public/js/reset-code.js"></script>
</body>
</html>
