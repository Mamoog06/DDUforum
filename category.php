<?php
session_start();
include 'connection.php';

$cat_id = isset($_GET['cat_id']) ? intval($_GET['cat_id']) : 0;

if ($cat_id > 0) {
    $cat_query = "SELECT * FROM categories WHERE cat_id = $cat_id";
    $cat_result = $conn->query($cat_query);

    if ($cat_result && $cat_result->num_rows > 0) {
        $category = $cat_result->fetch_assoc();
        $cat_name = $category['cat_name'];
        $cat_description = $category['cat_description'];

        $posts_query = "SELECT posts.*, users.user_name FROM posts JOIN users ON posts.post_by = users.user_id WHERE post_cat = $cat_id";
        $posts_result = $conn->query($posts_query);
    } else {
        echo "Category not found.";
        exit;
    }
} else {
    echo "Invalid category.";
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($cat_name); ?></title>
    <link rel="stylesheet" href="header.css">
    <link rel="stylesheet" href="footer.css">
    <link rel="stylesheet" href="categoryTemplate.css">
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
        <div class="category-page">
            <div class="category-header">
                <h1><?php echo htmlspecialchars($cat_name); ?></h1>
                <a href="createPost.php?cat_id=<?php echo $cat_id; ?>" class="new-post-btn">New Post</a>
            </div>

            <p class="category-description"><?php echo htmlspecialchars($cat_description); ?></p>

            <hr class="category-line">

            <div class="topic-list">
                <?php if ($posts_result && $posts_result->num_rows > 0): ?>
                    <?php while ($post = $posts_result->fetch_assoc()): ?>
                        <div class="topic-box">
                            <div class="topic-meta">
                                <h2 class="topic-title">
                                    <a href="post.php?post_id=<?php echo $post['post_id']; ?>">
                                        <?php echo htmlspecialchars($post['post_caption']); ?>
                                    </a>
                                </h2>
                                <!-- Display the username here -->
                                <span>Posted by <?php echo htmlspecialchars($post['user_name']); ?> on <?php echo $post['post_date']; ?></span>
                            </div>
                            <div class="replies-views">
                                <!-- You can add post stats like replies and views here -->
                                <span>Replies: 0</span>
                                <span>Views: 0</span>
                            </div>
                        </div>
                    <?php endwhile; ?>
                <?php else: ?>
                    <p>No posts found in this category.</p>
                <?php endif; ?>
            </div>

        </div>

    </main>

    <?php
    include('footer.php');
    ?>

</body>

</html>

<?php
$conn->close();
?>