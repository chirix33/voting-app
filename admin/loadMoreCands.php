<?php

include_once 'includes/database.inc.php';

if(!isset($_POST['theLim'])){
	header("Location: vote.cand.setup.php");
	exit();
}else{
	$theLim = $_POST['theLim'];
	$sql = "SELECT * FROM candidates WHERE status = 1 AND (gender = 1 OR gender = 0) LIMIT '$theLim'";
	$theQuery = mysqli_query($conn, $sql);
				if(mysqli_num_rows($theQuery) < 1){
					echo "<h4>No candidates who are set up yet</h4>";
				}else{
					while($theRow = mysqli_fetch_assoc($theQuery)){
						if($theRow['gender'] == 0){
							$gender = "Female";
						}else{
							$gender = "Male";
						}
						echo "<div style='margin:6px;'>";
						echo "<img alt='profile pic' src='media/".$theRow['name'].".jpg' width='140' height='180'>";
						echo "</div>";
						echo "<div class='left'>
							<h4><p><b>".$theRow['name']." (".$theRow['position'].")<br><br>
							Gender: ".$gender. "
							</p></b></h4>
							</div>";
						echo "<br>";
					}
				}

}
