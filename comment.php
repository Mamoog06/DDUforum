<?php 
session_start();
include 'connection.php';
include 'header.php';
if($_SERVER['REQUEST_METHOD'] != 'POST')
{
    echo 'This file cannot be called directly.';
}
else
{
	if(!$_SESSION['signed_in'] == false)
	{
		echo 'You must be signed in to post a reply.';
	}
	else
	{
		$sql = "INSERT INTO 
comments(com_content, 
com_date, 
com_post, 
com_by) 
VALUES (?, NOW(), ?, ?)";
		$stmt = mysqli_prepare($conn, $sql);
		mysqli_stmt_bind_param($stmt, "sii", $_POST['comment-content'], $_GET['id'], $_SESSION['user_id']);
		mysqli_stmt_execute($stmt);
		if(mysqli_stmt_errno($stmt))
		{
			echo 'Your reply has not been saved, please try again later.';
		}
		else
		{
			echo 'Your comment has been saved, check out <a href="post.php?id=' . htmlentities($_GET['id']) . '">the post</a>.';
		}
	}
}
include 'footer.php';
?>