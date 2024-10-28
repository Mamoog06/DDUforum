<?php
session_start();
include 'connection.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($post_caption); ?></title>
    <link rel="stylesheet" href="header.css">
    <link rel="stylesheet" href="rules.css">
</head>

<body>
    <?php include 'header.php'; ?>

    <main>
        <section class="rules-container">
            <div class="rule-item">1. Use common sense</div>
            <div class="rule-item">2. No hate. Constructive responses only</div>
            <div class="rule-item">3. Keep posts relevant</div>
            <div class="rule-item">4. No NSFW content</div>
            <div class="rule-item">5. Do not impersonate other people</div>
            <div class="rule-item">6. Don't advertise or try to sell products</div>
        </section>
    </main>

    <?php
    include('footer.php')
    ?>