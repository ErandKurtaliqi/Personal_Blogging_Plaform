<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header('Location: login.html');
    exit();
}

$conn = new mysqli('localhost', 'root', '', 'blog_platform');

if ($conn->connect_error) {
    die('Connection failed: ' . $conn->connect_error);
}

$title = $_POST['title'];
$content = $_POST['content'];
$author_id = $_SESSION['user_id'];

$sql = "INSERT INTO posts (title, content, author_id) VALUES ('$title', '$content', '$author_id')";

if ($conn->query($sql) === TRUE) {
    echo "Post created successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>
