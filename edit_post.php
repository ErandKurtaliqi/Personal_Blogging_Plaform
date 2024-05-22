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

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    $post_id = $_GET['post_id'];
    $sql = "SELECT * FROM posts WHERE post_id='$post_id'";
    $result = $conn->query($sql);
    $post = $result->fetch_assoc();
} else {
    $post_id = $_POST['post_id'];
    $title = $_POST['title'];
    $content = $_POST['content'];

    $sql = "UPDATE posts SET title='$title', content='$content' WHERE post_id='$post_id'";

    if ($conn->query($sql) === TRUE) {
        echo "Post updated successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    header('Location: dashboard.php');
    exit();
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Post</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <h2>Edit Post</h2>
    <form action="edit_post.php" method="post">
        <input type="hidden" name="post_id" value="<?php echo $post_id; ?>">
        <label for="title">Title:</label>
        <input type="text" id="title" name="title" value="<?php echo $post['title']; ?>" required><br><br>
        <label for="content">Content:</label>
        <textarea id="content" name="content" required><?php echo $post['content']; ?></textarea><br><br>
        <input type="submit" value="Update Post">
    </form>
</body>
</html>
