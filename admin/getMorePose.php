<?php
	include_once 'includes/database.inc.php';
	if(!isset($_POST['theLim'])){
		exit();
	}else{
		echo "<div class='divClass'>";

		$theLim = $_POST['theLim'];
		$sql = "SELECT * FROM positions LIMIT $theLim";
		$result = mysqli_query($conn, $sql);
		if(mysqli_num_rows($result) == 0){
			echo "<blockquote>";
			echo "<h4>No more positions to show...</h4>";
			echo "</blockquote>";
		}else{
			while($row = mysqli_fetch_assoc($result)){
				echo "<blockquote>";
				echo "<h4><b>".$row['name']."</b></h4><br>";
				echo "</blockquote>";
			}
		}
			echo "</div>";
	}