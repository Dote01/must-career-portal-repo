<?php
$host = "mysql";
$username = "root";
$password = "";
$dbname = "must_career";


$conn = new mysqli($host, $usernmame, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
