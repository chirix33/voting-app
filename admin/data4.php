<?php include_once 'includes/database.inc.php'; ?>
<!DOCTYPE HTML>
<html lang="en">
	<head>
		<title>Setup Candidates</title>
		<meta charset="utf-8">
		<meta name="author" content="Ashraf Abdul-Muumin">
		<link rel="stylesheet" type="text/css" href="styles/bootstrap.css">
		<link rel="stylesheet" type="text/css" href="styles/styles.css">
		<script src="scripts/jquery.min.js"></script>
	</head>
	<body>
	<div class="jumbotron">
		<div class="container">
			<?php 
				session_start();
				if (!isset($_SESSION['id'])) {
					header("Location: index.php");
				}else{
					echo "<h1 align='center'>".$_SESSION['id']."</p>";
					if(!isset($_SESSION['id'])) {
					header("Location: index.php");
					exit();
						} else {
								echo "<div align='center'>";
								echo "<form action='includes/signout.inc.php' method='POST'>";
								echo "<button type='submit' class='btn btn-warning' name='really'>Signout</button>";
								echo "</form>";
								echo "</div><br>";
							}
						}
							?>
			</div>
		</div>
		<div class="container">
			<?php

				if(!isset($_POST['submitCandCollec'])){
					header("Location: vote.cand.setup.php");
					exit();
				}else{
					$select = $_POST['selectSpecialCollec'];
					$sql = "SELECT * FROM candidates WHERE position = '$select' AND (gender = 9 AND status = 0)";
					$result = mysqli_query($conn, $sql);
					if(mysqli_num_rows($result) < 1){
						echo "<p class='lead'>There are no candidates for that position. Please <a href='vote.cand.php'>add candidates</a> or <a href='vote.cand.setup.php'>go back</a></p>";
					}else{
						echo "<form action='includes/candSetupCollec.php' method='POST' enctype='multipart/form-data'>";
						echo "<input type='hidden' name='nameofposition' value='".$select."'>";
						$i=0;
						$x=0;
						$y=0;
						$z=0;
						while ($row = mysqli_fetch_assoc($result)) {
							echo "<div class='row'>";
							echo "<div class='col-md-6'>";
							echo "<h3>".$row['name']."</h3>";
							if($row['status'] == 0){
								echo "<img alt='default' src='media/profiledefault.jpg' width='140' height='180'><br><br>";
								echo "Upload Profile Picture";
								echo "<input type='file' name='file";

								for (; $i < mysqli_num_rows($result) ; $i++){echo $i; if($i +=1){break;}}
								echo "'><br>";
								echo "<input type='hidden' name='verNumProfile' value='".mysqli_num_rows($result)."'>";
								echo "<input type='hidden' name='thenames"; 
								for (; $y < mysqli_num_rows($result) ; $y++){echo $y; if($y +=1){break;}}
								echo "' value='".$row['name']."'>";
							}else{
								echo "<img alt='profilepic' src='media/".$row['name'].".jpg' width='140' height='180'><br>";
							}

							echo "</div>";
							echo "<div class='col-md-6'>";
							echo "<hr>";
							echo "<input type='text' name='theCandName";
							for (; $x < mysqli_num_rows($result) ; $x++){echo $x; if($x +=1){break;}}
							echo  "' value='".$row['name'] . "' disabled><br>";
							if($row['gender'] == 9){
								echo "<select name='theCandGender";
								for (; $z < mysqli_num_rows($result) ; $z++){echo $z; if($z +=1){break;}}
								echo "'>";
								echo "<option>Choose gender</option>";
								echo "<option value='male'>Male</option>";
								echo "<option value='female'>Female</option>";
								echo "</select>";
							}elseif($row['gender'] == 1){
								echo "Gender: Male";
							}else{
								echo "Gender: Female";
							}
							echo "</div>";
							echo "</div>";
						

						}
						echo "<p align='center'><button type='submit' class='btn' name='submitAll'>Submit Info</button></p>";
						echo "</form>";
					}
				}

			?>
			</div>
	</body>
</html>