<?php
include '../config/dbh.inc.php';

$response = ["status" => false, "field" => "", "message" => ""];

if (isset($_POST['email'])) {
    $email = $_POST['email'];
    $stmt = $conn->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows > 0) {
        $response = ["status" => true, "field" => "email", "message" => "Email already exists"];
    }
}

if (isset($_POST['username'])) {
    $username = $_POST['username'];
    $stmt = $conn->prepare("SELECT * FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows > 0) {
        $response = ["status" => true, "field" => "username", "message" => "Username already exists"];
    }
}

echo json_encode($response);
?>
