<!DOCTYPE HTML>
<html lang="en">
<head>
	<title>Add Students</title>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="../styles/styles.css">
	<link rel="stylesheet" type="text/css" href="../styles/bootstrap.css">
</head>
<body>
	<div class="container">
		<div class="jumbotron">
		<?php

			include 'database.inc.php';

			if (!isset($_POST['submit-voters'])) {
				# code...
				header("Location: ../vote.settings.php");
				exit();
			}else{
				$numOfVoters = $_POST['numOfVoters'];
				$myNumVoter = 0;
				$myNumVoterId = 0;
				$insert = 0;

				while ($myNumVoter < $numOfVoters) {
					# code...
					$voterName[] = $_POST['voter'.$myNumVoter];
					$myNumVoter++;
				}

				while ($myNumVoterId < $numOfVoters) {
					# code...
					$voterId[] = $_POST['voterId'.$myNumVoterId];
					$myNumVoterId++;
				}

				while ($insert < $numOfVoters) {
					$checkSQL = "SELECT * FROM students WHERE users = '$voterId[$insert]' AND name = '$voterName[$insert]'";
					$checkQuery = mysqli_query($conn, $checkSQL);

					if (mysqli_num_rows($checkQuery) > 0) {
						echo "<p>Student <b>".$voterName[$insert]."</b> already exists</p>";
					}else{
						$voterId[$insert] = strtoupper($voterId[$insert]);
						$sql = "INSERT INTO students(users, name) VALUES('$voterId[$insert]', '$voterName[$insert]')";
					$query = mysqli_query($conn, $sql);
					if (!$query) {
						# code...
						echo "<p>Error</p><br>";
					}else{
						echo "<p>Done adding <b>".$voterName[$insert]."</b></p><br>";
					}

					}
					$insert++;
				}

				echo "<p><a href='../vote.settings.php'>Go back</a> <span class='lead'>OR</span> <a href='../main.php'>Go to main page</a></p>";
				

			}
	?>
			
		</div>
	</div>
</body>
