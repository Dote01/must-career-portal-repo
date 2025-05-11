<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// If user is not logged in, redirect to login
if (!isset($_SESSION["user_id"])) {
    header("Location: login.php");
    exit();
}
