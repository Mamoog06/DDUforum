<?php
session_start();
include 'connection.php';

if (!isset($_SESSION['user_id'])) {
    die("You must be logged in to comment.");
}

if (isset($_POST['delete_comment']) && isset($_POST['comment_id'])) {
    $comment_id = intval($_POST['comment_id']);
    $user_id = intval($_SESSION['user_id']);

    $delete_comment_query = $conn->prepare("DELETE FROM comments WHERE com_id = ? AND com_by = ?");
    $delete_comment_query->bind_param("ii", $comment_id, $user_id);
    $delete_comment_query->execute();

    header("Location: post.php?post_id=" . intval($_POST['post_id']));
    exit();
}

if (isset($_POST['delete_post']) && isset($_POST['post_id'])) {
    $post_id = intval($_POST['post_id']);
    $user_id = intval($_SESSION['user_id']);

    $delete_post_query = $conn->prepare("DELETE FROM posts WHERE post_id = ? AND post_by = ?");
    $delete_post_query->bind_param("ii", $post_id, $user_id);
    $delete_post_query->execute();

    header("Location: index.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['reply_content'])) {
    $reply_content = $_POST['reply_content'];
    $post_id = intval($_POST['post_id']);
    $com_by = intval($_POST['com_by']);

    $reply_content = $conn->real_escape_string($reply_content);

    $insert_comment_query = "INSERT INTO comments (com_content, com_date, com_post, com_by) VALUES (?, NOW(), ?, ?)";
    $stmt = $conn->prepare($insert_comment_query);
    $stmt->bind_param("sii", $reply_content, $post_id, $com_by);

    if ($stmt->execute()) {
        header("Location: post.php?post_id=" . $post_id);
        exit();
    } else {
        echo "Error: " . $conn->error;
    }
}

$post_id = isset($_GET['post_id']) ? intval($_GET['post_id']) : 0;

if ($post_id > 0) {

    $post_query = $conn->prepare("SELECT posts.*, users.user_name FROM posts JOIN users ON posts.post_by = users.user_id WHERE post_id = ?");
    $post_query->bind_param("i", $post_id);
    $post_query->execute();
    $post_result = $post_query->get_result();

    if ($post_result->num_rows > 0) {
        $post = $post_result->fetch_assoc();
        $post_caption = $post['post_caption'];
        $post_content = $post['post_content'];
        $post_by = $post['post_by'];
        $post_date = $post['post_date'];

        $comments_query = $conn->prepare("SELECT comments.*, users.user_name FROM comments JOIN users ON comments.com_by = users.user_id WHERE com_post = ? ORDER BY com_date ASC");
        $comments_query->bind_param("i", $post_id);
        $comments_query->execute();
        $comments_result = $comments_query->get_result();
    } else {
        echo "Post not found.";
        exit();
    }
} else {
    echo "Invalid post.";
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($post_caption); ?></title>
    <link rel="stylesheet" href="header.css">
    <link rel="stylesheet" href="post.css">
</head>

<body>
    <?php include 'header.php'; ?>

    <main>
        <div class="thread-page">
            <div class="thread-title"><?php echo htmlspecialchars($post_caption); ?></div>
            <div class="thread-meta">
                Posted by <?php echo htmlspecialchars($post['user_name']); ?> on <?php echo htmlspecialchars($post_date); ?>
            </div>
            <div class="thread-content"><?php echo htmlspecialchars($post_content); ?></div>

            <?php if ($post_by == $_SESSION['user_id']): ?>
                <form method="POST" style="text-align: right;">
                    <input type="hidden" name="post_id" value="<?php echo $post_id; ?>">
                    <button type="submit" name="delete_post" class="delete-btn">Delete Post</button>
                </form>
            <?php endif; ?>

            <button class="reply-btn" data-reply-target="reply-form-0">Reply</button>
            <div class="reply-form" id="reply-form-0" style="display: none;">
                <form method="POST">
                    <textarea name="reply_content" placeholder="Write your reply here..." rows="4" required></textarea>
                    <input type="hidden" name="post_id" value="<?php echo $post_id; ?>">
                    <input type="hidden" name="com_by" value="<?php echo htmlspecialchars($_SESSION['user_id']); ?>">
                    <button type="submit">Post Reply</button>
                </form>
            </div>

            <div class="comments-list">
                <?php if ($comments_result->num_rows > 0): ?>
                    <?php while ($comment = $comments_result->fetch_assoc()): ?>
                        <div class="reply-box">
                            <div class="comment-author"><?php echo "Comment by: " . htmlspecialchars($comment['user_name']); ?></div>
                            <div class="reply-meta"><?php echo htmlspecialchars($comment['com_date']); ?></div>
                            <div class="reply-content"><?php echo htmlspecialchars($comment['com_content']); ?></div>

                            <?php if ($comment['com_by'] == $_SESSION['user_id']): ?>
                                <form method="POST" style="text-align: right;">
                                    <input type="hidden" name="post_id" value="<?php echo $post_id; ?>">
                                    <input type="hidden" name="comment_id" value="<?php echo $comment['com_id']; ?>">
                                    <button type="submit" name="delete_comment" class="delete-btn">Delete Comment</button>
                                </form>
                            <?php endif; ?>
                        </div>
                    <?php endwhile; ?>
                <?php else: ?>
                    <p>No comments yet. Be the first to comment!</p>
                <?php endif; ?>
            </div>
        </div>
    </main>

    <?php include('footer.php'); ?>

    <script>
        document.querySelectorAll('.reply-btn').forEach(function(button) {
            button.addEventListener('click', function() {
                const targetId = this.getAttribute('data-reply-target');
                const replyForm = document.getElementById(targetId);
                replyForm.style.display = replyForm.style.display === 'none' ? 'block' : 'none';
            });
        });
    </script>
</body>

</html>