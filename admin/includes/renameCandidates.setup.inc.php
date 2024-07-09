<?php
	
	include 'database.inc.php';

	if (!isset($_POST['submit-candidate-rename'])) {
		# code...
		header("Location: ../vote.cand.setup.php");
		exit();
	}else{
		$election = $_POST['election'];
		$position = $_POST['position'];
		$oldName = $_POST['oldName'];
		$newName = $_POST['newName'];

		if ($oldName == $newName) {
			# code...
			header("Location: ../vote.cand.setup.php?rename=same");
			exit();
		}elseif($newName == ""){
			header("Location: ../vote.cand.setup.php?rename=empty");
			exit();
		}else{
			$sql = "UPDATE candidates SET name = '$newName' WHERE name = '$oldName' AND position = '$position' AND election = '$election'";
			
	
			$query = mysqli_query($conn, $sql);

			if (!$query) {
				# code...
				header("Location: ../vote.cand.setup.php?rename=error");
				exit();
			}else{
				$updateVoteCountsSQL = "UPDATE votecounts SET name = '$newName' WHERE name = '$oldName' AND position = '$position' AND election = '$election'";
				 $updateVoteCountsQuery = mysqli_query($conn, $updateVoteCountsSQL);

				 if (!$updateVoteCountsQuery) {
				 	# code...
				 	header("Location: ../vote.cand.setup.php?rename=error");
					exit();
				 }else{
				 	header("Location: ../vote.cand.setup.php?rename=success");
				 }
			}
			
		}
	}