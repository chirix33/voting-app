<?php

$firstCheckSQL = "SELECT * FROM userhasdone";
$firstCheckQuery = mysqli_query($conn, $firstCheckSQL);

	while ($check = mysqli_fetch_assoc($firstCheckQuery)) {
		if ($check['user'] == $voter_id) {
			header("Location: index.php?banned");
			exit();
		}
	}