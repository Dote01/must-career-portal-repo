<?php
$host = 'sql12.freesqldatabase.com';
$user = 'sql8778351';
$pass = 'nqsh76cQev';
$dbname = 'sql8778351';
$port = 3306;

$conn = new mysqli($host, $user, $pass, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
