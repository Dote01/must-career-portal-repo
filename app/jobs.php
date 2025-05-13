<?php
require_once "includes/auth.php"; // Checks login
include("includes/database.php");
include("includes/header.php");

echo "<h2>Job Opportunities</h2>";

$result = $conn->query("SELECT * FROM jobs ORDER BY deadline ASC");
while ($job = $result->fetch_assoc()) {
    echo "<div style='border:1px solid #ccc; padding:15px; margin-bottom:15px;'>";
    echo "<h3>" . htmlspecialchars($job['title']) . " at " . htmlspecialchars($job['company']) . "</h3>";
    echo "<p>" . nl2br(htmlspecialchars($job['description'])) . "</p>";
    echo "<p><strong>Deadline:</strong> " . htmlspecialchars($job['deadline']) . "</p>";
    echo "<a href='apply.php?job_id=" . urlencode($job['id']) . "' class='btn btn-primary'>Apply</a>";
    echo "</div>";
}
$conn->close();

include("includes/footer.php");
?>
