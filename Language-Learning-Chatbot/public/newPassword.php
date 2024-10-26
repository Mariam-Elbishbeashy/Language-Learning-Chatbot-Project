<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Create a New Password</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="../public/css/forgotPassword.css">
</head>
<body>
    <div class="container">
        <div class="form-container row">
            <div class="col-md-6 d-flex justify-content-center align-items-center">
                <img src="./images/password.png" class="img-fluid password-image" alt="New Password Image">
            </div>
            <div class="col-md-6">
                <form id="newPasswordForm" autocomplete="off">
                    <h2 class="text-center">New Password</h2>
                    <div class="form-group">
                        <input class="form-control" type="password" id="newPassword" placeholder="Create new password" required>
                        <div class="error" id="newPasswordError"></div> 
                    </div>
                    <div class="form-group">
                        <input class="form-control" type="password" id="confirmNewPassword" placeholder="Confirm your password" required>
                        <div class="error" id="confirmNewPasswordError"></div> 
                    </div>
                    <div class="form-group">
                        <input class="form-control button" type="button" value="Change" onclick="validateNewPassword()">
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script src="../public/js/newPassword.js"></script>
</body>
</html>
