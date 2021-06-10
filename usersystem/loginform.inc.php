<?php

if (isset($_POST['username']) && isset($_POST['pass'])) {
	$username = $_POST['username'];
	$password = $_POST['pass'];

	$password_hash = md5($password);

	if (!empty($username) && !empty($password)) {
		
		$query = "SELECT `id` FROM `users` WHERE `username`='".mysqli_real_escape_string($dbc, $username)."' AND `password`='".$password_hash."'";
		$query_run = mysqli_query($dbc, $query);
			if ($query_run) {
			$query_num_rows = mysqli_num_rows($query_run);

			if ($query_num_rows == 0) {
				echo 'Username and password combination is bad';
			} else if ($query_num_rows == 1) {

				while($row = mysqli_fetch_assoc($query_run)) {
					$id = $row['id'];
				}
				$_SESSION['user_id']=$id;
				header('Location: index.php');
			}
		}
	} else {
		echo 'You must supply a username and password';
	}
}

?>

<form action="<?php echo $current_file; ?>" method="POST">
	Username: <input type="text" name="username">
	Password: <input type="password" name="pass">
	<input type="submit" value="Log in">
</form>