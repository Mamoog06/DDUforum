	<?php
	session_start();
	include 'connection.php';
	include 'header.php';
	echo '<h2>Create a post</h2>';
	if ($_SESSION['signed_in'] == false) {
		echo 'Sorry, you have to be <a href="/forum/signin.php">signed in</a> to create a post.';
	} else {
		if ($_SERVER['REQUEST_METHOD'] != 'POST') {

			$sql = "SELECT 
	cat_id, 
	cat_name, 
	cat_description 
	FROM 
	categories";
			$result = mysqli_query($conn, $sql);
			if (!$result) {
				echo 'Error while selecting from database. Please try again later.';
			} else {
				echo '<form method="post" action=""> 
	Category:';
				echo '<select name="post_cat">';
				while ($row = mysqli_fetch_assoc($result)) {
					echo '<option value="' . $row['cat_id'] . '">' . $row['cat_name'] . '</option>';
				}
				echo '</select>';
				echo 'Caption: <input type="text" name="post_caption" /> 
Content: <input type="text" name="post_content" /> 
<input type="submit" value="Create post" /> 
</form>';
			}
		} else {
			mysqli_begin_transaction($conn);
			$query = "BEGIN WORK;";
			$result = mysqli_query($conn, $query);
			if (!$result) {
				echo 'An error occured while creating your post. Please try again later.';
			} else {
				$post_caption = mysqli_real_escape_string($conn, $_POST['post_caption']);
				$post_content = mysqli_real_escape_string($conn, $_POST['post_content']);
				$post_cat = mysqli_real_escape_string($conn, $_POST['post_cat']);
				$post_by = $_SESSION['user_id'];
				$sql = "INSERT INTO 
posts(post_caption,
post_content,
post_date, 
post_cat, 
post_by) 
VALUES('$post_caption', 
'$post_content' 
NOW(), 
'$post_cat', 
'$post_by' 
)";
				$result = mysqli_query($conn, $sql);
				if (!$result) {
					echo 'An error occurred while inserting your data. Please try again later.' . mysqli_error($conn);
					$sql = "ROLLBACK;";
					$result = mysqli_query($conn, $sql);
				} else {
					$post_id = mysqli_insert_id($conn);
					$com_content = mysqli_real_escape_string($conn, $_POST['com_content']);
					$com_post = $post_id;
					$com_by = $_SESSION['user_id'];
					$sql = "INSERT INTO 
comments(com_content, 
com_date, 
com_post, 
com_by) 
VALUES 
('$com_content', 
NOW(), 
'$com_post', 
'$com_by' 
)";
					$result = mysqli_query($conn, $sql);
					if (!$result) {
						echo 'An error occured while inserting your comment. Please try again later.' . mysql_error();
						$sql = "ROLLBACK;";
						$result = mysqli_query($conn, $sql);
					} else {
						$sql = "COMMIT;";
						$result = mysqli_query($conn, $sql);
						echo 'You have successfully created <a href="post.php?id=' . $post_id . '">your new post</a>.';
					}
				}
			}
		}
	}
	include 'footer.php';
	?>