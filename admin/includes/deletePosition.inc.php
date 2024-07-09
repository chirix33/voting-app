<?php 
	
	include 'database.inc.php';

	if (!isset($_POST['submit-delete-position'])) {
		# code...
		header("Location: ../vote.pose.php");
		exit();
	}else{
		$thePosition = $_POST['deletePosition'];
		$theElection = $_POST['theElection'];

		if ($thePosition == 'default') {
			# code...
			header("Location: ../vote.pose.php?delpose=default");
			exit();
		}else{
			$sql = "DELETE FROM positions WHERE election = '$theElection' AND name = '$thePosition'";
			$query = mysqli_query($conn, $sql);

			if (!$query) {
				# code...
				header("Location: ../vote.pose.php?delpose=error");
				exit();
			}else{
				$delCandSQL = "DELETE FROM candidates WHERE position = '$thePosition' AND election = '$theElection'";
				$delCandQuery = mysqli_query($conn, $delCandSQL);

				if (!$delCandQuery) {
					# code...
					header("Location: ../vote.pose.php?delpose=error");
					exit();
				}else{
					$delVoteCounts = mysqli_query($conn, "DELETE FROM votecounts WHERE position = '$thePosition' AND election = '$theElection'");
					if (!$delVoteCounts) {
						# code...
						header("Location: ../vote.pose.php?delpose=error");
						exit();
					}else{
						header("Location: ../vote.pose.php?delpose=success");
						exit();
					}
					
				}

			}
		}
	}
?>