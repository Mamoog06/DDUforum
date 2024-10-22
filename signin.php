<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Sign In</title>
	<link rel="stylesheet" href="signin.css">
</head>

<body>
	<div class="container">
		<?php
		echo '<h3>Sign In</h3>';
		include 'connection.php';

		if ($_SESSION['signed_in'] == true) {
			echo '<p class="already-signed-in">You are already signed in.</p>';
		} else {
			if ($_SERVER['REQUEST_METHOD'] != 'POST') {
				echo '<form method="post" action="">
                    <input type="text" name="user_name" placeholder="Username" required />
                    <input type="password" name="user_pass" placeholder="Password" required />
                    <input type="submit" value="Sign in" />
                </form>';
			} else {
				$errors = array();

				if (!isset($_POST['user_name'])) {
					$errors[] = 'The username field must not be empty.';
				}
				if (!isset($_POST['user_pass'])) {
					$errors[] = 'The password field must not be empty.';
				}

				if (!empty($errors)) {
					echo '<div class="error-message">';
					echo 'Oh no. Some areas are not filled in correctly.';
					echo '<ul>';
					foreach ($errors as $key => $value) {
						echo '<li>' . $value . '</li>';
					}
					echo '</ul>';
					echo '</div>';
				} else {
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
							$_SESSION['signed_in'] = true;
							while ($row = mysqli_fetch_assoc($result)) {
								$_SESSION['user_id']    = $row['user_id'];
								$_SESSION['user_name']  = $row['user_name'];
								$_SESSION['user_level'] = $row['user_level'];
							}
							echo '<p class="success-message">Welcome, ' . $_SESSION['user_name'] . '. 
                        <a href="index.php" class="proceed-link">Proceed to the forum overview</a>.</p>';
						}
					}
				}
			}
		}
		?>
	</div>
</body>

</html>