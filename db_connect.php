<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "immad_15024"; // Replace with your DB name
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
die("Connection failed: " . $conn->connect_error);
}
?>
