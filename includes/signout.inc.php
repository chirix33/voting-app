<?php 
session_start();
?>
<!DOCTYPE HTML>
<html lang="en">
	<head>
		<title>Signout</title>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width,initial-scale=1.0">
		<meta name="author" content="3A4">
		<meta name="description" content="SRC voting">
		<link rel="stylesheet" type="text/css" href="../styles/styles.css">
		<link rel="stylesheet" type="text/css" href="../styles/bootstrap.css">
	</head>
	<body>
		<div class="jumbotron">
			<div class="container">
				<?php
					if (!isset($_POST['really'])) {
						header("Location: ../vote.php");
						exit();
					}else{
						session_unset();
						session_destroy();
						echo "<p class='lead'>Signed out. Please go <a href='../index.php'>back</a></p>";
					}
				?>
			</div>
		</div>
	</body>
</html>