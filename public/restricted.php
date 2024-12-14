<?php
session_start();
$requiredRole = htmlspecialchars($_GET['role']);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Access Denied</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="../public/css/restricted.css"> 
</head>
<body>
    <div class="container">
        <h2>Access Denied</h2>
        <p>You do not have permission to access this page. Please contact your administrator if you think this is a mistake.</p>
        <a href="home.php" class="btn btn-custom">Return to Home</a>
    </div>
</body>
</html>
