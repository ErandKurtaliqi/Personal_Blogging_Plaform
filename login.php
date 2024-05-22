<?php
session_start();
$conn = new mysqli('localhost', 'root', '', 'blog_platform');

if ($conn->connect_error) {
    die('Connection failed: ' . $conn->connect_error);
}

$username = $_POST['username'];
$password = $_POST['password'];

$sql = "SELECT * FROM users WHERE username='$username'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    if (password_verify($password, $row['password'])) {
        $_SESSION['user_id'] = $row['user_id'];
        header('Location: dashboard.php');
    } else {
        echo "Invalid password";
    }
} else {
    echo "No user found with that username";
}

$conn->close();
?>
