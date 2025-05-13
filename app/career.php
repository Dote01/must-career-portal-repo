<?php
require_once "includes/auth.php"; // Starts session and checks login
require_once "includes/database.php";
include("includes/header.php");
?>

<h2>Career Guidance</h2>

<?php
$result = $conn->query("SELECT * FROM jobs");
while ($row = $result->fetch_assoc()) {
    $course = !empty($row['course']) ? htmlspecialchars($row['course']) : 'Unknown Course';
    $careers = !empty($row['suggested_careers']) ? nl2br(htmlspecialchars($row['suggested_careers'])) : 'No suggestions available.';
    echo "<div style='margin-bottom: 20px; padding: 15px; border: 1px solid #ccc; border-radius: 5px;'>";
    echo "<h3 style='color: #2c3e50;'>$course</h3>";
    echo "<p style='color: #34495e;'>$careers</p>";
    echo "</div>";
}
$conn->close();
include("includes/footer.php");
?>
