<?php
include 'connection.php';


$category_id = isset($_GET['cat_id']) ? intval($_GET['cat_id']) : 0;

echo "Category ID: $category_id";

if ($category_id > 0) {
    $category_query = "SELECT * FROM categories WHERE cat_id = $category_id";
    $category_result = $conn->query($category_query);

    if ($category_result && $category_result->num_rows > 0) {
        $category = $category_result->fetch_assoc();
        $category_name = $category['cat_name'];
        $category_description = $category['cat_description'];

        $posts_query = "SELECT * FROM posts WHERE post_cat = $category_id";
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
            <h1><?php echo htmlspecialchars($cat_name); ?></h1>
            <p><?php echo htmlspecialchars($cat_description); ?></p>

            <div class="posts-list">
                <?php if ($posts_result && $posts_result->num_rows > 0): ?>
                    <?php while ($post = $posts_result->fetch_assoc()): ?>
                        <div class="post-item">
                            <h2>
                                <a href="threadtemplate.php?post_id=<?php echo $post['post_id']; ?>">
                                    <?php echo htmlspecialchars($post['post_caption']); ?>
                                </a>
                            </h2>
                            <p><?php echo htmlspecialchars($post['post_content']); ?></p>
                            <span>Posted by <?php echo htmlspecialchars($post['post_by']); ?> on <?php echo $post['post_date']; ?></span>
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

<?php
$conn->close();
?>