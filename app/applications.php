<?php
require_once "includes/auth.php";
require_once "includes/database.php";
include "includes/header.php";

$userId = $_SESSION['user_id'];

$result = $conn->query("
    SELECT jobs.title, jobs.company, applications.applied_at 
    FROM applications 
    JOIN jobs ON applications.job_id = jobs.id 
    WHERE applications.user_id = $userId 
    ORDER BY applications.applied_at DESC
");
?>

<div style="max-width: 800px; margin: auto; padding: 20px;">
    <h2>Your Job Applications</h2>

    <?php if ($result && $result->num_rows > 0): ?>
        <?php while ($row = $result->fetch_assoc()): ?>
            <div style="background: #f9f9f9; padding: 15px; border: 1px solid #ddd; margin-bottom: 10px; border-radius: 5px;">
                <strong><?= htmlspecialchars($row['title']) ?></strong> at <?= htmlspecialchars($row['company']) ?><br>
                Applied on: <?= date("F j, Y", strtotime($row['applied_at'])) ?>
            </div>
        <?php endwhile; ?>
    <?php else: ?>
        <p>You have not applied for any jobs yet.</p>
    <?php endif; ?>

    <div style="margin-top: 20px;">
        <a href="dashboard.php" style="text-decoration: none; color: #3498db;">← Back to Dashboard</a>
    </div>
</div>

<?php include "includes/footer.php"; ?>
