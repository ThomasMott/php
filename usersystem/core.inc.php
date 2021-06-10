<?php 
ob_start();
session_start();
$current_file = $_SERVER['SCRIPT_NAME'];
if (isset($_SERVER['HTTP_REFERER']) && !empty($_SERVER['HTTP_REFERER'])) {
	$http_referer = $_SERVER['HTTP_REFERER'];
}

function loggedin() {
	if (isset($_SESSION['user_id']) && !empty($_SESSION['user_id'])) {
		return true;
	} else {
		return false;
	}
}

function getfield($field, $dbc) {
	$query = "SELECT `$field` FROM `USERS` WHERE `id`='".$_SESSION['user_id']."'";
	$query_run = mysqli_query($dbc, $query);
	if ($query_run) {
		while($row = mysqli_fetch_assoc($query_run)) {
			$userdata = $row[$field];
		}
		return $userdata;
	}
} 

?>