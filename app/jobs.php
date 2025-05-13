<?php require_once "includes/auth.php"; // Handles login session 
include("includes/database.php");
include("includes/header.php"); ?>
<h2>Job Opportunities</h2>
<p>Find the latest job postings tailored to your course and interests.</p>
<?php $result = $conn->query("SELECT * FROM jobs ORDER BY deadline ASC");
if ($result && $result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $title = isset($row['title']) ? htmlspecialchars($row['title']) : 'Untitled Position';
        $company = isset($row['company']) ? htmlspecialchars($row['company']) : 'Unknown Company';
        $description = isset($row['description']) ? nl2br(htmlspecialchars($row['description'])) : 'No description available.';
        $deadline = isset($row['deadline']) ? htmlspecialchars($row['deadline']) : 'No deadline set';
        $jobId = isset($row['id']) ? (int)$row['id'] : 0;
        echo "<div style='border: 1px solid #ccc; padding: 10px; margin-bottom: 15px;'>";
        echo "<h3>$title at $company</h3>";
        echo "<p>$description</p>";
        echo "<p><strong>Deadline:</strong> $deadline</p>";
        echo "<a href='apply.php?job_id=$jobId'>Apply</a>";
        echo "</div>";
    }
} else {
    echo "<p>No job postings available at the moment.</p>";
}
$conn->close();
include("includes/footer.php"); ?>