<?php
session_start();

if (!isset($_SESSION['firstName']) || !isset($_SESSION['lastName'])) {
    header("Location: ../public/login.php");
    exit();
}

// Retrieve names from session
$firstName = $_SESSION['firstName'];
$lastName = $_SESSION['lastName'];

include_once "../config/dbh.inc.php";

function signup($email, $username, $password, $confirmPassword, $gender, $role, $language, $firstName, $lastName, $conn) {
    $error = '';
    $sql = "SELECT * FROM users WHERE username='$username' OR email='$email'";
    $result = mysqli_query($conn, $sql);
    $num = mysqli_num_rows($result);
    
    if ($num == 0) {
        if ($password === $confirmPassword) {
            $hash = password_hash($password, PASSWORD_DEFAULT);
            $confirmhash = password_hash($confirmPassword, PASSWORD_DEFAULT);
            $defaultProfileImage = '../public/images/user.png';
            $sql = "INSERT INTO users (firstName, lastName, username, password,confirmPassword, email, gender, role, language , profileImage) VALUES ('$firstName', '$lastName', '$username', '$hash','$confirmhash', '$email', '$gender', '$role', '$language' , '$defaultProfileImage')";
            $result = mysqli_query($conn, $sql);
            if ($result) {
                unset($_SESSION['firstName']);
                unset($_SESSION['lastName']);
                header("Location: ../public/login.php");
                exit();
            } else {
                $error = "Database error: " . mysqli_error($conn);
            }
        } else {
            $error = "Passwords do not match.";
        }
    } else {
        $error = "Username or email not available.";
    }
    return $error;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = htmlspecialchars($_POST["email"]);
    $username = htmlspecialchars($_POST["username"]);
    $password = htmlspecialchars($_POST["password"]);
    $confirmPassword = htmlspecialchars($_POST["confirmPassword"]);
    $gender = htmlspecialchars($_POST["gender"]);
    $role = htmlspecialchars($_POST["role"]);
    $language = htmlspecialchars($_POST["language"]);
    
    $error = signup($email, $username, $password, $confirmPassword, $gender, $role, $language, $firstName, $lastName, $conn);
}
?>
