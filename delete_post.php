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

$post_id = $_GET['post_id'];

$sql = "DELETE FROM posts WHERE post_id='$post_id'";

if ($conn->query($sql) === TRUE) {
    echo "Post deleted successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
header('Location: dashboard.php');
exit();
?>
