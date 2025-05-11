<?php
require_once "includes/auth.php"; // Starts session and checks login
include("includes/database.php");
include("includes/header.php");
?>

<h2>Job Opportunities</h2>

<?php
$result = $conn->query("SELECT * FROM jobs ORDER BY deadline DESC");
while ($row = $result->fetch_assoc()) {
    echo "<div>";
    echo "<h3>" . htmlspecialchars($row['title']) . " at " . htmlspecialchars($row['company']) . "</h3>";
    echo "<p>" . nl2br(htmlspecialchars($row['description'])) . "</p>";
    echo "<strong>Deadline:</strong> " . htmlspecialchars($row['deadline']) . "<br>";

    // Show Apply button if the user is a student
    if ($_SESSION['role'] === 'student') {
        echo '<form method="POST" action="job-apply.php" style="margin-top:10px;">';
        echo '<input type="hidden" name="job_id" value="' . (int)$row['id'] . '">';
        echo '<button type="submit">Apply</button>';
        echo '</form>';
    }

    echo "</div><hr>";
}
$conn->close();

include("includes/footer.php");
?>
