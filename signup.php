<?php
session_start();
include 'connection.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Sign Up</title>
	<link rel="stylesheet" href="signup.css">
</head>

<body>

	<div class="container">
		<?php
		include 'connection.php';

		echo '<h3>Sign Up</h3>';

		if ($_SERVER['REQUEST_METHOD'] != 'POST') {
			echo '<form method="post" action="">
                <input type="text" name="user_name" placeholder="Username" required />
                <input type="password" name="user_pass" placeholder="Password" required />
                <input type="password" name="user_pass_check" placeholder="Password again" required />
                <input type="email" name="user_email" placeholder="E-mail" required />
                <input type="submit" value="Sign up" />
              </form>';
		} else {
			$errors = array();

			// Check for username
			if (isset($_POST['user_name'])) {
				if (!ctype_alnum($_POST['user_name'])) {
					$errors[] = 'The username can only include letters and numbers.';
				}
				if (strlen($_POST['user_name']) > 30) {
					$errors[] = 'The username cannot be longer than 30 characters.';
				}
			} else {
				$errors[] = 'The username field cannot be empty.';
			}

			// Check for password match
			if (isset($_POST['user_pass'])) {
				if ($_POST['user_pass'] != $_POST['user_pass_check']) {
					$errors[] = 'The second password did not match the first one.';
				}
			} else {
				$errors[] = 'The password cannot be left empty.';
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
				$sql = "INSERT INTO users(user_name, user_pass, user_email, user_date, user_level) 
                    VALUES (?, ?, ?, NOW(), 0)";
				$stmt = mysqli_prepare($conn, $sql);
				mysqli_stmt_bind_param($stmt, 'sss', $_POST['user_name'], sha1($_POST['user_pass']), $_POST['user_email']);
				$result = mysqli_stmt_execute($stmt);

				if (!$result) {
					echo '<p class="error-message">Something went wrong while registering. Please try again later.</p>';
				} else {
					echo '<p class="success-message">Successfully made an account. You can now 
                <a href="signin.php" class="proceed-link">sign in</a> and start posting (:</p>';
				}
			}
		}
		?>
	</div>

</body