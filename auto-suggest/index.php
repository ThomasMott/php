<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Auto-suggest</title>
</head>
<body>
	<form id="search" name="search">
		Enter a query:<br>
		<input type="text" id="q" name="search_text" onkeyup="findmatch()";>
	</form>
	<div id="r"></div>
</body>
<script>
	function findmatch() {
		var q = document.getElementById('q').value;
		var r = document.getElementById('r');

		if (q) {
			fetch(`search.inc.php?search_text=${q}`
			).then((res) => res.json()
			).then((data) => r.innerHTML = data
			).catch( err => {
				console.log(err);
			})
		}
	}
</script>
</html>

