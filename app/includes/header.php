<?php if (session_status() === PHP_SESSION_NONE) {
    session_start();
} ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>MUST Career Support Portal</title>
    <link rel="stylesheet" href="assets/css/style.css"> <!-- ✅ Add this line -->
</head>
<body>
    <header>
        <h1>MUST Career Support Portal</h1>
        <nav>
            <a href="index.php">Home</a>
            <a href="career.php">Career Guidance</a>
            <a href="jobs.php">Job Opportunities</a>

            <?php if (isset($_SESSION['role']) && $_SESSION['role'] == 'student'): ?>
                <a href="student-dashboard.php">Dashboard</a>
            <?php elseif (isset($_SESSION['role']) && $_SESSION['role'] == 'company'): ?>
                <a href="company-dashboard.php">Dashboard</a>
                <a href="job-create.php">Post a Job</a>
            <?php endif; ?>

            <?php if (isset($_SESSION['user_id'])): ?>
                <a href="logout.php">Logout</a>
            <?php else: ?>
                <a href="login.php">Login</a>
                <a href="register.php">Register</a>
            <?php endif; ?>
        </nav>
    </header>
    <div class="container">
