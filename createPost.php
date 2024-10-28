<?php
session_start();
include 'connection.php';

// Check if user is signed in
if (!isset($_SESSION['signed_in']) || $_SESSION['signed_in'] !== true) {
    // Redirect to sign-in page or show a message if not signed in
    echo 'Sorry, you have to be <a href="/signin.php">signed in</a> to create a post.';
    exit;
}

// Handle POST submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $post_caption = mysqli_real_escape_string($conn, $_POST['title']);
    $post_content = mysqli_real_escape_string($conn, $_POST['content']);
    $post_cat = intval($_POST['cat_id']); // Get the category ID from the form
    $post_by = $_SESSION['user_id'];

    // Insert the post into the database
    $sql = "INSERT INTO posts (post_caption, post_content, post_date, post_cat, post_by) 
            VALUES ('$post_caption', '$post_content', NOW(), $post_cat, $post_by)";

    if (mysqli_query($conn, $sql)) {
        // Redirect to the category page or the newly created post
        header('Location: category.php?cat_id=' . $post_cat);
        exit;
    } else {
        echo 'An error occurred while posting. Please try again later.';
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create a New Post</title>
    <link rel="stylesheet" href="header.css">
    <link rel="stylesheet" href="createPost.css">
</head>

<body>
    <?php include 'header.php'; ?>

    <main>
        <div class="post-container">
            <form method="post" action="createPost.php">
                <!-- Pass the cat_id from the URL to associate the post with the correct category -->
                <input type="hidden" name="cat_id" value="<?php echo intval($_GET['cat_id']); ?>">

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
                    <input type="text" id="tags" name="tags" placeholder="Add tags...">
                </div>

                <!-- Post Button -->
                <div class="input-group">
                    <button type="submit">Post</button>
                </div>
            </form>
        </div>
    </main>

    <?php include 'footer.php'; ?>
</body>

</html>