<?php
require_once "includes/auth.php";
require_once "includes/database.php";

if ($_SESSION['role'] !== 'company') {
    header("Location: dashboard.php");
    exit();
}

$job_id = $_GET['id'] ?? null;
$error = '';

// Fetch job to pre-fill the form
$stmt = $conn->prepare("SELECT * FROM jobs WHERE id = ? AND company_id = ?");
$stmt->bind_param("ii", $job_id, $_SESSION["user_id"]);
$stmt->execute();
$result = $stmt->get_result();
$job = $result->fetch_assoc();

if (!$job) {
    die("Job not found or access denied.");
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = trim($_POST["title"]);
    $description = trim($_POST["description"]);
    $deadline = $_POST["deadline"];

    $update = $conn->prepare("UPDATE jobs SET title = ?, description = ?, deadline = ? WHERE id = ? AND company_id = ?");
    $update->bind_param("sssii", $title, $description, $deadline, $job_id, $_SESSION["user_id"]);
    if ($update->execute()) {
        header("Location: company-dashboard.php");
        exit();
    } else {
        $error = "Update failed.";
    }
}
?>

<?php include "includes/header.php"; ?>
<h2>Edit Job</h2>
<form method="POST">
    Title: <input type="text" name="title" value="<?= htmlspecialchars($job['title']) ?>" required><br>
    Description:<br>
    <textarea name="description" required><?= htmlspecialchars($job['description']) ?></textarea><br>
    Deadline: <input type="date" name="deadline" value="<?= $job['deadline'] ?>" required><br>
    <button type="submit">Update Job</button>
</form>
<p style="color:red;"><?= htmlspecialchars($error) ?></p>
<?php include "includes/footer.php"; ?>
