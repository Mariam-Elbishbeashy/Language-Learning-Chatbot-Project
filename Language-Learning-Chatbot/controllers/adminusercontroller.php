<?php


session_start();

include '../config/dbh.inc.php';


class UserManager {
    private $conn;

    public function __construct($dbConnection) {
        $this->conn = $dbConnection;
    }

    public function addUser($username, $email, $role, $language, $password) {
        $sql = "INSERT INTO users (username, email, password, role, language) 
                VALUES ('$username', '$email', '$password', '$role', '$language')";
        
        if ($this->conn->query($sql) === TRUE) {
            return "New user added successfully";
        } else {
            return "Error: " . $this->conn->error;
        }
    }

    public function editUser($id, $username, $email, $role, $language, $password) {
        if (!empty($password)) {
            $sql = "UPDATE users SET username='$username', email='$email', role='$role', language='$language', password='$password' WHERE Id='$id'";
        } else {
            $sql = "UPDATE users SET username='$username', email='$email', role='$role', language='$language' WHERE Id='$id'";
        }

        if ($this->conn->query($sql) === TRUE) {
            return "User updated successfully";
        } else {
            return "Error: " . $this->conn->error;
        }
    }

    public function removeUser($id) {
        $sql = "DELETE FROM users WHERE Id='$id'";
        
        if ($this->conn->query($sql) === TRUE) {
            return "User removed successfully";
        } else {
            return "Error: " . $this->conn->error;
        }
    }

    public function fetchUsers() {
        $sql = "SELECT * FROM users";
        $result = $this->conn->query($sql);
        $users = [];
        
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $users[] = $row;
            }
        }
        return $users;
    }
}

$userManager = new UserManager($conn);
$message = ""; // Variable to store message

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['addUser'])) {
        $username = $_POST['username'];
        $email = $_POST['email'];
        $role = $_POST['role'];
        $language = $_POST['language'];

        $password = isset($_POST['password']) ? $_POST['password'] : '';

        $message = $userManager->addUser($username, $email, $role, $language, $password);
    } elseif (isset($_POST['editUser'])) {
        $id = $_POST['id'];
        $username = $_POST['username'];
        $email = $_POST['email'];
        $role = $_POST['role'];
        $language = $_POST['language'];

        $password = isset($_POST['password']) ? $_POST['password'] : ''; // Check if password is set

        $message = $userManager->editUser($id, $username, $email, $role, $language, $password);
    } elseif (isset($_POST['removeUser'])) {
        $id = $_POST['id'];
        $message = $userManager->removeUser($id);
    }
}

$users = $userManager->fetchUsers();
$conn->close();

?>


