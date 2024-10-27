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
 <div class="container">
    <?php include "../views/partials/navbar.php"; ?>
    <div class="main-content">
        <div class="row gutters">
            <div class="col-xl-3 col-lg-3 col-md-12 col-sm-12 col-12">
                <div class="card h-100">
                    <div class="card-body">
                        <div class="account-settings">
                            <div class="user-profile">
                                <div class="text-center user-avatar">
                                    <img src="https://bootdey.com/img/Content/avatar/avatar7.png" alt="User Profile Picture" style="border-radius:50%; width: 100%">
                                </div>
                            </div>
                            <div class="text-center mt-4 my-3">
                                <button type="button" class="btn btn-secondary" onclick="document.getElementById('uploadProfilePic').click()">Change Profile Picture</button>
                                <input type="file" id="uploadProfilePic" style="display:none" onchange="previewImage(event)">
                            </div>
                            <div class="text-center about">
                                <h5 style= color:black;>About</h5>
                                <p>I'm Yuki, a Full Stack Designer. I enjoy creating user-centric, delightful, and human experiences.</p>
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
                                <h6 class="mb-2 text-primary">Personal Details</h6>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                                <div class="form-group">
                                    <label for="firstName">First Name</label>
                                    <input type="text" class="form-control" id="firstName" placeholder="Enter first name">
                                </div>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                                <div class="form-group">
                                    <label for="lastName">Last Name</label>
                                    <input type="text" class="form-control" id="lastName" placeholder="Enter last name">
                                </div>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                                <div class="form-group">
                                    <label for="gender">Gender</label>
                                    <select class="form-control" id="gender">
                                        <option value="" disabled selected>Select gender</option>
                                        <option value="female">Female</option>
                                        <option value="male">Male</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <!-- Account Information Section -->
                        <div class="row gutters">
                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                <h6 class="mt-3 mb-2 text-primary">Account Information</h6>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input type="email" class="form-control" id="email" placeholder="Enter email">
                                </div>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                                <div class="form-group">
                                    <label for="role">Role</label>
                                    <select class="form-control" id="role">
                                        <option value="" disabled selected>Select role</option>
                                        <option value="tutor">Tutor</option>
                                        <option value="admin">Admin</option>
                                        <option value="student">Student</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                                <div class="form-group">
                                    <label for="language">Language</label>
                                    <select class="form-control" id="language">
                                        <option value="" disabled selected>Select language</option>
                                        <option value="english">English</option>
                                        <option value="french">French</option>
                                        <option value="spanish">Spanish</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <!-- Login Credentials Section -->
                        <div class="row gutters">
                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                <h6 class="mt-3 mb-2 text-primary">Login Credentials</h6>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                                <div class="form-group">
                                    <label for="password">Password</label>
                                    <input type="password" class="form-control" id="password" placeholder="Enter password">
                                </div>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                                <div class="form-group">
                                    <label for="confirmPassword">Confirm Password</label>
                                    <input type="password" class="form-control" id="confirmPassword" placeholder="Confirm password">
                                </div>
                            </div>
                        </div>

                        <!-- Action Buttons -->
                        <div class="row gutters">
                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                <div class="text-right">
                                    <button type="button" id="cancel" name="cancel" class="btn btn-secondary">Cancel</button>
                                    <button type="button" id="update" name="update" class="btn btn-primary" style= "background:#4D1193; border:1px solid #4D1193;">Update</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
      </div>
    </div>
<script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.1/dist/js/bootstrap.bundle.min.js"></script>
<script src="../public/js/userProfile.js"></script>
</body>
</html>