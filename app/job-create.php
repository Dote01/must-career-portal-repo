<?php
require_once "includes/auth.php";
require_once "includes/database.php";

if ($_SESSION['role'] !== 'company') {
    header("Location: dashboard.php");
    exit();
}

$error   = '';
$success = '';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $title       = trim($_POST["title"]);
    $description = trim($_POST["description"]);
    $deadline    = $_POST["deadline"];
    $company_id  = $_SESSION["user_id"];

    // Validate inputs
    if (empty($title) || empty($description) || empty($deadline)) {
        $error = "All fields are required.";
    } else {
        $stmt = $conn->prepare(
            "INSERT INTO jobs (company_id, title, description, deadline) 
             VALUES (?, ?, ?, ?)"
        );
        if ($stmt) {
            $stmt->bind_param("isss", $company_id, $title, $description, $deadline);
            if ($stmt->execute()) {
                $success = "Job posting created successfully!";
                // Clear form values
                $title = $description = $deadline = '';
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

<div class="form-container">
  <h2>Create Job Posting</h2>

  <?php if ($success): ?>
    <div class="alert success"><?= htmlspecialchars($success) ?></div>
  <?php endif; ?>

  <?php if ($error): ?>
    <div class="alert error"><?= htmlspecialchars($error) ?></div>
  <?php endif; ?>

  <form method="POST">
    <label for="title">Title</label>
    <input 
      type="text" id="title" name="title" 
      value="<?= htmlspecialchars($title ?? '') ?>" 
      required
    >

    <label for="description">Description</label>
    <textarea 
      id="description" name="description" rows="4" 
      required
    ><?= htmlspecialchars($description ?? '') ?></textarea>

    <label for="deadline">Deadline</label>
    <input 
      type="date" id="deadline" name="deadline" 
      value="<?= htmlspecialchars($deadline ?? '') ?>" 
      required
    >

    <button type="submit">Post Job</button>
  </form>
</div>

<?php include "includes/footer.php"; ?>
