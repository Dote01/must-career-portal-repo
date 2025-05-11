<?php
require_once "includes/auth.php";
require_once "includes/database.php";

if ($_SESSION['role'] !== 'company') {
    header("Location: dashboard.php");
    exit();
}

$error = '';
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = trim($_POST["title"]);
    $description = trim($_POST["description"]);
    $deadline = $_POST["deadline"];
    $company_id = $_SESSION["user_id"];

    $stmt = $conn->prepare("INSERT INTO jobs (company_id, title, description, deadline) VALUES (?, ?, ?, ?)");
    if ($stmt) {
        $stmt->bind_param("isss", $company_id, $title, $description, $deadline);
        if ($stmt->execute()) {
            header("Location: company-dashboard.php");
            exit();
        } else {
            $error = "Error saving job: " . $stmt->error;
        }
        $stmt->close();
    } else {
        $error = "Database error.";
    }
}
?>

<?php include "includes/header.php"; ?>
<h2>Create Job Posting</h2>
<form method="POST">
    Title: <input type="text" name="title" required><br>
    Description:<br>
    <textarea name="description" required></textarea><br>
    Deadline: <input type="date" name="deadline" required><br>
    <button type="submit">Post Job</button>
</form>
<p style="color:red;"><?= htmlspecialchars($error) ?></p>
<?php include "includes/footer.php"; ?>
