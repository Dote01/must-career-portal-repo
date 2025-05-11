<?php
$host = 'db';
$user = 'root';
$pass = 'root';
$dbname = 'must_career';

$conn = new mysqli($host, $user, $pass, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
