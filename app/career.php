<?php
require_once "includes/auth.php"; // Starts session and checks login
include("includes/database.php");
include("includes/header.php");
?>

<?php
echo "<h2>Career Guidance</h2>";

$result = $conn->query("SELECT * FROM jobs");
while ($row = $result->fetch_assoc()) {
    echo "<h3>" . htmlspecialchars($row['course']) . "</h3>";
    echo "<p>" . nl2br(htmlspecialchars($row['suggested_careers'])) . "</p>";
}
$conn->close();

include("includes/footer.php");
?>
