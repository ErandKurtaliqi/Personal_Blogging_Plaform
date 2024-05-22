<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <h2>Dashboard</h2>
    <nav>
        <a href="post.html">Create New Post</a>
        <a href="logout.php">Logout</a>
    </nav>
    <h3>Your Blog Posts</h3>
    <div id="posts">
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

        $user_id = $_SESSION['user_id'];
        $sql = "SELECT * FROM posts WHERE author_id='$user_id'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                echo "<div>";
                echo "<h4>" . $row['title'] . "</h4>";
                echo "<p>" . $row['content'] . "</p>";
                echo "<a href='edit_post.php?post_id=" . $row['post_id'] . "'>Edit</a> | ";
                echo "<a href='delete_post.php?post_id=" . $row['post_id'] . "'>Delete</a>";
                echo "</div>";
            }
        } else {
            echo "No posts yet.";
        }

        $conn->close();
        ?>
    </div>
</body>
</html>
