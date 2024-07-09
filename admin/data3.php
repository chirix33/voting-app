<?php
	include 'includes/database.inc.php';

	if (!isset($_POST['selectInd'])) {
		echo "<p>An error occured, please <a href='vote.cand.setup.php'>try again</a></p>";
	}else{
		$selectInd = $_POST['selectInd'];

		if($selectInd == "Choose candidate" || $selectInd == "No candidate"){
			echo "<h4>That is not a candidate! Please <a href='vote.cand.setup.php'>try again</a></h4>";
		}else{
			echo "<h3 align='center'>".$selectInd."</h3>";
			echo '<div class="row">';
			echo '<div class="col-md-4">';
				$statement = "SELECT * FROM candidates WHERE name = '$selectInd'";
				$queryIt = mysqli_query($conn, $statement);
				if(mysqli_num_rows($queryIt) < 1){
					echo "<p>The candidate does not exist!</p>";
				}else{
					while($row = mysqli_fetch_assoc($queryIt)){
						if($row['status'] == 0){
							echo "<img alt='ProfileImg' src='media/profiledefault.jpg' width='135' height='180'>";
								echo "<form action='includes/candSetup.php' method='POST' enctype='multipart/form-data'>";
							echo "Upload Candidate Picure  <input type='file' name='userfile'><br>";
							echo "<input type='hidden' value='$selectInd' name='candName'>";
							echo "<input type='hidden' value='".$row['id']."' name='candId'>";
							echo "<button type='submit' class='btn' name='submitProfile'>Submit</button>";
							echo "<br><br>";
							echo "</form>";

						}else{
							echo "<img alt='ProfileImg' src='media/".$row['name'].".jpg' width='135' height='180'>";
								echo "<form action='includes/candSetup.php' method='POST' enctype='multipart/form-data'>";
							echo "Upload Candidate Picure  <input type='file' name='userfile'><br>";
							echo "<input type='hidden' value='$selectInd' name='candName'>";
							echo "<input type='hidden' value='".$row['id']."' name='candId'>";
							echo "<button type='submit' class='btn' name='submitProfile'>Submit</button>";
							echo "<br><br>";
							echo "</form>";
						}
					}
				
				}
			echo '</div>';
			echo '<div class="col-md-8">';
			echo '<form action="includes/changes.php" method="POST">';
				$comon = "SELECT * FROM candidates WHERE name ='$selectInd'";
				$theRunIt = mysqli_query($conn,$comon);
				if(mysqli_num_rows($theRunIt) < 1){
					echo "<p>The candidate does not exist!</p>";
				}else{
					while($rowSecond = mysqli_fetch_assoc($theRunIt)){
						echo '<input type="text" id="theCandAlreadyName" name="theCandAlready" value="' .$rowSecond['name'].'">';
						echo "<br>";
						if($rowSecond['gender'] == 9){
							echo "<select name='theCandGender'>";
							echo "<option value='male'>Male</option>";
							echo "<option value='female'>Female</option>";
							echo "</select><br>";
						}elseif ($rowSecond['gender'] == 0) {
							echo '<input type="text" name="theCandGender" value="Female"><br>';
						}elseif ($rowSecond['gender'] == 1) {
							echo '<input type="text" name="theCandGender" value="Male"><br>';
						}else{
							echo '';
						} 
					echo "<br>";
					echo "<input type='hidden' value='".$rowSecond['id']."' name='candId'>";
					echo "<button class='btn' type='submit' name='submitCandAlready'>Submit</button>";
					}

				}
				
			echo '</form>';
			echo '</div>';
			echo '</div>';
		}
		
	}