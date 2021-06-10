<?php 
require 'connect.inc.php';
require 'core.inc.php';

if(!loggedin()) {

	if (
		isset($_POST['username']) &&
		isset($_POST['pass']) &&
		isset($_POST['pass_again']) &&
		isset($_POST['firstname']) &&
		isset($_POST['surname'])
	) {
		$username = $_POST['username'];
		$password = $_POST['pass'];
		$password_again = $_POST['pass_again'];
		$password_hash = md5($password);
		$firstname = $_POST['firstname'];
		$surname = $_POST['surname'];

		if (
			!empty($username) &&
			!empty($password) &&
			!empty($password_again) &&
			!empty($firstname) &&
			!empty($surname)
		) {
			if (
				strlen($username)>30 ||
				strlen($firstname)>40 ||
				strlen($surname)>40
			) {
				echo 'Please adhere to maxlength of fields';
			} else {			
				if ($password != $password_again) {
					echo 'Passwords do not match';
				} else {
					$query = "SELECT `username` FROM `users` WHERE `USERNAME`='$username'";
					$query_run = mysqli_query($dbc, $query);
						if ($query_run) {
						$query_num_rows = mysqli_num_rows($query_run);

						if ($query_num_rows == 1) {
							echo 'Username already exists';
						} else if ($query_num_rows == 0) {
							$query = "INSERT INTO `users` VALUES ('','".mysqli_real_escape_string($dbc, $username)."','$password_hash','".mysqli_real_escape_string($dbc, $firstname)."','".mysqli_real_escape_string($dbc, $surname)."')";
							$query_run = mysqli_query($dbc, $query);
							if ($query_run) {
								header('Location: register_success.php');
							} else {
								echo 'Sorry we couldn\'t register you at this time. Please try again later';
							}
						}
					}
				}
			}
		} else {
			echo 'All fields are required';
		}
	}
?>

<form action="register.php" method="POST">
	Username: <br><input type="text" name="username" maxlength="30" value="<?php if (isset($username)) { echo $username; } ?>"><br><br>
	Password: <br><input type="password" name="pass"><br><br>
	Password again: <br><input type="password" name="pass_again"><br><br>
	Firstname: <br><input type="text" name="firstname" maxlength="40" value="<?php if (isset($firstname)) { echo $firstname; } ?>"><br><br>
	Surname: <br><input type="text" name="surname" maxlength="40" value="<?php if (isset($surname)) { echo $surname; } ?>"><br><br>
	<input type="submit" value="Register">
</form>

<?php
} else if(loggedin()) {
	echo 'Logged in';
}
?>