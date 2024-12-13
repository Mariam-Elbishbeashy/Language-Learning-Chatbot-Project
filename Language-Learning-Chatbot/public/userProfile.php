<?php 
session_start();

require_once '../controllers/UserController.php';
require_once '../model/UserModel.php';
require_once '../db/dbh.inc.php';

$userModel = new UserModel($conn);
$userController = new UserController($userModel);
$userController->edit();

$errors = $_SESSION['errors'] ?? [];
$updateMessage = $_SESSION['update_message'] ?? '';


if (!isset($_SESSION['userId'])) {
    header("Location: ../public/error.php");
    exit();
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
    <form action="userProfile.php" method="POST" enctype="multipart/form-data">
        <div class="row gutters">
            <div class="col-xl-3 col-lg-3 col-md-12 col-sm-12 col-12">
                <div class="card h-100">
                    <div class="card-body">
                        <div class="account-settings">
                            <div class="user-profile">
                                <div class="text-center user-avatar">
                                    <img id="profileImage" name="profileImage" src="../public/<?= $_SESSION['profileImage'] ?? '../public/images/user.png' ?>" alt="User Profile Picture" style="border-radius:50%; width: 100%; aspect-ratio: 1 / 1; object-fit: cover" >
                                </div>
                            </div>
                            <div class="text-center mt-4 my-3">
                                <div class="profile-picture-actions">
                                    <button type="button" class="btn" style="border: 1px solid lightgrey" onclick="document.getElementById('uploadProfilePic').click()">Change Profile </button>
                                    <input type="file" id="uploadProfilePic" name="profileImage" style="display:none" onchange="previewImage(event)">

                                    <button type="button" class="btn" style="border: 1px solid lightgrey" onclick="removeProfilePicture()">Remove Profile </button>
                                    <input type="hidden" id="removeProfileFlag" name="removeProfileFlag" value="0">
                                </div>
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
                                <h6 class="mb-3 " style="color:#4D1193;">Personal Details</h6>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                                <div class="form-group">
                                    <label for="firstName" style= "color: #4D1193;">First Name</label>
                                    <input type="text" class="form-control" id="firstName" name="firstName" value="<?= htmlspecialchars($_POST['firstName'] ?? $_SESSION['firstName']) ?>">
                                    <?php if (!empty($errors['firstName'])): ?>
                                        <small class="form-text text-danger"><?= $errors['firstName'] ?></small>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                                <div class="form-group">
                                    <label for="lastName" style= "color: #4D1193;">Last Name</label>
                                    <input type="text" class="form-control" id="lastName" name="lastName" value="<?= htmlspecialchars($_POST['lastName'] ?? $_SESSION['lastName']) ?>">
                                    <?php if (!empty($errors['lastName'])): ?>
                                        <small class="form-text text-danger"><?= $errors['lastName'] ?></small>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                                <div class="form-group">
                                    <label for="gender" style= "color: #4D1193;">Gender</label>
                                    <select class="form-control" id="gender" name="gender">
                                        <option value="" disabled>Select gender</option>
                                        <option value="male" <?= (($_POST['gender'] ?? $_SESSION['gender']) === 'male') ? 'selected' : '' ?>>Male</option>
                                        <option value="female" <?= (($_POST['gender'] ?? $_SESSION['gender']) === 'female') ? 'selected' : '' ?>>Female</option>
                                    </select>
                                    <?php if (!empty($errors['gender'])): ?>
                                        <small class="form-text text-danger"><?= $errors['gender'] ?></small>
                                    <?php endif; ?> 
                                </div>
                            </div>
                        </div>

                        <!-- Account Information Section -->
                        <div class="row gutters">
                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                <h6 class="mt-3 mb-3 " style="color:#4D1193;">Account Information</h6>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                                <div class="form-group">
                                <label for="email" style= "color: #4D1193;">Email</label>
                                <input type="email" class="form-control" id="email" name="email" value="<?= htmlspecialchars($_POST['email'] ?? $_SESSION['email'] ?? '') ?>">
                                <?php if (isset($_SESSION['errors']['email'])): ?>
                                    <small><div class="form-text text-danger"><?php echo $_SESSION['errors']['email']; ?></div></small>
                                <?php endif; ?>
                                <?php unset($_SESSION['errors']); ?>
                            </div>
                            </div>
                            
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                                <div class="form-group">
                                    <label for="language" style= "color: #4D1193;">Language</label>
                                    <select class="form-control" id="language" name="language">
                                        <option value="" disabled>Select your language</option>
                                        <option value="english" <?= (($_POST['language'] ?? $_SESSION['language']) === 'english') ? 'selected' : '' ?>>English</option>
                                        <option value="french" <?= (($_POST['language'] ?? $_SESSION['language']) === 'french') ? 'selected' : '' ?>>French</option>
                                        <option value="spanish" <?= (($_POST['language'] ?? $_SESSION['language']) === 'spanish') ? 'selected' : '' ?>>Spanish</option>
                                    </select>
                                    <?php if (!empty($errors['language'])): ?>
                                        <small class="form-text text-danger"><?= $errors['language'] ?></small>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>

                        <!-- Login Credentials Section -->
                        <div class="row gutters">
                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                <h6 class="mt-3 mb-3" style="color:#4D1193;">Login Credentials</h6>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                                <div class="form-group">
                                    <label for="newPassword" style= "color: #4D1193;">New Password</label>
                                    <input type="password" class="form-control" name="newPassword" id="newPassword" placeholder="Enter new password">
                                    <?php if (!empty($errors['newPassword'])): ?>
                                        <small class="form-text text-danger"><?= htmlspecialchars($errors['newPassword']) ?></small>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                                <div class="form-group">
                                    <label for="confirmPassword" style= "color: #4D1193;">Confirm Password</label>
                                    <input type="password" class="form-control" name="confirmPassword" id="confirmPassword" placeholder="Confirm password">
                                    <?php if (!empty($errors['confirmPassword'])): ?>
                                        <small class="form-text text-danger"><?= htmlspecialchars($errors['confirmPassword']) ?></small>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>

                        <!-- Action Buttons -->
                        <div class="row gutters">
                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                <div class="text-right">
                                    <button type="submit" id="cancel" name="cancel" class="btn btn-secondary" onclick="handleCancel()">Cancel</button>
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
            <div id="popupAlert" class="popup-alert">
                <div class="popup-content">
                    <p><?php echo $_SESSION['update_message']; ?></p>
                    <button id="closePopup" class="popup-close-btn">Close</button>
                </div>
            </div>
            <?php unset($_SESSION['update_message']); ?>  
        <?php endif; ?>

    </div>

<script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.1/dist/js/bootstrap.bundle.min.js"></script>
<script src="../public/js/userProfile.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

</body>
</html>