<?php include '../Language-Learning-Chatbot/controllers/SignupController.php';?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Sign Up Form</title>
  <link rel="stylesheet" href="../public/css/signup.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>
    <div class="container">
        <header>Sign Up Form</header>
        <div class="progress-bar">
            <div class="step">
                <p>Contact</p>
                <div class="bullet">
                    <span>1</span>
                </div>
                <div class="check fas fa-check"></div>
            </div>
            <div class="step">
                <p>Security</p>
                <div class="bullet">
                    <span>2</span>
                </div>
                <div class="check fas fa-check"></div>
            </div>
            <div class="step">
                <p>Identity</p>
                <div class="bullet">
                    <span>3</span>
                </div>
                <div class="check fas fa-check"></div>
            </div>
            <div class="step">
                <p>Role</p>
                <div class="bullet">
                    <span>4</span>
                </div>
                <div class="check fas fa-check"></div>
            </div>
            <div class="step">
                <p>Language</p>
                <div class="bullet">
                    <span>5</span>
                </div>
                <div class="check fas fa-check"></div>
            </div>
            <div class="step">
                <p>Success!</p>
                <div class="bullet">
                    <span>6</span>
                </div>
                <div class="check fas fa-check"></div>
            </div>
        </div>

        <div class="form-outer">
            <form id="signupForm" action="" method="post">
                <div class="page slide-page">
                    <div class="title">Contact:</div>
                    <div class="field">
                        <div class="label">Email Address</div>
                        <input type="text" id="email" name="email" />
                    </div>
                    <div class="error" id="emailError"></div> 
                    <div class="field">
                        <div class="label">Username</div>
                        <input type="text" id="username"  name="username" />
                    </div>
                    <div class="error" id="usernameError"></div> 
                    <div class="field">
                        <button class="firstNext next">Next</button>
                    </div>
                </div>

                <div class="page">
                    <div class="title">Security:</div>
                    <div class="field">
                        <div class="label">Password</div>
                        <input type="password" id="password" name="password">
                    </div>
                    <div class="error" id="passwordError"></div> 
                    <div class="field">
                        <div class="label">Confirm Password</div>
                        <input type="password" id="confirmPassword" name="confirmPassword" />
                    </div>
                    <div class="error" id="confirmPasswordError"></div> 
                    <div class="field btns">
                        <button class="prev-1 prev">Previous</button>
                        <button class="next-1 next">Next</button>
                    </div>
                </div>

                <div class="page">
                    <div class="title">Gender:</div>
                    <div class="field">
                        <div class="label">Gender</div>
                        <div class="radio-group">
                            <label class="radio">
                                <input type="radio" name="gender" value="male">
                                <img src="./images/male.png" alt="Male Icon" width="30" height="30"> Male
                            </label>
                            <label class="radio">
                                <input type="radio" name="gender" value="female">
                                <img src="./images/female.png" alt="Female Icon" width="30" height="30"> Female
                            </label>
                        </div>
                    </div>
                    <div class="error" id="genderError"></div> 
                    <div class="field btns">
                        <button class="prev-2 prev">Previous</button>
                        <button class="next-2 next">Next</button>
                    </div>
                </div>
                

                <div class="page">
                    <div class="title">Select Role:</div>
                    <div class="field">
                        <div class="label">Role</div>
                        <div class="radio-group">
                           <label class="radio">
                              <input type="radio" name="role" value="student"  >
                              <img src="./images/student.png" alt="Student Icon" width="30" height="30"> Student
                           </label>
                           <label class="radio">
                              <input type="radio" name="role" value="tutor"  >
                              <img src="./images/teacher.png" alt="Tutor Icon" width="30" height="30"> Tutor
                           </label>
                        </div>
                    </div>
                    <div class="error" id="roleError"></div>
                    <div class="field btns">
                       <button class="prev-3 prev">Previous</button>
                       <button class="next-3 next">Next</button>
                    </div>
                 </div>

                 <div class="page">
                    <div class="title">Languages:</div>
                    <div class="field">
                        <div class="label">Select Language</div>
                        <select id="language" name="language" >
                            <option value="" disabled selected>Select a language</option>
                            <option value="english">English</option>
                            <option value="french">French</option>
                            <option value="spanish">Spanish</option>
                        </select>
                    </div>
                    <div class="error" id="languageError"></div> 
                    <div class="field btns">
                        <button class="prev-4 prev">Previous</button>
                        <button class="next-4 next">Next</button>
                    </div>
                </div>

                <div class="page">
                    <div class="title">Success!</div>
                    <div class="field">
                        <p class="success-message">You have successfully signed up!</p>
                    </div>
                    <div class="field btns">
                        <input type ="submit" class="submit" value="Sign Up"></a>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <script src="../public/js/signup.js"></script>
</body>
</html>

