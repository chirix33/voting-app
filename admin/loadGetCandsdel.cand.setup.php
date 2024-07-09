<?php
	
	include 'includes/database.inc.php';

	if (!isset($_POST['position'])) {
		# code...
		echo "";
	} else {
		$position = $_POST['position'];
		$election = $_POST['election'];

		$sql = "SELECT * FROM candidates WHERE position = '$position' AND election = '$election'";
		$query = mysqli_query($conn, $sql);
		$thenumber = mysqli_num_rows($query);

		if ($thenumber < 1) {
			echo "<p class='lead'>There are no candidates under <b>".$position."</b></p>";
			echo "<a href='vote.cand.setup.php' class='btn btn-default'>Okay</a><br><br>";
		}else{

		echo "<form action='includes/deleteCandidates.setup.inc.php' method='POST'>";
		echo "<select name='deleteSelect' class='selectStyled'>";
		echo "<option value='default'>Choose a candidate</option>";
		while ($candidate = mysqli_fetch_assoc($query)) {
			# code...
			echo "<option value='".$candidate['name']."'>".$candidate['name']."</option>";
		}
		echo "</select><br><br>";
		echo "<input type='hidden' name='electionOfCandidate' value='".$election."'>";
		echo "<input type='hidden' name='positionOfCandidate' value='".$position."'>";
		echo "<button type='submit' name='submit-candidates-delete' class='btn btn-danger btn-lg pull-right'>Delete candidate</button><br><br>";
		echo "</form>";
	}

	}