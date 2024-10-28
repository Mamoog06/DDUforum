<?php
session_start();
include 'connection.php';

// Assume user is logged in and we have their user_id in session
$user_id = $_SESSION['user_id'] ?? 0; // Replace with actual session logic

// Fetch user information from the database
if ($user_id) {
    $query = "SELECT user_name, user_email FROM users WHERE user_id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $result = $stmt->get_result();

    // If user is found
    if ($result->num_rows === 1) {
        $user = $result->fetch_assoc();
    } else {
        echo "User not found.";
        exit;
    }
} else {
    echo "No user logged in.";
    exit;
}

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $new_user_name = trim($_POST['user_name']);
    $new_user_email = trim($_POST['user_email']);

    // Basic validation
    if (empty($new_user_name) || empty($new_user_email)) {
        $error = "Please fill in all fields.";
    } elseif (!filter_var($new_user_email, FILTER_VALIDATE_EMAIL)) {
        $error = "Invalid email format.";
    } else {
        // Update the database
        $update_query = "UPDATE users SET user_name = ?, user_email = ? WHERE user_id = ?";
        $update_stmt = $conn->prepare($update_query);
        $update_stmt->bind_param("ssi", $new_user_name, $new_user_email, $user_id);

        if ($update_stmt->execute()) {
            $success = "Profile updated successfully.";
            // Optionally, refresh user data in the session
            $_SESSION['user_name'] = $new_user_name;
        } else {
            $error = "Error updating profile: " . $conn->error;
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Profile</title>
    <link rel="stylesheet" href="header.css">
    <link rel="stylesheet" href="profile.css">
</head>

<body>
    <?php include 'header.php'; ?>

    <main>
        <h1>Edit Profile</h1>

        <?php if (isset($error)): ?>
            <div class="error"><?php echo htmlspecialchars($error); ?></div>
        <?php endif; ?>

        <?php if (isset($success)): ?>
            <div class="success"><?php echo htmlspecialchars($success); ?></div>
        <?php endif; ?>

        <form method="POST" action="">
            <div>
                <label for="user_name">Username:</label>
                <input type="text" id="user_name" name="user_name" value="<?php echo htmlspecialchars($user['user_name']); ?>" required>
            </div>
            <div>
                <label for="user_email">Email:</label>
                <input type="email" id="user_email" name="user_email" value="<?php echo htmlspecialchars($user['user_email']); ?>" required>
            </div>
            <div>
                <button type="submit">Update Profile</button>
            </div>
        </form>
    </main>

    <?php include 'footer.php'; ?>
</body>

</html>

<?php
// Close the database connection
$conn->close();
?>