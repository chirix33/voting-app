<?php
	include_once 'database.inc.php';
	session_start();

	if (isset($_POST['countVote'])) {

		if (isset($_SESSION['banned'])) {
			$theBannedPose  = $_SESSION['banned'];
			$checkForBannedSQL = "SELECT * FROM positions WHERE name = '$theBannedPose'";
			$checkForBannedQuery = mysqli_query($conn, $checkForBannedSQL);
			while ($thePose = mysqli_fetch_assoc($checkForBannedQuery)) {
				if ($thePose['name'] == $theBannedPose) {
					echo "<p class='lead'>You cannot vote twice!</p>";
					echo "<p class='lead'>Please <a href='../vote.php'>go on</a></p>";
				}else{
					header("Location: ../vote.php?votedPosition=$theBannedPose");
					exit();
				}
			}
		}else{

				$notAgainPose = $_POST['notAgainPose'];
				$thevotedCand = $_POST['theCandAtLast'];
				$notAgainId = $_POST['notAgainId'];

				$selectCount = "SELECT * FROM candidates WHERE position = '$notAgainPose' AND name = '$thevotedCand'";

				$resultCount = mysqli_query($conn, $selectCount);

				while ($come = mysqli_fetch_assoc($resultCount)) {
					$newVote = $come['counts'] + 1;
					$updateCount = "UPDATE candidates SET counts = $newVote WHERE position = '$notAgainPose' AND name = '$thevotedCand'";
					mysqli_query($conn, $updateCount);
					$_SESSION['banned'] = $notAgainPose;
					$theBannedPose = $_SESSION['banned'];
					header("Location: ../vote.php?votedPosition=$theBannedPose");
					exit();
				}

			}


		}

?>