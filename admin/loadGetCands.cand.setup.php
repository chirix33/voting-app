<?php

	include 'includes/database.inc.php';

	if (!isset($_POST['position']) && !isset($_POST['election'])) {
		# code...
		echo "";
	} else {
		$position = $_POST['position'];
		$election = $_POST['election'];

		//default profile picture path
		$picturePath = 'media/profiledefault.jpg';

		$sql = "SELECT * FROM candidates WHERE position = '$position' AND election = '$election' AND picture = '$picturePath'";
		$query = mysqli_query($conn, $sql);
		$thenumber = mysqli_num_rows($query);

		if ($thenumber < 1) {
			echo "<p class='lead'>There are no candidates to setup under <b>".$position."</b></p>";
			echo "<a href='vote.cand.setup.php' class='btn btn-default'>Okay</a><br><br>";
			echo "<div id='setupCandidates'>";
			echo "<div class='col-md-12'>";
			$SetupSql = "SELECT * FROM candidates WHERE position = '$position' AND election = '$election' AND picture <> ''";
			$SetupQuery = mysqli_query($conn, $SetupSql);
			echo "<table class='table'>";
			echo "<tr>";
			while ($setupCandidates = mysqli_fetch_assoc($SetupQuery)) {
				echo "<td><b>".$setupCandidates['name']."</b></td>";
				echo "<td><img src='../".$setupCandidates['picture']."' width='140' height='180'></td>";
			}
			echo "</tr>";
			echo "</table><br><br>";
			echo "</div>";
			echo "</div>";
		}else{

		echo "<form action='includes/saveCandidates.setup.inc.php' method='POST' enctype='multipart/form-data'>";
		echo "<table class='table'>";
		$x=0;
		$y=0;
		while ($candidate = mysqli_fetch_assoc($query)) {
			# code...
			echo "<tr>";
			echo "<td><input type='text' name='candidateName";
			for (; $y <= $thenumber; $y++) { echo $x; if (++$y) { break; } }
			echo "' value='".$candidate['name']."' readonly></td>";
			echo "<td><img src='".$candidate['picture']."' height='180' width='140'></td>";
			echo "<td><input type='file' name='file";
			for (; $x <= $thenumber; $x++) { echo $x; if (++$x) { break; } }
			echo "'></td>";
			echo "</tr>";
		}
		echo "</table>";
		echo "<input type='hidden' name='numberOfCandidates' value='".$thenumber."'>";
		echo "<input type='hidden' name='electionOfCandidates' value='".$election."'>";
		echo "<input type='hidden' name='positionOfCandidates' value='".$position."'>";
		echo "<button type='submit' name='setup-candidates' class='btn btn-success btn-lg pull-right'>Submit</button>";
		echo "</form>";
	}

	}
	?>
