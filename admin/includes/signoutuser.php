<!DOCTYPE HTML>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta name="author" content="Ashraf Abdul-Muumin">
		<meta name="viewport" content="width=device-width,initial-scale=1.0">
		<link rel="stylesheet" type="text/css" href="../styles/bootstrap.css">
		<link rel="stylesheet" type="text/css" href="../styles/styles.css">
		<?php 
		session_start();
		 if(isset($_SESSION['id'])){echo "<title>Signout user ".$_SESSION['id']."</title>";}else{header("Location: ../userlogin.php"); exit();}
		 ?>
	</head>
	<body>
		<div class="container">
			<div class="jumbotron">
				<?php

					if (!isset($_POST['signoutbtn'])) {
						header("Location: ../userlogin.php");
						exit();
					}else{
						session_unset();
						session_destroy();
						echo "<p class='lead'>Signed out. Please <a href='../userlogin.php'>Go back</a></p>";
					}
				?>
			</div>
		</div>
	</body>
</html>
