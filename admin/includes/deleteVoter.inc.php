<!DOCTYPE html>
<html>
<head>
	<title>Delete Student</title>
	<link rel="stylesheet" type="text/css" href="../styles/styles.css">
	<link rel="stylesheet" type="text/css" href="../styles/bootstrap.css">
</head>
<body>
<div class="container">
	<div class="jumbotron">
		<?php

			require 'database.inc.php';

			if (!isset($_POST['really-del'])) {
				# code...
				header("Location: ../vote.settings.php");
				exit();
			}else{
				if ($_POST['deleteVoter'] == 'default') {
					# code...
					echo "<p>Please choose a student! <a href='../vote.settings.php'>go back</a></p>";
				}else{
					$theStudent = $_POST['deleteVoter'];
					$sql = "DELETE FROM students WHERE users = '$theStudent'";

					$query = mysqli_query($conn, $sql);

					$query2 = mysqli_query($conn, "DELETE FROM userhasdone WHERE user = '$theStudent'");

					if (!$query) {
						# code...
						echo "<p>There was an error while trying to delete the student, please <a href='../vote.settings.php'>try again</a></p>";
					}else{

						if (!$query2) {
							# code...
							echo "<p>There was an error while trying to delete the student, please <a href='../vote.settings.php'>try again</a></p>";
						}else{
							echo "<p class='lead'>Deleted voter with student ID <b>".strtoupper($theStudent)."</b></p>";
						echo "<p>Please <a href='../vote.settings.php'>go back</a> <span class='lead'>OR</span> go to the <a href='../main.php'>main page</a></p>";
						}

					}
				}
			}


		?>
	</div>
</div>
</body>
</html>
