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

$content = $_POST['content'];
$post_id = $_POST['post_id'];
$author_id = $_SESSION['user_id'];

$sql = "INSERT INTO comments (content, post_id, author_id) VALUES ('$content', '$post_id', '$author_id')";

if ($conn->query($sql) === TRUE) {
    echo "Comment added successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>
