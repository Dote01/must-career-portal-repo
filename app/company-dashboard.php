<?php
require_once "includes/auth.php"; 
require_once "includes/database.php"; 

if ($_SESSION['role'] !== 'company') {
    header("Location: dashboard.php");
    exit();
}

$stmt = $conn->prepare("SELECT * FROM jobs WHERE company_id = ? ORDER BY deadline DESC");
$stmt->bind_param("i", $_SESSION["user_id"]);
$stmt->execute();
$result = $stmt->get_result();
?>

<?php include "includes/header.php"; ?>
<h2>Your Posted Jobs</h2>

<?php while ($job = $result->fetch_assoc()): ?>
    <div>
        <h3><?= htmlspecialchars($job['title']) ?> at <?= htmlspecialchars($job['company']) ?></h3>
        <p><?= nl2br(htmlspecialchars($job['description'])) ?></p>
        <strong>Deadline:</strong> <?= htmlspecialchars($job['deadline']) ?><br>
        <a href="job-edit.php?id=<?= $job['id'] ?>">Edit</a> | 
        <a href="job-delete.php?id=<?= $job['id'] ?>">Delete</a>
    </div>
    <hr>
<?php endwhile; ?>

<?php include "includes/footer.php"; ?>
