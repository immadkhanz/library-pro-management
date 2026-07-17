<?php
include 'db_connect.php';
$id = $_POST['id'];
$title = $_POST['title'];
$author = $_POST['author'];
$price = $_POST['price'];
$sql = "UPDATE books
SET title='$title', author='$author', price=$price
WHERE id=$id";
$conn->query($sql);
header("Location: view_books.php");
?>
