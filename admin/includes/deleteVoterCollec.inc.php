<!DOCTYPE html>
<html>
<head>
	<title>Delete Voters</title>
	<meta charset="utf-8">
	<meta name="author" content="Ashraf & Moro Tijani">
	<meta name="description" content="Do not copy the source code!">
	<meta name="viewport" content="width=device-width,initial-scale=1">
	<link rel="stylesheet" href="../styles/styles.css">
	<link rel="stylesheet" href="../styles/bootstrap.css">
</head>
<body>
	<div class="container">
		<div class="jumbotron">

		</div>
	</div>
</body>
</html>

<?php

	include 'database.inc.php';

	if (!isset($_POST['really-del-collec'])) {
		# code...
		header("Location: ../vote.settings.php");
		exit();
	}else{
		//Get the number of students to cycle with it
		//It is the number of rows of the students!!
		$numberToBeCycled =  mysqli_num_rows(mysqli_query($conn, "SELECT * FROM students"));
		//Declare a variable to be the cycler
		$cyclingNum = 0;

		//Start the iteration or loop(I like using the for loop)
		for (; $cyclingNum < $numberToBeCycled; $cyclingNum++) {
			# code...
			if ($_POST['voter'.$cyclingNum] == "") {
				# code...
				continue;
			}

			$votersToBeDeleted[$cyclingNum] = $_POST['voter'.$cyclingNum];

			$deleteVoter = mysqli_query($conn, "DELETE FROM students WHERE users = '$votersToBeDeleted[$cyclingNum]'");

			if (!$deleteVoter) {
				# code...
				header("Location: ../vote.settings.php?delete=error");
				exit();
			}else{
				$deleteUserHasDone = mysqli_query($conn, "DELETE FROM userhasdone WHERE user = 'votersToBeDeleted[$cyclingNum]'");
				if (!$deleteUserHasDone) {
					# code...
					header("Location: ../vote.settings.php?delete=error");
					exit();
				}else{
					header("Location: ../vote.settings.php?delete=success");
				}
			}
		}

	}



?>
