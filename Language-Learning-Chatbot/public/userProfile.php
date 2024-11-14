<?php 
session_start();
require_once '../config/dbh.inc.php';
require_once '../controllers/UserController.php';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Create an instance of UserController
    $userController = new UserController($conn);

    if (isset($_SESSION['userId'])) {
    $userId = $_SESSION['userId'];
    $firstName = $_POST['firstName'] ?? '';
    $lastName = $_POST['lastName'] ?? '';
    $gender = $_POST['gender'] ?? '';
    $email = $_POST['email'] ?? '';
    $role = $_POST['role'] ?? '';
    $language = $_POST['language'] ?? '';
    $currentPassword = $_POST['currentPassword'] ?? ''; 
    $newPassword = $_POST['newPassword'] ?? '';
    $confirmPassword = $_POST['confirmPassword'] ?? '';

    $result = $userController->updateProfile($userId, $firstName, $lastName,$gender, $email, $role, $language, $currentPassword, $newPassword, $confirmPassword);

    echo $result;
} else {
    echo "User ID not found in session.";
}

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Profile</title>
    <link rel="stylesheet" href="./css/Stylehome.css">
    <link rel="stylesheet" href="./css/styleuserprofile.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
 <div class="container" style= "padding-right: 0px; padding-left: 0px;">
    <?php include "../views/partials/navbar.php"; ?>
    <div class="main-content">
    <form action="userProfile.php" method="POST">
        <div class="row gutters">
            <div class="col-xl-3 col-lg-3 col-md-12 col-sm-12 col-12">
                <div class="card h-100">
                    <div class="card-body">
                        <div class="account-settings">
                            <div class="user-profile">
                                <div class="text-center user-avatar">
                                    <img src="" alt="User Profile Picture" style="border-radius:50%; width: 100%">
                                </div>
                            </div>
                            <div class="text-center mt-4 my-3">
                                <button type="button" class="btn" style="border: 1px solid lightgrey" onclick="document.getElementById('uploadProfilePic').click()">Change Profile Picture</button>
                                <input type="file" id="uploadProfilePic" style="display:none" onchange="previewImage(event)">
                            </div>
                            <div class="text-center about">
                                <h5 style= color:#4D1193;>About</h5>
                                <p>I am <?=$_SESSION['firstName']?> <?=$_SESSION['lastName']?>, </p>                            
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Main Content -->
            <div class="col-xl-9 col-lg-9 col-md-12 col-sm-12 col-12">
                <div class="card h-100">
                    <div class="card-body">
                        
                        <!-- Personal Details Section -->
                        <div class="row gutters">
                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                <h6 class="mb-2 " style="color:#4D1193;">Personal Details</h6>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                                <div class="form-group">
                                    <label for="firstName" style= "color: #4D1193;">First Name</label>
                                    <input type="text" class="form-control" id="firstName" value="<?=$_SESSION['firstName']?>">
                                    </div>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                                <div class="form-group">
                                    <label for="lastName" style= "color: #4D1193;">Last Name</label>
                                    <input type="text" class="form-control" id="lastName" value="<?=$_SESSION['lastName']?>">
                                    </div>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                                <div class="form-group">
                                    <label for="gender" style= "color: #4D1193;">Gender</label>
                                    <select class="form-control" id="gender">
                                        <option value="" disabled>Select gender</option>
                                        <option value="female" <?= (isset($_SESSION['gender']) && $_SESSION['gender'] === 'female') ? 'selected' : '' ?>>Female</option>
                                        <option value="male" <?= (isset($_SESSION['gender']) && $_SESSION['gender'] === 'male') ? 'selected' : '' ?>>Male</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <!-- Account Information Section -->
                        <div class="row gutters">
                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                <h6 class="mt-3 mb-2 " style="color:#4D1193;">Account Information</h6>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                                <div class="form-group">
                                    <label for="email" style= "color: #4D1193;">Email</label>
                                    <input type="email" class="form-control" id="email" placeholder="Enter email" value="<?= htmlspecialchars($_SESSION['email'] ?? '') ?>">
                                    </div>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                                <div class="form-group">
                                    <label for="role" style= "color: #4D1193;">Role</label>
                                    <select class="form-control" id="role">
                                        <option value="" disabled>Select role</option>
                                        <option value="tutor" <?= (isset($_SESSION['role']) && $_SESSION['role'] === 'tutor') ? 'selected' : '' ?>>Tutor</option>
                                        <option value="admin" <?= (isset($_SESSION['role']) && $_SESSION['role'] === 'admin') ? 'selected' : '' ?>>Admin</option>
                                        <option value="student" <?= (isset($_SESSION['role']) && $_SESSION['role'] === 'student') ? 'selected' : '' ?>>Student</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                                <div class="form-group">
                                    <label for="language" style= "color: #4D1193;">Language</label>
                                    <select class="form-control" id="language">
                                        <option value="" disabled>Select language</option>
                                        <option value="english" <?= (isset($_SESSION['language']) && $_SESSION['language'] === 'english') ? 'selected' : '' ?>>English</option>
                                        <option value="french" <?= (isset($_SESSION['language']) && $_SESSION['language'] === 'french') ? 'selected' : '' ?>>French</option>
                                        <option value="spanish" <?= (isset($_SESSION['language']) && $_SESSION['language'] === 'spanish') ? 'selected' : '' ?>>Spanish</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <!-- Login Credentials Section -->
                        <div class="row gutters">
                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                <h6 class="mt-3 mb-2" style="color:#4D1193;">Login Credentials</h6>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                                <div class="form-group">
                                    <label for="newPassword" style= "color: #4D1193;">New Password</label>
                                    <input type="password" class="form-control" id="newPassword" placeholder="Enter new password">
                                </div>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                                <div class="form-group">
                                    <label for="confirmPassword" style= "color: #4D1193;">Confirm Password</label>
                                    <input type="password" class="form-control" id="confirmPassword" placeholder="Confirm password">
                                </div>
                            </div>
                        </div>

                        <!-- Action Buttons -->
                        <div class="row gutters">
                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                <div class="text-right">
                                    <button type="button" id="cancel" name="cancel" class="btn btn-secondary">Cancel</button>
                                    <button type="submit" id="update" name="update" class="btn btn-primary" style= "background:#4D1193; border:1px solid #4D1193;">Update</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
      </div>
     </form>
     <?php if (isset($_SESSION['update_message'])): ?>
                <div class="alert alert-info mt-3">
                    <?= $_SESSION['update_message'] ?>
                </div>
                <?php unset($_SESSION['update_message']); ?>
            <?php endif; ?>

    </div>
<script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.1/dist/js/bootstrap.bundle.min.js"></script>
<script src="../public/js/userProfile.js"></script>
</body>
</html>