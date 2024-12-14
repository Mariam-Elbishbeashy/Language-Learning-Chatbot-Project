<?php
session_start();
include_once "../db/dbh.inc.php";

function restrictPageAccess($requiredRole, $redirectUrl) {
    if (!isset($_SESSION['userId'])) {
        header("Location: ../public/login.php");
        exit();
    }

    $userId = $_SESSION['userId'];
    global $conn;
    if (!checkUserRole($userId, $requiredRole, $conn)) {
        header("Location: restricted.php?role=" . $requiredRole);
        exit();
    }
}
?>
