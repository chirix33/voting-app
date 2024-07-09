<?php
	include 'includes/database.inc.php';
	if(!isset($_POST['it'])){
		echo "<div class='divClass'>";
		$state = "SELECT * FROM candidates LIMIT 4";
		$resultCand = mysqli_query($conn, $state);
		if(mysqli_num_rows($resultCand) < 1){
					echo "<blockquote>";
					echo "<h4>No more candidates...</h4>";
					echo "</blockquote>";
				}else {
					while($row = mysqli_fetch_assoc($resultCand)){
						echo "<blockquote>";
						echo "<h4><b>".$row['name']." (".$row['position'].")</b></h4>";
						echo "<br>";
						echo "</blockquote>";
					}
				}
			echo "</div>";
	}else{
		echo "<div class='divClass'>";
		$initLimit = $_POST['it'];
		$state = "SELECT * FROM candidates LIMIT $initLimit";
		$resultCand = mysqli_query($conn, $state);
		if(mysqli_num_rows($resultCand) < 1){
					echo "<blockquote>";
					echo "<h4>No more candidates...</h4>";
					echo "</blockquote>";
				}else {
					while($row = mysqli_fetch_assoc($resultCand)){
						echo "<blockquote>";
						echo "<h4><b>".$row['name']." (".$row['position'].")</b></h4>";
						echo "<br>";
						echo "</blockquote>";
					}
				}
			echo "</div>";
	}