<?php
// Include database connection (if required)
include('db_connection.php');

// Get the category_id from the URL
$category_id = isset($_GET['category_id']) ? intval($_GET['category_id']) : 0;

if ($category_id > 0) {
    // Fetch category information (name, description) from the database
    $category_query = "SELECT * FROM categories WHERE id = $category_id";
    $category_result = $conn->query($category_query);

    if ($category_result->num_rows > 0) {
        $category = $category_result->fetch_assoc();
        $category_name = $category['name'];
        $category_description = $category['description'];

        // Fetch posts/topics associated with the category
        $posts_query = "SELECT * FROM posts WHERE category_id = $category_id";
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
    <title><?php echo htmlspecialchars($category_name); ?></title>
    <link rel="stylesheet" href="header.css">
    <link rel="stylesheet" href="footer.css">
    <link rel="stylesheet" href="categoryTemplate.css">
</head>

<body>
    <header>
        <div class="logo">
            <a href="home.php" style="text-decoration: none; color: inherit">Logo</a>
        </div>
        <div class="search-container">
            <input type="text" placeholder="Search...">
        </div>
        <div class="profile">
            <a href="profile.php" style="text-decoration: none; color: inherit">Profile</a>
        </div>
    </header>

    <main>
        <div class="category-page">
            <div class="category-header">
                <h1><?php echo htmlspecialchars($category_name); ?></h1>
                <a href="new_post.php?category_id=<?php echo $category_id; ?>" class="new-post-btn">New Post</a>
            </div>
            <hr class="category-line">
            <p class="category-description"><?php echo htmlspecialchars($category_description); ?></p>

            <div class="topic-list">
                <?php if ($posts_result->num_rows > 0): ?>
                    <?php while ($post = $posts_result->fetch_assoc()): ?>
                        <div class="topic-box">
                            <div class="topic-meta">
                                <div class="topic-title">
                                    <a href="topic.php?id=<?php echo $post['id']; ?>">
                                        <?php echo htmlspecialchars($post['title']); ?>
                                    </a>
                                </div>
                                <span>by <?php echo htmlspecialchars($post['author']); ?></span>
                                <span class="post-date">Posted on: <?php echo $post['created_at']; ?></span>
                            </div>
                            <div class="replies-views">
                                <span><?php echo $post['replies_count']; ?> Replies</span>
                                <span><?php echo $post['views_count']; ?> Views</span>
                            </div>
                        </div>
                    <?php endwhile; ?>
                <?php else: ?>
                    <p>No posts found in this category.</p>
                <?php endif; ?>
            </div>
        </div>
    </main>

    <footer>
        <div class="footer-info">
            <p>Firmanavn: Marquuefy</p>
            <p>Nummer: 19874198</p>
            <p>Email: Marqueefy@dnd.dk</p>
        </div>
        <div class="footer-social">
            <p>Sociale Medier:</p>
            <ul>
                <li>Instagram</li>
                <li>Twitter</li>
                <li>TikTok</li>
                <li>Facebook</li>
            </ul>
        </div>
        <div class="footer-about">
            <p>Om os:</p>
            <p>Information about the company.</p>
        </div>
    </footer>
</body>

</html>