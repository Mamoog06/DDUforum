<?php
session_start();
include 'connection.php';

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$general_categories = $conn->query("SELECT * FROM categories WHERE cat_id BETWEEN 1 AND 7");
if (!$general_categories) {
    echo "General categories query failed: " . $conn->error;
}

$player_categories = $conn->query("SELECT * FROM categories WHERE cat_id BETWEEN 8 AND 22");
if (!$player_categories) {
    echo "Player categories query failed: " . $conn->error;
}

$newest_posts_query = "
    SELECT 
        posts.*, 
        users.user_name, 
        categories.cat_name, 
        (SELECT COUNT(*) FROM comments WHERE com_post = posts.post_id) AS reply_count
    FROM 
        posts
    JOIN 
        users ON posts.post_by = users.user_id
    JOIN 
        categories ON posts.post_cat = categories.cat_id
    ORDER BY 
        post_date DESC
    LIMIT 10"; // You can adjust the number of posts to display

$newest_posts_result = $conn->query($newest_posts_query);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Divination & Dragons</title>
    <link rel="stylesheet" href="header.css">
    <link rel="stylesheet" href="home.css">
</head>

<body>
    <?php include 'header.php'; ?>

    <main>
        <div class="search-container">
            <input type="text" placeholder="Search...">
        </div>

        <section class="categories">
            <!-- General Side Category -->
            <div class="side-categories">
                <div class="category side-category">General</div>
            </div>
            <div class="scrollable-container">
                <div class="main-categories">
                    <?php if ($general_categories->num_rows > 0): ?>
                        <?php while ($category = $general_categories->fetch_assoc()): ?>
                            <div class="category">
                                <a href="category.php?cat_id=<?php echo $category['cat_id']; ?>" style="color: inherit; text-decoaration: none; user-select: none;">
                                    <?php echo htmlspecialchars($category['cat_name']); ?>
                                </a>
                            </div>
                        <?php endwhile; ?>
                    <?php else: ?>
                        <p>No categories found.</p>
                    <?php endif; ?>
                </div>
            </div>

            <!-- Player Side Category -->
            <div class="side-categories">
                <div class="category side-category">Character</div>
            </div>
            <div class="scrollable-container">
                <div class="main-categories">
                    <?php if ($player_categories->num_rows > 0): ?>
                        <?php while ($category = $player_categories->fetch_assoc()): ?>
                            <div class="category">
                                <a href="category.php?cat_id=<?php echo $category['cat_id']; ?>">
                                    <?php echo htmlspecialchars($category['cat_name']); ?>
                                </a>
                            </div>
                        <?php endwhile; ?>
                    <?php else: ?>
                        <p>No categories found.</p>
                    <?php endif; ?>
                </div>
            </div>
        </section>

        <section class="newest-posts">
            <h2>Newest Posts</h2>
            <div class="topic-list">
                <?php if ($newest_posts_result && $newest_posts_result->num_rows > 0): ?>
                    <?php while ($post = $newest_posts_result->fetch_assoc()): ?>
                        <div class="topic-box">
                            <div class="topic-meta">
                                <h3 class="topic-title">
                                    <a href="post.php?post_id=<?php echo $post['post_id']; ?>">
                                        <?php echo htmlspecialchars($post['post_caption']); ?>
                                    </a>
                                </h3>
                                <span>
                                    Posted by <?php echo htmlspecialchars($post['user_name']); ?>
                                    in <?php echo htmlspecialchars($post['cat_name']); ?>
                                    on <?php echo $post['post_date']; ?>
                                </span>
                            </div>
                            <div class="replies-views">
                                <span>Replies: <?php echo $post['reply_count']; ?></span>
                            </div>
                        </div>
                    <?php endwhile; ?>
                <?php else: ?>
                    <p>No recent posts found.</p>
                <?php endif; ?>
            </div>
        </section>
    </main>

    <script src="script.js"></script>
    <?php include 'footer.php'; ?>

</body>

</html>

<?php
// Close the database connection
$conn->close();
?>