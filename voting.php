<?php

	include 'includes/database.inc.php';

	if (!isset($_POST['election'])) {
		# code...
		echo "<p>No election</p>";
	}else{
		$election = $_POST['election'];
		$getPositionsSQL = "SELECT * FROM positions WHERE election = '$election'";
		$getPositionsQuery = mysqli_query($conn, $getPositionsSQL);
		$numberOfPositions = mysqli_num_rows($getPositionsQuery);
		$i = 0;

		if (!$getPositionsQuery) {
			# code...
			echo "<p>There was an error. Please try again</p>";
			echo "<a class='btn btn-default' href='vote.php'>Okay</a>";
		}else{
				while ($eachPosition = mysqli_fetch_assoc($getPositionsQuery)) {
					# code...
					$positions[] = $eachPosition['name'];
				}
				echo "<form action='includes/addCount.inc.php' method='POST'>";
				for ($num=0; $num < $numberOfPositions; $num++) {
					# code...
					$sql = "SELECT * FROM candidates WHERE position = '$positions[$num]' AND election = '$election'";
					$query = mysqli_query($conn, $sql);
					if (mysqli_num_rows($query) < 1) {
						# code...
						while ($candidate = mysqli_fetch_assoc($query)) {
							# code...
							echo "<h3><b>".$candidate['position']."</b></h3>";
							echo "<p>There are no candidates for this position</p>";
						}
					}else{
						echo "<h3>".$positions[$num]."</h3>";
						echo "<div id='setupCandidates'>";
						echo "<table class='table'>";
						echo "<tr>";
						while ($candidate = mysqli_fetch_assoc($query)) {
							# code...
							echo "<td><b>".$candidate['name']."</b></td>";
							if ($candidate['picture'] == '') {
								# code...
								echo "<td>";
								echo "<img class='voting-img' width='140' height='180' src='media/profiledefault.jpg'>";
								echo "<input type='radio' value='".$candidate['name']."' name='candidate".$num."'>";
								echo "</td>";
							}else{
								echo "<td>";
								echo "<img class='voting-img' width='140' height='180' src='".$candidate['picture']."'>";
								echo "<input type='radio' value='".$candidate['name']."' name='candidate".$num."'>";
								echo "</td>";
							}
						}
						echo "</tr>";
						echo "</table>";
						echo "</div>";
						echo "<br><br>";
						echo "<input type='hidden' name='name-of-positions".$num."' value='".$positions[$num]."'>";
					}
				}
				echo "<input type='hidden' name='number-of-positions' value='".$numberOfPositions."'>";
				echo "<input type='hidden' name='name-of-election' value='".$election."'>";
				echo "<button type='submit' name='submit-votes' class='btn btn-primary btn-lg pull-right'>Vote</button>";
				echo "</form>";
			}

		}

?>
<div id="proceedPoseDiv">

</div>
<script>
	$(document).ready(function() {
		$("#proceedPose").click(function() {
			$("#choosePositionDiv").hide(1000);
			var theElection = $("#election").val();
			var thePosition = $("#choosePosition").val();
			$("#proceedPoseDiv").hide(1000).load("proceedPosition.php",
				{
					election : theElection,
					position : thePosition
				}).hide(1100).show(1000);
			$("h3").hide(1000).text("Please vote wisely").show(1100);
		});
	});
</script>
