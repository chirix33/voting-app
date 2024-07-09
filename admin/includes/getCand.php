<!DOCTYPE HTML>
<html lang="en">
<head>
	<title>Get Candidates</title>
	<meta charset="utf-8">
	<meta name="author" content="Ashraf Abdul-Muumin">
	<meta name="viewport" content="width=device-width,initial-scale=1.0">
	<link rel="stylesheet" type="text/css" href="../styles/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="../styles/styles.css">
	<script src="../scripts/jquery.min.js"></script>
</head>
<body>
	<div class="container">
		<div class="jumbotron">
			<?php
				include 'database.inc.php';
				if(!isset($_POST['submit-cand'])){
					header("Location: ../vote.cand.php");
					exit();
				}else {

					$hiddenNumCand = $_POST['hiddenNumCand'];
					$hiddenNumPose = $_POST['hiddenNumPose']; 

					$numCand = 0;
					while($numCand < $hiddenNumCand) { 
						$cand[$numCand] = $_POST['cand'.$numCand];
						$stat = "SELECT * FROM candidates WHERE name = '$cand[$numCand]' AND position = '$hiddenNumPose'";
						$query = mysqli_query($conn,$stat);
						if(mysqli_num_rows($query) >= 1){
							echo "<p>".$cand[$numCand]." for position ".$hiddenNumPose." already exists</p>";
							exit();
						}else{

							$statement = "INSERT INTO candidates(name,position,status,gender) VALUES('$cand[$numCand]','$hiddenNumPose',0,9)";
						$result = mysqli_query($conn,$statement);
						if (!$result) {
							echo "<h4>Error! Please try again</h4>";
						}else{
							echo "<h5>Success adding the candidate <b>" . $cand[$numCand] . "</b> with position ".$hiddenNumPose."</h5><br>"; 
						}


						$numCand++;

						}
						
					}
					echo "<p>You can set up the profile of the candidates at <a href='../vote.cand.setup.php'>Manage Candidates</a></p>";

					echo "<p algin='center'>Go to the <a href='../main.php'>Main</a> page</p>";
				}
				?>
			</div>
		</div>
	</body>
	</html>