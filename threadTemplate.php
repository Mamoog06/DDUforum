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

            <!-- Reply Button for Main Post -->
            <button class="reply-btn" data-reply-target="reply-form-0">Reply</button>

            <!-- Reply Form for Main Post (hidden initially) -->
            <div class="reply-form" id="reply-form-0" style="display: none;">
                <form method="post" action="submit_reply.php">
                    <textarea name="reply_content" placeholder="Write your reply here..." rows="4" required></textarea>
                    <input type="hidden" name="thread_id" value="1">
                    <input type="hidden" name="parent_reply_id" value="0"> <!-- 0 means it's a direct reply to the thread -->
                    <button type="submit">Post Reply</button>
                </form>
            </div>

            <!-- First Reply -->
            <div class="reply-box">
                <div class="reply-meta">Posted by JaneSmith on 2023-10-16</div>
                <div class="reply-content">
                    This is a reply to the main post. You can display your replies like this.
                </div>

                <!-- Reply Button for JaneSmith's Reply -->
                <button class="reply-btn" data-reply-target="reply-form-1">Reply</button>

                <!-- Show/Hide Replies Button -->
                <button class="show-hide-replies" onclick="toggleReplies(this)">Show Replies</button>

                <!-- Container for nested replies -->
                <div class="nested-replies" style="display: none;">
                    <!-- Reply Form for JaneSmith's Reply (hidden initially) -->
                    <div class="reply-form" id="reply-form-1" style="display: none;">
                        <form method="post" action="submit_reply.php">
                            <textarea name="reply_content" placeholder="Write your reply here..." rows="4" required></textarea>
                            <input type="hidden" name="thread_id" value="1">
                            <input type="hidden" name="parent_reply_id" value="1"> <!-- Reply to JaneSmith's post -->
                            <button type="submit">Post Reply</button>
                        </form>
                    </div>

                    <!-- Nested Reply -->
                    <div class="nested-reply">
                        <div class="reply-meta">Posted by JohnDoe on 2023-10-16</div>
                        <div class="reply-content">
                            This is a nested reply to JaneSmith's comment.
                        </div>

                        <!-- Reply Button for Nested Reply -->
                        <button class="reply-btn" data-reply-target="reply-form-2">Reply</button>

                        <!-- Reply Form for JohnDoe's Nested Reply (hidden initially) -->
                        <div class="reply-form" id="reply-form-2" style="display: none;">
                            <form method="post" action="submit_reply.php">
                                <textarea name="reply_content" placeholder="Write your reply here..." rows="4" required></textarea>
                                <input type="hidden" name="thread_id" value="1">
                                <input type="hidden" name="parent_reply_id" value="2"> <!-- Reply to JohnDoe's nested reply -->
                                <button type="submit">Post Reply</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Second Reply -->
            <div class="reply-box">
                <div class="reply-meta">Posted by DungeonMasterX on 2023-10-17</div>
                <div class="reply-content">
                    This is another reply to the main post, discussing how to organize threaded discussions.
                </div>

                <!-- Reply Button for DungeonMasterX's Reply -->
                <button class="reply-btn" data-reply-target="reply-form-3">Reply</button>

                <!-- Show/Hide Replies Button -->
                <button class="show-hide-replies" onclick="toggleReplies(this)">Show Replies</button>

                <!-- Reply Form for DungeonMasterX's Reply (hidden initially) -->
                <div class="reply-form" id="reply-form-3" style="display: none;">
                    <form method="post" action="submit_reply.php">
                        <textarea name="reply_content" placeholder="Write your reply here..." rows="4" required></textarea>
                        <input type="hidden" name="thread_id" value="1">
                        <input type="hidden" name="parent_reply_id" value="3"> <!-- Reply to DungeonMasterX's post -->
                        <button type="submit">Post Reply</button>
                    </form>
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
        document.querySelectorAll('.reply-btn').forEach(function(button) {
            button.addEventListener('click', function() {
                const targetId = this.getAttribute('data-reply-target');
                const replyForm = document.getElementById(targetId);
                if (replyForm.style.display === 'none') {
                    replyForm.style.display = 'block';
                } else {
                    replyForm.style.display = 'none';
                }
            });
        });

        function toggleReplies(button) {
            const nestedReplies = button.nextElementSibling; // Find the nested replies section right after the button
            if (nestedReplies.style.display === "none" || nestedReplies.style.display === "") {
                nestedReplies.style.display = "block";
                button.textContent = "Hide Replies";
            } else {
                nestedReplies.style.display = "none";
                button.textContent = "Show Replies";
            }
        }
    </script>

</body>

</html>