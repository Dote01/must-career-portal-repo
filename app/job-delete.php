<?php
require_once "includes/auth.php";
require_once "includes/database.php";

if ($_SESSION['role'] !== 'company') {
    header("Location: dashboard.php");
    exit();
}

$job_id = $_GET['id'] ?? null;

$stmt = $conn->prepare("DELETE FROM jobs WHERE id = ? AND company_id = ?");
$stmt->bind_param("ii", $job_id, $_SESSION["user_id"]);
if ($stmt->execute()) {
    header("Location: company-dashboard.php");
    exit();
} else {
    echo "Error deleting job.";
}
?>
