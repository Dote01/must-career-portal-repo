<?php
require_once "includes/auth.php";
include "includes/header.php";
?>
<h2>Welcome, <?= htmlspecialchars($_SESSION['username']) ?></h2>
<p>You are logged in as <strong><?= $_SESSION['role'] ?></strong></p>
<p><a href="logout.php">Logout</a></p>
<?php include "includes/footer.php"; ?>