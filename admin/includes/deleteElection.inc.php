<?php

	include 'database.inc.php';

	if (!isset($_POST['delElectionBtn'])) {
		# code...
		header("Location: ../vote.pose.php");
		exit();
	}else{
		if ($_POST['delElection'] == 'default') {
			header("Location: ../vote.pose.php?deleteEl=default");
			exit();
		}else{
			$theElectionDelete = $_POST['delElection'];
			$deleteSQL = "DELETE FROM elections WHERE name = '$theElectionDelete'";
			$deleteQuery = mysqli_query($conn, $deleteSQL);
			if (!$deleteQuery) {
				# code...
				header("Location: ../vote.pose.php?deleteEl=error");
				exit();
			}else{
				$deletePoses = "DELETE FROM positions WHERE election = '$theElectionDelete'";
				$deletePosesQuery = mysqli_query($conn, $deletePoses);
				if (!$deletePosesQuery) {
					# code...
					header("Location: ../vote.pose.php?deleteEl=error");
					exit();
				}else{
					$deleteCands = "DELETE FROM candidates WHERE election = '$theElectionDelete'";
					$deleteCandsQuery = mysqli_query($conn, $deleteCands);

					if (!$deleteCandsQuery) {
						# code...
						header("Location: ../vote.pose.php?deleteEl=error");
						exit();
					}else{
						$deleteUserHasDone = mysqli_query($conn, "DELETE FROM userhasdone WHERE election = '$theElectionDelete'");
						if (!$deleteUserHasDone) {
							# code...
							header("Location: ../vote.pose.php?deleteEl=error");
							exit();
						}else{
							$deleteVoteCounts = mysqli_query($conn, "DELETE FROM votecounts WHERE election = '$theElectionDelete'");
							if (!$deleteVoteCounts) {
								# code...
								header("Location: ../vote.pose.php?deleteEl=error");
								exit();
							}else{
								header("Location: ../vote.pose.php?deleteEl=success");
								exit();
							}
		
						}
						
					}
				
				}
			}
		}
	}

?>