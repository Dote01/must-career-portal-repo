<?php
require_once "includes/auth.php";
require_once "includes/database.php";
include "includes/header.php";

// Get current user's info
$userId = $_SESSION['user_id'];
$username = $_SESSION['username'] ?? 'User';
$role = $_SESSION['role'] ?? 'student';

// Count total jobs
$jobCount = 0;
$jobQuery = $conn->query("SELECT COUNT(*) AS total FROM jobs");
if ($jobQuery) {
    $jobCount = $jobQuery->fetch_assoc()['total'] ?? 0;
}

// Count user applications
$appCount = 0;
$appQuery = $conn->query("SELECT COUNT(*) AS total FROM applications WHERE user_id = $userId");
if ($appQuery) {
    $appCount = $appQuery->fetch_assoc()['total'] ?? 0;
}

// Fetch recent applications
$recentApps = $conn->query("
    SELECT jobs.title, jobs.company, applications.applied_at 
    FROM applications 
    JOIN jobs ON applications.job_id = jobs.id 
    WHERE applications.user_id = $userId 
    ORDER BY applications.applied_at DESC 
    LIMIT 5
");
?>

<div style="max-width: 900px; margin: auto; padding: 20px;">
    <h2>Welcome, <?= htmlspecialchars($username) ?>!</h2>
    <p>You are logged in as <strong><?= htmlspecialchars($role) ?></strong></p>

    <div style="margin-top: 20px; display: flex; gap: 20px;">
        <div style="flex: 1; background: #ecf0f1; padding: 15px; border-radius: 8px;">
            <h3>Total Job Listings</h3>
            <p style="font-size: 22px; color: #2980b9;"><?= $jobCount ?></p>
            <a href="jobs.php">Browse Jobs</a>
        </div>

        <div style="flex: 1; background: #ecf0f1; padding: 15px; border-radius: 8px;">
            <h3>Your Applications</h3>
            <p style="font-size: 22px; color: #27ae60;"><?= $appCount ?></p>
            <a href="applications.php">View Applications</a>
        </div>
    </div>

    <div style="margin-top: 30px;">
        <h3>Recent Applications</h3>
        <?php if ($recentApps && $recentApps->num_rows > 0): ?>
            <ul>
                <?php while ($app = $recentApps->fetch_assoc()): ?>
                    <li>
                        <?= htmlspecialchars($app['title']) ?> at <?= htmlspecialchars($app['company']) ?> —
                        <em><?= date("M d, Y", strtotime($app['applied_at'])) ?></em>
                    </li>
                <?php endwhile; ?>
            </ul>
        <?php else: ?>
            <p>No recent applications found.</p>
        <?php endif; ?>
    </div>

    <div style="margin-top: 30px;">
        <a href="career.php" style="background: #3498db; color: white; padding: 10px 15px; border-radius: 5px; text-decoration: none;">Explore Career Guidance</a>
        <a href="logout.php" style="margin-left: 15px; color: #c0392b;">Logout</a>
    </div>
</div>

<?php include "includes/footer.php"; ?>