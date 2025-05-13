<?php
session_start();
require_once "includes/database.php";

$error = '';
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = trim($_POST["username"]);
    $email = trim($_POST["email"]);
    $password = $_POST["password"];
    $role = $_POST["role"];

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = "Invalid email address.";
    } elseif (strlen($password) < 6) {
        $error = "Password must be at least 6 characters.";
    } else {
        $hashed = password_hash($password, PASSWORD_DEFAULT);
        $stmt = $conn->prepare("INSERT INTO users (username, email, password, role) VALUES (?, ?, ?, ?)");
        if ($stmt) {
            $stmt->bind_param("ssss", $username, $email, $hashed, $role);
            if ($stmt->execute()) {
                header("Location: login.php");
                exit();
            } else {
                $error = "Database execution failed: " . $stmt->error;
            }
            $stmt->close();
        } else {
            $error = "Database prepare failed: " . $conn->error;
        }
    }
}
?>

<?php include "includes/header.php"; ?>
<h2>Register</h2>
<form method="POST">
    Username: <input type="text" name="username" required><br>
    Email: <input type="email" name="email" required><br>
    Password: <input type="password" name="password" required><br>
    Role:
    <select name="role" required>
        <option value="student">Student</option>
        <option value="company">Company</option>
    </select><br>
    <button type="submit">Register</button>
</form>
<p style="color:red;"><?= htmlspecialchars($error) ?></p>
<?php include "includes/footer.php"; ?>