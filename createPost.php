<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>New Post</title>
    <link rel="stylesheet" href="header.css">
    <link rel="stylesheet" href="footer.css">
    <link rel="stylesheet" href="createPost.css">
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
        <div class="post-container">
            <form method="post" action="submit_post.php">
                <!-- Title Field -->
                <div class="input-group">
                    <label for="title">Title of Post:</label>
                    <input type="text" id="title" name="title" placeholder="Enter the title..." required>
                </div>

                <!-- Content Field -->
                <div class="input-group">
                    <label for="content">Content:</label>
                    <textarea id="content" name="content" placeholder="Write your content here..." rows="10" required></textarea>
                </div>

                <!-- Tags Field -->
                <div class="input-group">
                    <label for="tags">Tags:</label>
                    <input type="text" id="tags" name="tags" placeholder="Add tags..." required>
                </div>

                <!-- Post Button -->
                <div class="input-group">
                    <button type="submit">Post</button>
                </div>
            </form>
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
