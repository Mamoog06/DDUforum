<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thread Page</title>
    <link rel="stylesheet" href="header.css">
    <link rel="stylesheet" href="footer.css">
    <link rel="stylesheet" href="threadTemplate.css">
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
        <div class="thread-page">

            <!-- Main Thread Content -->
            <div class="thread-title">How to implement thread replies?</div>
            <div class="thread-meta">Posted by JohnDoe on 2023-10-15</div>
            <div class="thread-content">
                This is the content of the main post. Here, the user asks how to implement replies in a discussion thread.
            </div>

            <!-- First Reply -->
            <div class="reply-box">
                <div class="reply-meta">Posted by JaneSmith on 2023-10-16</div>
                <div class="reply-content">
                    This is a reply to the main post. You can display your replies like this.
                </div>
                <span class="show-hide-replies" data-target="nested-reply-1">Hide replies</span>

                <!-- Nested Reply -->
                <div class="nested-reply" id="nested-reply-1">
                    <div class="reply-meta">Posted by JohnDoe on 2023-10-16</div>
                    <div class="reply-content">
                        This is a nested reply to JaneSmith's comment.
                    </div>
                </div>
            </div>

            <!-- Second Reply -->
            <div class="reply-box">
                <div class="reply-meta">Posted by DungeonMasterX on 2023-10-17</div>
                <div class="reply-content">
                    This is another reply to the main post, discussing how to organize threaded discussions.
                </div>
            </div>

            <div class="reply-box">
                <div class="reply-meta">Posted by DungeonMasterX on 2023-10-17</div>
                <div class="reply-content">
                    This is another reply to the main post, discussing how to organize threaded discussions.
                </div>
            </div>

            <div class="reply-box">
                <div class="reply-meta">Posted by DungeonMasterX on 2023-10-17</div>
                <div class="reply-content">
                    This is another reply to the main post, discussing how to organize threaded discussions.
                </div>
            </div>

            <div class="reply-box">
                <div class="reply-meta">Posted by DungeonMasterX on 2023-10-17</div>
                <div class="reply-content">
                    This is another reply to the main post, discussing how to organize threaded discussions.
                </div>
            </div>

            <div class="reply-box">
                <div class="reply-meta">Posted by DungeonMasterX on 2023-10-17</div>
                <div class="reply-content">
                    This is another reply to the main post, discussing how to organize threaded discussions.
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

    <script>
        document.querySelectorAll('.show-hide-replies').forEach(function(toggle) {
            toggle.addEventListener('click', function() {
                const targetId = this.getAttribute('data-target');
                const nestedReply = document.getElementById(targetId);
                if (nestedReply.style.display === "none") {
                    nestedReply.style.display = "block";
                    this.textContent = "Hide replies";
                } else {
                    nestedReply.style.display = "none";
                    this.textContent = "Show replies";
                }
            });
        });
        document.querySelectorAll('.nested-reply').forEach(function(reply) {
            reply.style.display = 'none';
        });
    </script>
</body>

</html>