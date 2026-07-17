<?php
include 'db_connect.php';
$id = $_GET['id'];
$sql = "DELETE FROM books WHERE id = $id";
$conn->query($sql);
header("Location: view_books.php");
?>
