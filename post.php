<?php
session_start();
include 'connection.php';

$post_id = isset($_GET['post_id']) ? intval($_GET['post_id']) : 0;

if ($post_id > 0) {
    $post_query = "SELECT posts.*, users.user_name FROM posts JOIN users ON posts.post_by = users.user_id WHERE post_id = $post_id";
    $post_result = $conn->query($post_query);

    if ($post_result->num_rows > 0) {
        $post = $post_result->fetch_assoc();
        $post_caption = $post['post_caption'];
        $post_content = $post['post_content'];
        $post_by = $post['post_by'];
        $post_date = $post['post_date'];

<<<<<<< Updated upstream
        $comments_query = "SELECT comments.*, users.user_name FROM comments JOIN users ON comments.com_by = users.user_id WHERE com_post = $post_id ORDER BY com_date ASC";
        $comments_result = $conn->query($comments_query);

=======
        $comments_query = "SELECT * FROM comments WHERE com_post = $post_id ORDER BY com_date ASC";
>>>>>>> Stashed changes
        $comments_result = $conn->query($comments_query);
    } else {
        echo "Post not found.";
        exit;
    }
} else {
    echo "Invalid post.";
    exit;
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
    <header>
        <div class="logo">
            <a href="index.php" style="text-decoration: none; color: inherit">Logo</a>
        </div>
        <div class="search-container">
            <input type="text" placeholder="Search...">
        </div>
        <div class="actions">
            <div class="rules">
                <a href="rules.php" style="text-decoration: none; color: inherit">Rules</a>
            </div>
            <div class="profile">
                <a href="profile.php" style="text-decoration: none; color: inherit">Profile</a>
            </div>
        </div>
    </header>

    <main>
        <div class="thread-page">
            <!-- Main Thread Content -->
            <div class="thread-title"><?php echo htmlspecialchars($post_caption); ?></div>
            <div class="thread-meta">
                Posted by <?php echo htmlspecialchars($post['user_name']); ?> on <?php echo htmlspecialchars($post_date); ?>
            </div>

            <div class="thread-content"><?php echo htmlspecialchars($post_content); ?></div>

            <!-- Reply Button for Main Post -->
            <button class="reply-btn" data-reply-target="reply-form-0">Reply</button>

            <!-- Reply Form for Main Post (hidden initially) -->
            <div class="reply-form" id="reply-form-0" style="display: none;">
                <form method="post" action="submit_reply.php">
                    <textarea name="reply_content" placeholder="Write your reply here..." rows="4" required></textarea>
                    <input type="hidden" name="post_id" value="<?php echo $post_id; ?>">
                    <input type="hidden" name="com_by" value="<?php echo htmlspecialchars($post_by); ?>">
                    <button type="submit">Post Reply</button>
                </form>
            </div>

            <div class="comments-list">
                <?php if ($comments_result->num_rows > 0): ?>
                    <?php while ($comment = $comments_result->fetch_assoc()): ?>
                        <div class="reply-box">
<<<<<<< Updated upstream
                            <!-- Display the username from the users table -->
                            <?php echo htmlspecialchars($comment['user_name']); ?>
=======
                            <?php echo "Comment by: " . htmlspecialchars($comment['user_name']); ?>
>>>>>>> Stashed changes
                            <div class="reply-meta">
                                <!-- Display the comment date -->
                                <?php echo htmlspecialchars($comment['com_date']); ?>
                            </div>
                            <div class="reply-content">
                                <!-- Display the comment content -->
                                <?php echo htmlspecialchars($comment['com_content']); ?>
                            </div>
                        </div>
                    <?php endwhile; ?>
                <?php else: ?>
                    <p>No comments yet. Be the first to comment!</p>
                <?php endif; ?>
            </div>


        </div>
    </main>

    <?php
    include('footer.php')
    ?>

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