<?php
// Start the session
session_start();

include 'connection.php';

if (isset($_SESSION['signed_in']) && $_SESSION['signed_in'] == true) {
    // If already signed in, no need to show the form
    echo '<p class="already-signed-in">You are already signed in.</p>';
} else {
    // Handle form submission
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $errors = array();

        if (!isset($_POST['user_name']) || empty($_POST['user_name'])) {
            $errors[] = 'The username field must not be empty.';
        }

        if (!isset($_POST['user_pass']) || empty($_POST['user_pass'])) {
            $errors[] = 'The password field must not be empty.';
        }

        if (!empty($errors)) {
            // Display errors if there are any
            echo '<div class="error-message">';
            echo 'Oh no. Some areas are not filled in correctly.';
            echo '<ul>';
            foreach ($errors as $value) {
                echo '<li>' . $value . '</li>';
            }
            echo '</ul>';
            echo '</div>';
        } else {
            // Prepare the SQL query
            $sql = "SELECT user_id, user_name, user_level FROM users WHERE user_name = ? AND user_pass = ?";
            $stmt = mysqli_prepare($conn, $sql);
            mysqli_stmt_bind_param($stmt, 'ss', $_POST['user_name'], sha1($_POST['user_pass']));
            $result = mysqli_stmt_execute($stmt);

            if (!$result) {
                echo '<p class="error-message">Something went wrong while signing in. Please try again later.</p>';
            } else {
                $result = mysqli_stmt_get_result($stmt);
                if (mysqli_num_rows($result) == 0) {
                    echo '<p class="error-message">You have supplied a wrong user/password combination. Please try again.</p>';
                } else {
                    // Successfully logged in
                    $_SESSION['signed_in'] = true;
                    while ($row = mysqli_fetch_assoc($result)) {
                        $_SESSION['user_id']    = $row['user_id'];
                        $_SESSION['user_name']  = $row['user_name'];
                        $_SESSION['user_level'] = $row['user_level'];
                    }

                    // Redirect to the page they came from
                    $redirect_url = isset($_POST['redirect_url']) ? $_POST['redirect_url'] : 'index.php';
                    header("Location: $redirect_url");
                    exit();
                }
            }
        }
    }
}
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign In!</title>
    <link rel="stylesheet" href="signin.css">
</head>

<body>
    <div class="container">
        <h3>Sign In</h3>
        <?php if (!isset($_SESSION['signed_in']) || $_SESSION['signed_in'] !== true): ?>
            <form method="post" action="">
                <!-- Pass the redirect URL as a hidden field -->
                <input type="hidden" name="redirect_url" value="<?php echo htmlspecialchars($_GET['redirect'] ?? 'index.php'); ?>">
                <input type="text" name="user_name" placeholder="Username" required />
                <input type="password" name="user_pass" placeholder="Password" required />
                <input type="submit" value="Sign in" />
            </form>
        <?php else: ?>
            <p class="already-signed-in">You are already signed in.</p>
        <?php endif; ?>
    </div>
</body>

</html>

<?php
$conn->close();
?>