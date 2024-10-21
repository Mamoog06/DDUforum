<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forum Homepage</title>
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
                <h1>Category 1</h1>
                <a href="new_post.php?category_id=1" class="new-post-btn">New Post</a>
            </div>
            <hr class="category-line">
            <p class="category-description">This is a brief description of Category 1.</p>

            <div class="topic-list">
                <div class="topic-box">
                    <div class="topic-meta">
                        <div class="topic-title">
                            <a href="topic.php?id=1">How do I...</a>
                        </div>
                        <span>by JohnDoe</span>
                        <span class="post-date">Posted on: 2023-10-15</span>
                    </div>
                    <div class="replies-views">
                        <span>5 Replies</span>
                        <span>27 Views</span>
                    </div>
                </div>

                <div class="topic-box">
                    <div class="topic-meta">
                        <div class="topic-title">
                            <a href="topic.php?id=2">What works best? Faife or Auhfna?</a>
                        </div>
                        <span>by JaneSmith</span>
                        <span class="post-date">Posted on: 2023-10-15</span>
                    </div>
                    <div class="replies-views">
                        <span>7 Replies</span>
                        <span>30 Views</span>
                    </div>
                </div>

                <div class="topic-box">
                    <div class="topic-meta">
                        <div class="topic-title">
                            <a href="topic.php?id=3">Should I allow my players to...?</a>
                        </div>
                        <span>by DungeonMasterX</span>
                        <span class="post-date">Posted on: 2023-10-15</span>
                    </div>
                    <div class="replies-views">
                        <span>25 Replies</span>
                        <span>122 Views</span>
                    </div>
                </div>

                <div class="topic-box">
                    <div class="topic-meta">
                        <div class="topic-title">
                            <a href="topic.php?id=3">Should I allow my players to...?</a>
                        </div>
                        <span>by DungeonMasterX</span>
                        <span class="post-date">Posted on: 2023-10-15</span>
                    </div>
                    <div class="replies-views">
                        <span>25 Replies</span>
                        <span>122 Views</span>
                    </div>
                </div>

                <div class="topic-box">
                    <div class="topic-meta">
                        <div class="topic-title">
                            <a href="topic.php?id=3">Should I allow my players to...?</a>
                        </div>
                        <span>by DungeonMasterX</span>
                        <span class="post-date">Posted on: 2023-10-15</span>
                    </div>
                    <div class="replies-views">
                        <span>25 Replies</span>
                        <span>122 Views</span>
                    </div>
                </div>

                <div class="topic-box">
                    <div class="topic-meta">
                        <div class="topic-title">
                            <a href="topic.php?id=3">Should I allow my players to...?</a>
                        </div>
                        <span>by DungeonMasterX</span>
                        <span class="post-date">Posted on: 2023-10-15</span>
                    </div>
                    <div class="replies-views">
                        <span>25 Replies</span>
                        <span>122 Views</span>
                    </div>
                </div>
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