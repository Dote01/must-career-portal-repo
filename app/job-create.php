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

    if (empty($title) || empty($description) || empty($deadline)) {
        $error = "All fields are required.";
    } else {
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
            $error = "Database error: " . $conn->error;
        }
    }
}
?>

<?php include "includes/header.php"; ?>
<h2>Create Job Posting</h2>

<form method="POST">
    <label>Title:</label><br>
    <input type="text" name="title" required><br><br>

    <label>Description:</label><br>
    <textarea name="description" rows="4" cols="50" required></textarea><br><br>

    <label>Deadline:</label><br>
    <input type="date" name="deadline" required><br><br>

    <button type="submit">Post Job</button>
</form>

<?php if (!empty($error)): ?>
    <p style="color:red;"><?= htmlspecialchars($error) ?></p>
<?php endif; ?>

<?php include "includes/footer.php"; ?>