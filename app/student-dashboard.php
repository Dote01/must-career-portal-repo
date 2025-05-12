<?php
session_start();
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'student') {
    header("Location: login.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Student Dashboard</title>
    <link rel="stylesheet" href="style.css"> <!-- If you have a global CSS -->
</head>
<body>
    <?php include 'includes/header.php'; ?>
    <h2>Welcome to the Student Dashboard</h2>
    <p>Here you can find career resources, job listings, and application history.</p>
</body>
</html>
