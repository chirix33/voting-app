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

		echo "<div id='tempFormWrapper'>";
		echo "<form action='includes/renameCandidates.setup.inc.php' method='POST'>";
		echo "<select id='renameSelect' class='selectStyled'>";
		echo "<option value='default'>Choose a candidate</option>";
		while ($candidate = mysqli_fetch_assoc($query)) {
			# code...
			echo "<option value='".$candidate['name']."'>".$candidate['name']."</option>";
		}
		echo "</select><br><br>";
		echo "<input type='hidden' id='electionOfCandidate' value='".$election."'>";
		echo "<input type='hidden' id='positionOfCandidate' value='".$position."'>";
		echo "<button type='button' id='chooseCandRen' class='btn btn-default pull-right'>Next</button><br><br>";
		echo "</form>";
		echo "</div>";
	}

	}
?>

<script>
	$(document).ready(function() {
		$("#chooseCandRen").click(function() {
			var electionOfCandidate = $("#electionOfCandidate").val();
			var positionOfCandidate = $("#positionOfCandidate").val();
			var renameSelect = $("#renameSelect").val();

			$("#tempFormWrapper").load("renameBody.php",
				{
					election: electionOfCandidate,
					position : positionOfCandidate,
					renameCand : renameSelect
				}).hide().show(1500);
		});
	});
</script>