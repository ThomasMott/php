<?php

$mysql_host = 'localhost';
$mysql_user = 'root';
$mysql_pass = '';

$mysql_db = 'ajax-test';

$response = 'no results';

if (isset($_GET['search_text'])) {
	$search_text = $_GET['search_text'];
}

if (!empty($search_text)) {

	$dbc = mysqli_connect($mysql_host, $mysql_user, $mysql_pass, $mysql_db);

	if ($dbc) {
		$query = "SELECT `query` from `queries` WHERE `query` LIKE '%".mysqli_real_escape_string($dbc, $search_text)."%'";
		$query_run = mysqli_query($dbc, $query);

		if ($query_run) {
			$query_num_rows = mysqli_num_rows($query_run);

			if ($query_num_rows == 0) {
				echo json_encode($response);
			} else {
				$stack = [];
				while($row = mysqli_fetch_assoc($query_run)) {
					$querydata = $row['query'];
					array_push($stack, $querydata);
					// echo json_encode($querydata);
				}
				echo json_encode($stack);
			}
			
		} 
	}
}


