<?php
require_once "includes/auth.php";
require_once "includes/database.php";

if ($_SESSION['role'] !== 'student') {
    header("Location: jobs.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['job_id'])) {
    $job_id = (int) $_POST['job_id'];
    $user_id = $_SESSION["user_id"];

    // Prevent duplicate applications
    $stmt = $conn->prepare("SELECT id FROM applications WHERE user_id = ? AND job_id = ?");
    $stmt->bind_param("ii", $user_id, $job_id);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        $message = "You have already applied for this job.";
    } else {
        // Insert application
        $stmt = $conn->prepare("INSERT INTO applications (user_id, job_id) VALUES (?, ?)");
        $stmt->bind_param("ii", $user_id, $job_id);
        if ($stmt->execute()) {
            $message = "Application submitted successfully!";
        } else {
            $message = "Error submitting application.";
        }
    }

    $stmt->close();
} else {
    $message = "Invalid request.";
}
?>

<?php include "includes/header.php"; ?>
<h2>Job Application</h2>
<p><?= htmlspecialchars($message) ?></p>
<a href="jobs.php">← Back to Job Listings</a>
<?php include "includes/footer.php"; ?>