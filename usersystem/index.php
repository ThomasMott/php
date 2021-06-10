<?php
require 'connect.inc.php';
require 'core.inc.php';

if (loggedin()) {
	$firstname = getfield('firstname', $dbc);
	$surname = getfield('surname', $dbc);
	echo 'You are logged in, '.$firstname.' '.$surname.' <a href="logout.php">Log out</a>';
	
} else {
	include 'loginform.inc.php';
}

?>