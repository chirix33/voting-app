<?php
	
	include 'includes/database.inc.php';

	if (!isset($_POST['ChosenElection'])) {
		# code...
		echo "";
	}else{
		$chosenElection = $_POST['ChosenElection'];
		if ($chosenElection == 'default') {
			# code...
			echo "<p class='lead'>Please choose an election!</p>";
			echo "<a class='btn btn-default' href='vote.cand.setup.php'>Okay</a>";
		}else{
			$sql = "SELECT * FROM positions WHERE election = '$chosenElection'";
			$query = mysqli_query($conn, $sql);

			if (mysqli_num_rows($query) < 1) {
				# code...
				echo "<p class='lead'>There are no positions under <b>".$chosenElection."</b></p>";
				echo "<a class='btn btn-default' href='vote.cand.setup.php'>Okay</a>";
			}else{
				echo '<h3>(2)<span class="lead"> Choose the Position</span></h3>';
				echo "<select id='currentPositions' class='selectStyled'>";
				echo "<option value='default'>Choose the position</option>";
				while ($eachPosition = mysqli_fetch_assoc($query)) {
					echo "<option value='".$eachPosition['name']."'>".$eachPosition['name']."</option>";
				}
				echo "</select>";
				echo "<input type='hidden' id='hiddenElection' value='".$chosenElection."'>";
				echo "<br><br>";
				echo "<button id='proceedPositionren' class='btn btn-default btn-lg pull-right'>Next</button>";
			}
		}
		
	}

?>
	<div id='getInputsren'>
		
	</div>
<script>
	$(document).ready(function() {
		$("#proceedPositionren").click(function() {
			var chosenPosition = $("#currentPositions").val();
			var hiddenElection = $("#hiddenElection").val();
			$("#getInputsren").load("loadGetCandsren.cand.setup.php",
				{
					position: chosenPosition,
					election: hiddenElection
				}).hide().fadeIn(1500);
			$("#proceedPositionren").hide(1000);
		});
	});
</script>