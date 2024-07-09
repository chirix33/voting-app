<!DOCTYPE HTML>
<html>
<head>
	<title>Signout</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width,initial-scale=1.0">
	<link rel="stylesheet" type="text/css" href="../styles/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="../styles/styles.css">
</head>
<body>
	<div class="jumbotron">
		<div class="container">
			<?php
				session_start();

				if (!isset($_POST['really'])) {
					echo "<p class='lead'>Please <a href='../main.php'>go back</a> and sign out again</p>";
				}else{
					session_unset();
					session_destroy();
					echo "<p class='lead'>Signed out. Please click <a href='../index.php'>here</a> to go back</p>";
				}
			?>
		</div>
	</div>
</body>
