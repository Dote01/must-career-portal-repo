<?php
require_once "includes/auth.php";
include("includes/database.php");
include("includes/header.php");

if (!isset($_GET['job_id'])) {
    echo "<p>Invalid job selection.</p>";
    exit;
}

$job_id = intval($_GET['job_id']);
$user_id = $_SESSION['user_id'] ?? null;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if already applied
    $check = $conn->prepare("SELECT * FROM applications WHERE user_id = ? AND job_id = ?");
    $check->bind_param("ii", $user_id, $job_id);
    $check->execute();
    $result = $check->get_result();

    if ($result->num_rows > 0) {
        echo "<p>You have already applied for this job.</p>";
    } else {
        $stmt = $conn->prepare("INSERT INTO applications (user_id, job_id) VALUES (?, ?)");
        $stmt->bind_param("ii", $user_id, $job_id);
        if ($stmt->execute()) {
            echo "<p>Application submitted successfully!</p>";
        } else {
            echo "<p>Failed to submit application.</p>";
        }
    }
} else {
    // Display job details
    $job = $conn->prepare("SELECT title, company FROM jobs WHERE id = ?");
    $job->bind_param("i", $job_id);
    $job->execute();
    $result = $job->get_result();
    if ($row = $result->fetch_assoc()) {
        echo "<h2>Apply for: " . htmlspecialchars($row['title']) . " at " . htmlspecialchars($row['company']) . "</h2>";
        echo "<form method='POST'>";
        echo "<p>Are you sure you want to apply for this job?</p>";
        echo "<button type='submit' class='btn btn-success'>Yes, Apply</button>";
        echo " <a href='jobs.php' class='btn btn-secondary'>Cancel</a>";
        echo "</form>";
    } else {
        echo "<p>Job not found.</p>";
    }
}

$conn->close();
include("includes/footer.php");
?>
