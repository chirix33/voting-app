<?php
	
	include 'database.inc.php';

	if (!isset($_POST['submit-elections'])) {
		# code...
		header("Location: ../vote.elect.php");
		exit();
	}else{
		$myNumber = 0;
		$trueNumberOfElections = $_POST['trueNumberOfElections'];

		while ($myNumber <= $trueNumberOfElections - 1) {
			# code...
			$election[$myNumber] = $_POST['election'.$myNumber];
			$sql = "INSERT INTO elections(name, session) VALUES('$election[$myNumber]', 0)";
			$query = mysqli_query($conn, $sql);
			$myNumber++;
		}
			if (!$query) {
				# code...
				header("Location: ../vote.elect.php?election=error");
				exit();	
			}else{
				header("Location: ../vote.elect.php?election=success");
				exit();
			}
	}
	


?>