<?php

	include 'database.inc.php';

	if (!isset($_POST['submit-candidates-delete'])) {
		# code...
		header("Location: ../vote.cand.setup.php");
		exit();
	}else{
		if ($_POST['deleteSelect'] == 'default') {
			# code...
			header("Location: ../vote.cand.setup.php?delete=default");
			exit();
		}else{

			$nameOfCandidate = $_POST['deleteSelect'];

			//Get the position and the election of the candidate wanting to be deleted
			$theElection = $_POST['electionOfCandidate'];
			$thePosition = $_POST['positionOfCandidate'];

			$sql = "DELETE FROM candidates WHERE name = '$nameOfCandidate' AND position = '$thePosition' AND election = '$theElection'";
			$sql2 = "DELETE FROM votecounts WHERE name = '$nameOfCandidate' AND position = '$thePosition' AND election = '$theElection'";

			$query = mysqli_query($conn, $sql);
			$query2 = mysqli_query($conn, $sql2);

			if (!$query || !$query2) {
				# code...
				header("Location: ../vote.cand.setup.php?delete=error");
				exit();
			}else{
				header("Location: ../vote.cand.setup.php?delete=success");
			}

		}

	}