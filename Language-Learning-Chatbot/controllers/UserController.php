<?php
require_once '../config/dbh.inc.php';

class UserController {
    private $conn;

    public function __construct($dbConnection) {
        $this->conn = $dbConnection;
    }

    public function updateProfile($Id, $firstName, $lastName, $gender, $email, $role, $language, $currentPassword, $newPassword, $confirmPassword) {
        // Start with the basic SQL statement
        $sql = "UPDATE users SET firstName = '$firstName', lastName = '$lastName', gender = '$gender', email = '$email', role = '$role', language = '$language'".$_SESSION['ID'];
        
        // Check if password update is requested and valid
        if (!empty($newPassword) && $newPassword === $confirmPassword) {
            $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);
            $sql .= ", password = '$hashedPassword'";
        } elseif (!empty($newPassword) && $newPassword !== $confirmPassword) {
            return "New password and confirm password do not match.";
        }

        // Append the condition to match the user ID and current password
        $sql .= " WHERE Id = '$Id' AND password = '$currentPassword'";  // Only update if the current password matches

        
        // Execute the query
        if (mysqli_query($this->conn, $sql)) {
            return "Profile updated successfully.";
        } else {
            return "An error occurred while updating the profile.";
        }
    }
}
