<?php
require_once "includes/auth.php"; // Starts session and checks login
include("includes/database.php");
include("includes/header.php");
?>

<?php
echo "<h2>Career Guidance</h2>";

$result = $conn->query("SELECT * FROM jobs");
while ($row = $result->fetch_assoc()) {
$course = isset($_POST['course']) ? htmlspecialchars($_POST['course']) : ''; 
$suggested_careers = isset($_POST['suggested_careers']) ? htmlspecialchars($_POST['suggested_careers']) : ''; 
}
$conn->close();

include("includes/footer.php");
?>