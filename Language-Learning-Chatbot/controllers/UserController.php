<?php
require_once '../config/dbh.inc.php';

class UserController {
    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    public function handleProfileUpdate() {
        if (isset($_POST['cancel'])) {
            header("Location: userProfile.php");
            exit();
        }
    
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update'])) {
            $errors = [];
    
            // Retrieve inputs
            $firstName = mysqli_real_escape_string($this->conn, trim($_POST['firstName'] ?? ''));
            $lastName = mysqli_real_escape_string($this->conn, trim($_POST['lastName'] ?? ''));
            $gender = mysqli_real_escape_string($this->conn, trim($_POST['gender'] ?? ''));
            $email = mysqli_real_escape_string($this->conn, trim($_POST['email'] ?? ''));
            $role = mysqli_real_escape_string($this->conn, trim($_POST['role'] ?? ''));
            $language = mysqli_real_escape_string($this->conn, trim($_POST['language'] ?? ''));
            $newPassword = mysqli_real_escape_string($this->conn, trim($_POST['newPassword'] ?? ''));
            $confirmPassword = mysqli_real_escape_string($this->conn, trim($_POST['confirmPassword'] ?? ''));
    
            if (empty($firstName)) {
                $errors['firstName'] = 'First name is required';
            }
            if (empty($lastName)) {
                $errors['lastName'] = 'Last name is required';
            }
            if (empty($gender)) {
                $errors['gender'] = 'Gender is required';
            }
            if (empty($email)) {
                $errors['email'] = 'Email is required';
            } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $errors['email'] = 'Invalid email format';
            } else {
                $userId = $_SESSION['userId'];
                $sql = "SELECT id FROM users WHERE email = '$email' AND id != '$userId'";
                $result = mysqli_query($this->conn, $sql);
                if (mysqli_num_rows($result) > 0) {
                    $errors['email'] = 'Email is already taken';
                }
            }
            if (empty($role)) {
                $errors['role'] = 'Role is required';
            }
            if (empty($language)) {
                $errors['language'] = 'Language is required';
            }
            if (!empty($newPassword) && !preg_match('/^(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/', $newPassword)) {
                $errors['newPassword'] = 'Password must be at least 8 characters long and include a number and a special character';
            }
            if (!empty($newPassword) && $newPassword !== $confirmPassword) {
                $errors['confirmPassword'] = 'Passwords do not match';
            }
            
            $profileImagePath = $_SESSION['profileImage']; 

            if (!empty($_POST['removeProfileFlag']) && $_POST['removeProfileFlag'] == "1") 
            {
                $profileImagePath = 'images/user.png';
            } 
            elseif (isset($_FILES['profileImage']) && $_FILES['profileImage']['error'] === UPLOAD_ERR_OK) {
                $fileTmpName = $_FILES['profileImage']['tmp_name'];
                $fileName = basename($_FILES['profileImage']['name']);
                $fileExtension = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
    
    
                $allowedExtensions = ['jpg', 'jpeg', 'png'];
                if (in_array($fileExtension, $allowedExtensions)) 
                {
                    $uploadDir = '../public/uploads/';
                    if (!is_dir($uploadDir)) {
                        mkdir($uploadDir, 0777, true);  // Create the directory if it doesn't exist
                    }
    
                    // Generate a unique filename
                    $newFileName = uniqid('profile_', true) . '.' . $fileExtension;
    
                    // Move uploaded file to the directory
                    if (move_uploaded_file($fileTmpName, $uploadDir . $newFileName)) {
                        $profileImagePath = 'uploads/' . $newFileName;  
                    } else {
                        $errors['profileImage'] = 'Error uploading profile image';
                    }
                } else {
                    $errors['profileImage'] = 'Invalid file type. Only JPG, JPEG, and PNG files are allowed.';
                }
            }
    
            if (!empty($errors)) {
                $_SESSION['errors'] = $errors;
                $_SESSION['update_message'] = 'Profile update failed. Please correct the errors.';
                return;
            }
    
            $query = "UPDATE users SET 
                        firstName = '$firstName', 
                        lastName = '$lastName', 
                        gender = '$gender', 
                        email = '$email', 
                        role = '$role', 
                        language = '$language'";
    
            if (!empty($newPassword)) {
                $passwordHash = password_hash($newPassword, PASSWORD_DEFAULT);
                $confirmPasswordHash = password_hash($confirmPassword, PASSWORD_DEFAULT); 
                $query .= ", password = '$passwordHash', confirmPassword = '$confirmPasswordHash'";
            }
    
            if (isset($profileImagePath)) {
                $query .= ", profileImage = '$profileImagePath'";  
            }
    
            $query .= " WHERE id = " . $_SESSION['userId'];
    
            if (mysqli_query($this->conn, $query)) {
                $_SESSION['firstName'] = $firstName;
                $_SESSION['lastName'] = $lastName;
                $_SESSION['gender'] = $gender;
                $_SESSION['email'] = $email;
                $_SESSION['role'] = $role;
                $_SESSION['language'] = $language;
                $_SESSION['profileImage'] = $profileImagePath ?? $_SESSION['profileImage']; 
                $_SESSION['update_message'] = 'Profile updated successfully!';
                header("Location: userProfile.php");
                exit();
            } else {
                $_SESSION['update_message'] = 'Error updating profile: ' . mysqli_error($this->conn);
            }
            
        }
    }
    
}
?>
