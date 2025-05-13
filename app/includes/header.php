<?php if (session_status() === PHP_SESSION_NONE) {
    session_start();
} ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>MUST Career Support Portal</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }

        header {
            background-color: #003366;
            color: white;
            padding: 15px 20px;
        }

        header h1 {
            margin: 0;
        }

        nav {
            margin-top: 10px;
        }

        nav a {
            color: white;
            margin-right: 15px;
            text-decoration: none;
            font-weight: bold;
        }

        nav a:hover {
            text-decoration: underline;
        }

        .container {
            max-width: 960px;
            margin: 30px auto;
            padding: 20px;
            background: white;
            border-radius: 8px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        }
    </style>
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