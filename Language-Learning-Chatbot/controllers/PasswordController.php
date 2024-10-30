<?php
session_start();
include '../config/dbh.inc.php'; // Database connection file

function resetPassword($email, $new_password, $conn) {
    $new_password_hashed = password_hash($new_password, PASSWORD_DEFAULT);
    $stmt = $conn->prepare("UPDATE users SET password = ? WHERE email = ?");
    $stmt->bind_param("ss", $new_password_hashed, $email);
    return $stmt->execute();
}

function checkEmailExists($email, $conn) {
    $stmt = $conn->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();
    return $result->num_rows > 0;
}

$message = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['email'])) {
        $email = $_POST['email'];
        if (checkEmailExists($email, $conn)) {
            $_SESSION['email'] = $email;
            header("Location: ../public/newPassword.php");
            exit();
        } else {
            $message = "Email not found. Please try again.";
        }
    }

    if (isset($_SESSION['email']) && isset($_POST['new_password'])) {
        $email = $_SESSION['email'];
        $new_password = $_POST['new_password'];
        if (resetPassword($email, $new_password, $conn)) {
            unset($_SESSION['email']);
            echo "<script>document.addEventListener('DOMContentLoaded', function() { $('#successModal').modal('show'); });</script>";
        } else {
            $message = "Password update failed. Please try again.";
        }
    }
}
?>
