<?php
session_start();
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'student') {
    header("Location: login.php");
    exit();
}

require_once 'includes/database.php';
$userId = $_SESSION['user_id'];
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Student Dashboard</title>
    <link rel="stylesheet" href="style.css"> <!-- Optional global CSS -->
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }

        .section {
            margin-bottom: 30px;
        }

        h2,
        h3 {
            color: #2c3e50;
        }

        .card {
            background: #f4f4f4;
            padding: 15px;
            border-radius: 6px;
            margin-bottom: 10px;
        }
    </style>
</head>

<body>
    <?php include 'includes/header.php'; ?>

    <h2>Welcome to the Student Dashboard</h2>
    <p>Here you can find career resources, job listings, and application history.</p>

    <div class="section">
        <h3>Career Resources</h3>
        <div class="card">
            <strong>Resume Tips:</strong> Keep it concise, highlight your skills, and tailor it to each job.
        </div>
        <div class="card">
            <strong>Interview Advice:</strong> Research the company, practice common questions, and stay confident.
        </div>
        <div class="card">
            <strong>Learning:</strong> Consider online platforms like Coursera, Udemy, or LinkedIn Learning.
        </div>
    </div>

    <div class="section">
        <h3>Latest Job Listings</h3>
        <?php
        $jobs = $conn->query("SELECT * FROM jobs ORDER BY deadline ASC LIMIT 5");
        if ($jobs && $jobs->num_rows > 0):
            while ($job = $jobs->fetch_assoc()):
        ?>
                <div class="card">
                    <strong><?= htmlspecialchars($job['title']) ?></strong> at <?= htmlspecialchars($job['company']) ?><br>
                    <?= htmlspecialchars($job['description']) ?><br>
                    <em>Deadline: <?= htmlspecialchars($job['deadline']) ?></em><br>
                    <a href="apply.php?job_id=<?= $job['id'] ?>">Apply</a>
                </div>
            <?php endwhile;
        else: ?>
            <p>No job listings found.</p>
        <?php endif; ?>
    </div>

    <div class="section">
        <h3>Your Application History</h3>
        <?php
        $apps = $conn->query("
            SELECT jobs.title, jobs.company, applications.applied_at 
            FROM applications 
            JOIN jobs ON applications.job_id = jobs.id 
            WHERE applications.user_id = $userId 
            ORDER BY applications.applied_at DESC 
            LIMIT 5
        ");
        if ($apps && $apps->num_rows > 0):
            while ($app = $apps->fetch_assoc()):
        ?>
                <div class="card">
                    Applied for <strong><?= htmlspecialchars($app['title']) ?></strong> at <?= htmlspecialchars($app['company']) ?><br>
                    On <?= date("F j, Y", strtotime($app['applied_at'])) ?>
                </div>
            <?php endwhile;
        else: ?>
            <p>You haven't applied for any jobs yet.</p>
        <?php endif; ?>
    </div>

    <?php include 'includes/footer.php'; ?>
</body>

</html>