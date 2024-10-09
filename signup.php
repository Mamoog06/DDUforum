<?php
include 'connection.php';
include 'header.php';

echo '<h3>Sign up</h3>';
if($_SERVER['REQUEST_METHOD'] != 'POST')
{
    echo '<form method="post" action=""> 
Username: <input type="text" name="user_name" /> 
Password: <input type="password" name="user_pass"> 
Password again: <input type="password" name="user_pass_check"> 
E-mail: <input type="email" name="user_email"> 
<input type="submit" value="Sign up" /> 
</form>';
}
else
{
    $errors = array();
	if(isset($_POST['user_name']))
	{
		if(!ctype_alnum($_POST['user_name']))
		{
			$errors[] = 'The username can only include letters and numbers.';
		}
		if(strlen($_POST['user_name']) > 30)
		{
			$errors[] = 'The username cannot be longer than 30 characters.';
		}
	}
	else
	{
		$errors[] = 'The username field cannot be empty.';
	}
	if(isset($_POST['user_pass']))
	{
		if($_POST['user_pass'] != $_POST['user_pass_check'])
		{
			$errors[] = 'The second password did not match the first one.';
		}
	}
	else
	{
		$errors[] = 'The password cannot be left empty.';
	}
	if(!empty($errors))
	{
		echo 'Oh no. Some areas are not filled in correctly.';
		echo '<ul>';
		foreach($errors as $key => $value)
		{
			echo '<li>' . $value . '</li>';
		}
		echo '</ul>';
	}
	else
	{
        $sql = "INSERT INTO users(user_name, user_pass, user_email, user_date, user_level) 
		VALUES (?, ?, ?, NOW(), 0)";
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, 'sss', $_POST['user_name'], sha1($_POST['user_pass']), $_POST['user_email']);
        $result = mysqli_stmt_execute($stmt);
        if(!$result)
		{
			echo 'Something went wrong while registering. Please try again later.';
		}
		else
		{
			echo 'Successfully made an account. You can now <a href="signin.php">sign in</a> and start posting (:';
		}
	}
}

include 'footer.php';
?>