<?php
session_start();
include 'connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['logout'])) {

    session_unset();
    session_destroy();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forum header</title>
    <link rel="stylesheet" href="header.css">
</head>

<header>
    <div class="logo">
        <a href="index.php" style="text-decoration: none; color: inherit">
            <img src="ForumLogo.png" alt="Forum Logo">
        </a>
    </div>

    <div class="search-container">
        <input type="text" placeholder="Search...">
    </div>
    <div class="actions">
        <div class="rules">
            <a href="rules.php" style="text-decoration: none; color: inherit">Rules</a>
        </div>
        <div class="profile">
            <?php if (!isset($_SESSION['signed_in']) || $_SESSION['signed_in'] !== true): ?>
                <div class="dropdown">
                    <button class="dropbtn">Profile</button>
                    <div class="dropdown-content">
                        <a href="signin.php?redirect=<?php echo urlencode($_SERVER['REQUEST_URI']); ?>">Login</a>
                        <a href="signup.php">Sign up</a>
                    </div>
                </div>
            <?php else: ?>
                <!-- Profile button with dropdown -->
                <div class="dropdown">
                    <button class="dropbtn">Profile</button>
                    <div class="dropdown-content">
                        <a href="profile.php">View Profile</a>
                        <form method="POST" action="" style="margin: 0; padding: 0;">
                            <button type="submit" name="logout">Log Out</button>
                        </form>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </div>
</header>

<script>
    document.querySelectorAll('.dropdown').forEach(function(dropdown) {
        const content = dropdown.querySelector('.dropdown-content');

        // Show dropdown on mouse enter
        dropdown.addEventListener('mouseenter', function() {
            content.style.display = 'block'; // Show the dropdown content
        });

        // Hide dropdown on mouse leave
        dropdown.addEventListener('mouseleave', function() {
            content.style.display = 'none'; // Hide the dropdown content
        });
    });
</script>