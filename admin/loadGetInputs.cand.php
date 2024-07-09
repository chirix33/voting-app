<?php
	
	if (!isset($_POST['position'])) {
		# code...
		echo "";
	}else{
		$theElection = $_POST['election'];
		$thePosition = $_POST['position'];
		echo '<h3>(3)<span id="toBeChanged" class="lead"> Number of candidates to add</span></h3>';
		echo "<div id='formWrapper'>";
		echo "<form id='theForm'>";
		echo "<input id='num-of-candidates' type='number' value placeholder='0'>";
		echo "<input type='hidden' id='hiddenPosition' value='".$thePosition."'>";
		echo "<input type='hidden' id='hiddenElection' value='".$theElection."'>";
		echo "<button type='button' id='submit-num-of-candidates' class='btn btn-default btn-lg pull-right'>Next</button>";
		echo "</form>";
		echo "</div>";
	}
?>

<script>
	$(document).ready(function() {
		$("#submit-num-of-candidates").click(function() {
			var hiddenPosition = $("#hiddenPosition").val();
			var numOfCandidates = $("#num-of-candidates").val();
			var hiddenElection = $("#hiddenElection").val();
			$("#formWrapper").load("getInputs.cand.php", 
				{
					thehiddenPosition : hiddenPosition,
					thenumOfCandidates : numOfCandidates,
					thehiddenElection : hiddenElection
				}).hide().fadeIn(1500);
			$("#toBeChanged").hide().text(" Names of the candidates").fadeIn(1000);
		});
	});
</script>