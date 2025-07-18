<?php
$host = "db";
$user = "root";
$password = "root";
$dbname = "must_career";


$conn = new mysqli($host, $user, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
