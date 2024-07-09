<?php
	include 'database.inc.php';

	if (!isset($_POST['submitPoses'])) {
		# code...
		header("Location: vote.pose.php");
		exit();
	}else{
		$hiddenNum = $_POST['trueNumberOfPositions'];
		$hiddenPose = $_POST['hiddenPose'];
		for ($i=0; $i < $hiddenNum ; $i++) { 
			# code...
			$pose[$i] = $_POST['pose'.$i];
			$sql = "INSERT INTO positions(name, election) VALUES('$pose[$i]', '$hiddenPose')";
			$query = mysqli_query($conn, $sql);
		}

		if (!$query) {
				# code...
				header("Location: ../vote.pose.php?position=error");
				exit();
			}else{
				header("Location: ../vote.pose.php?position=success");
				exit();
			}
	}


?>