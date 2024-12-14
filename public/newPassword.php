<?php include '../Language-Learning-Chatbot/controllers/PasswordController.php';?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>New Password</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="../public/css/forgotPassword.css">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.6.0/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="../public/js/newPassword.js"></script>
</head>
<body>
    <div class="container">
        <div class="form-container row">
            <div class="col-md-6 d-flex justify-content-center align-items-center">
                <img src="./images/password.png" class="img-fluid password-image" alt="Password Reset Image">
            </div>
            <div class="col-md-6">
                <form id="newPasswordForm" action="newPassword.php" method="post" autocomplete="off" onsubmit="return validateNewPassword()">
                    <h2 class="text-center">New Password</h2>
                    <p class="text-center">Enter your new password</p>
                    <div class="form-group">
                        <input class="form-control" type="password" id="newPassword" name="new_password" placeholder="Enter new password" required>
                        <div class="error text-danger" id="newPasswordError"><?php echo $message; ?></div>
                    </div>
                    <div class="form-group">
                        <input class="form-control" type="password" id="confirmNewPassword" placeholder="Confirm new password" required>
                        <div class="error text-danger" id="confirmNewPasswordError"></div>
                    </div>
                    <div class="form-group">
                        <input class="form-control button" type="submit" value="Update Password">
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="successModal" tabindex="-1" aria-labelledby="successModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="successModalLabel">Password Changed</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Your password has been successfully changed.
                </div>
                <div class="modal-footer">
                    <button type="button" id="goToLoginBtn">Got it</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.getElementById('goToLoginBtn').addEventListener('click', function() {
            window.location.href = '../public/login.php';
        });
    </script>
</body>
</html>
