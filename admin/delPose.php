<?php
	
	include 'includes/database.inc.php';

	if (!isset($_POST['electionDelete'])) {
		# code...
		echo "";
	}else{
		$electionDelete = $_POST['electionDelete'];
		$sql = "SELECT * FROM positions WHERE election = '$electionDelete'";
		$query = mysqli_query($conn, $sql);

		if (mysqli_num_rows($query) < 1) {
			# code...
			echo "<p class='lead'>There are no positions under <u>".$electionDelete."</u></p>";
			echo "<a class='btn btn-default' href='vote.pose.php'>Okay</a>";
		}else {

			echo "<p style='font-size: 18px;'>Choose the position</p>";
		echo "<form action='includes/deletePosition.inc.php' method='POST'>";
		echo "<select name='deletePosition' class='selectStyled'>";
		echo "<option value='default'>Choose a position</option>";
		while ($eachPosition = mysqli_fetch_assoc($query)) {
			# code...
			echo "<option value='".$eachPosition['name']."'>".$eachPosition['name']."</option>";
		}
		echo "</select>";
		echo "<br><br>";
		echo "<input type='hidden' name='theElection' value='".$electionDelete."'>";
		echo "<button type='submit' name='submit-delete-position' class='btn btn-danger pull-right'>Delete</button>";
		echo "</form>";

		}

		
	}


?>