<?php
session_start();
include 'connection.php';


$general_categories = $conn->query("SELECT * FROM categories WHERE cat_id BETWEEN 1 AND 7");
$homebrew_categories = $conn->query("SELECT * FROM categories WHERE cat_id BETWEEN 8 AND 22");

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forum Homepage</title>
    <link rel="stylesheet" href="header.css">
    <link rel="stylesheet" href="footer.css">
    <link rel="stylesheet" href="home.css">
</head>

<body>
    <header>
        <div class="logo">
            <a href="index.php" style="text-decoration: none; color: inherit">Logo</a>
        </div>
        <div class="profile">
            <a href="profile.php" style="text-decoration: none; color: inherit">Profile</a>
        </div>
    </header>

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
                                <a href="category.php?category_id=<?php echo $category['cat_id']; ?>">
                                    <?php echo htmlspecialchars($category['cat_name']); ?>
                                </a>
                            </div>
                        <?php endwhile; ?>
                    <?php else: ?>
                        <p>No categories found.</p>
                    <?php endif; ?>
                </div>
            </div>

            <!-- Homebrew Side Category -->
            <div class="side-categories">
                <div class="category side-category">Homebrew</div>
            </div>
            <div class="scrollable-container">
                <div class="main-categories">
                    <?php if ($homebrew_categories->num_rows > 0): ?>
                        <?php while ($category = $homebrew_categories->fetch_assoc()): ?>
                            <div class="category">
                                <a href="category.php?category_id=<?php echo $category['cat_id']; ?>">
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

    <script src="script.js"></script>
</body>

</html>

<?php
$conn->close();
?>
