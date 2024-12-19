<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
if (!isset($_SESSION['firstName']) || !isset($_SESSION['lastName'])) {
    header("Location: ../public/login.php");
    exit();
}

include_once(__DIR__. '/../db/dbh.inc.php');

class UserManager {
    private $conn;
    private $firstName;
    private $lastName;

    public function __construct($conn) {
        $this->conn = $conn;

        // Retrieve names from session
        if (isset($_SESSION['firstName']) && isset($_SESSION['lastName'])) {
            $this->firstName = $_SESSION['firstName'];
            $this->lastName = $_SESSION['lastName'];
        } else {
            header("Location: ../public/login.php");
            exit();
        }
    }

    public function addUser($data) {
        $error = '';
        $email = htmlspecialchars($data['email']);
        $username = htmlspecialchars($data['username']);
        $password = htmlspecialchars($data['password']);
        $confirmPassword = htmlspecialchars($data['confirm_password']);
        $role = htmlspecialchars($data['role']);
        $language = htmlspecialchars($data['language']);

        $sql = "SELECT * FROM users WHERE username='$username' OR email='$email'";
        $result = mysqli_query($this->conn, $sql);

        if (mysqli_num_rows($result) == 0) {
            if ($password === $confirmPassword) {
                $hash = password_hash($password, PASSWORD_DEFAULT);
                $defaultProfileImage = '../public/images/user.png';
                $sql = "INSERT INTO users (firstName, lastName, username, password, email, role, language, profileImage)
                        VALUES ('$this->firstName', '$this->lastName', '$username', '$hash', '$email', '$role', '$language', '$defaultProfileImage')";
                if (mysqli_query($this->conn, $sql)) {
                    header("Location: ../public/adminusers.php");
                    exit();
                } else {
                    $error = "Database error: " . mysqli_error($this->conn);
                }
            } else {
                $error = "Passwords do not match.";
            }
        } else {
            $error = "Username or email already exists.";
        }

        return $error;
    }

    public function editUser($data) {
        $error = '';
        $id = htmlspecialchars($data['id']);
        $email = htmlspecialchars($data['email']);
        $username = htmlspecialchars($data['username']);
        $role = htmlspecialchars($data['role']);
        $language = htmlspecialchars($data['language']);
        $password = !empty($data['password']) ? password_hash($data['password'], PASSWORD_DEFAULT) : null;
        
        // Prepare the SQL query to update the user
        $sql = "UPDATE users SET username='$username', email='$email', role='$role', language='$language'";

        // If a password is provided, update it
        if ($password) {
            $sql .= ", password='$password'";
        }

        $sql .= " WHERE Id='$id'";

        if (mysqli_query($this->conn, $sql)) {
            header("Location: ../public/adminusers.php");
            exit();
            
        } else {
            $error = "Database error: " . mysqli_error($this->conn);
        }

        return $error;
    }

    public function removeUser($id) {
        $sql = "DELETE FROM users WHERE Id='$id'";
        if (mysqli_query($this->conn, $sql)) {
            return "User removed successfully.";
        } else {
            return "Error: " . mysqli_error($this->conn);
        }
    }

    public function fetchUsers() {
        $sql = "SELECT * FROM users";
        $result = mysqli_query($this->conn, $sql);
        $users = [];
        if ($result && mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                $users[] = $row;
            }
        }
        return $users;
    }


}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['action']) && $_POST['action'] == 'addUser') {
        $userManager = new UserManager($conn);
        $error = $userManager->addUser($_POST);
    }

    if (isset($_POST['action']) && $_POST['action'] == 'editUser') {
        $userManager = new UserManager($conn);
        $error = $userManager->editUser($_POST);
    }

    if (isset($_POST['removeUser'])) {
        $userManager = new UserManager($conn);
        $error = $userManager->removeUser($_POST['id']);
    }
}