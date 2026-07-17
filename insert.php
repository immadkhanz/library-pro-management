<?php
include 'db_connect.php';
$title = $_POST['title'];
$author = $_POST['author'];
$price = $_POST['price'];
$sql = "INSERT INTO books (title, author, price)
VALUES ('$title', '$author', '$price')";
$conn->query($sql);
header("Location: view_books.php");
?>
