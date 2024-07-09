<!DOCTYPE html>
<html>
<head>
	<title>E-Voting Site | Importing voters</title><meta charset="utf-8">
	<meta name="author" content="Ashraf Abdul-Muumin">
	<meta name="viewport" content="width=device-width,initial-scale=1.0">
	<link rel="stylesheet" type="text/css" href="styles/bootstrap.css">
	<link rel="icon" href="uploads/favicon.ico">
	<link rel="stylesheet" type="text/css" href="styles/styles.css">
	<script src="scripts/jquery.min.js"></script>
</head>
<body>
	<div class="jumbotron">
		<div class="container">
			<?php 
				session_start();
				if (!isset($_SESSION['id'])) {
					echo "";
				}else{
					echo "<h1 align='center'>".$_SESSION['id']."</p>";
					if(!isset($_SESSION['id'])) {
					header("Location: index.php");
					exit();
						} else {
								echo "<div align='center'>";
								echo "<form action='includes/signout.inc.php' method='POST'>";
								echo "<button type='submit' class='btn btn-warning btn-lg' name='really'>Signout</button>";
								echo "</form>";
								echo "</div><br>";
							}
				}

				echo '<script src="scripts/getTime.js"></script>';
				echo "<div class='row'>
						<div class='col-md-12'>
							<p id='theClock'></p>
						</div>
						</div>";
			?>
		</div>
	</div>
	<div class="container">
		<div class="row">
		<div class="col-md-12">
			<h2>Export data to a text file</h2>
			<hr>
			<p>To export voters' info into this system from <em>Ms Access</em> here are the steps to follow: </p>
	
			<ol>
					<li>
						You must make sure that the fields for the <b>Voter Name</b> and <b>ID</b> are the only ones showing in the <u>table</u> or <u>query</u>.

						<br>

						If there are other fields in the table, the table must be <b>queried</b> to retrieve only the Names and ID's of the voters' respectively.
					</li>
						<br>
					<li>
						After sorting out the necessary information (<b>Names</b> and the <b>ID's</b>), Go to the <b>External Data</b> tab. In the <b>Export</b> ribbon, click on <b>Text File</b>.
						<br><br>
						<img src="uploads/1.jpg" class="img-thumbnail">
						<br><br>
					</li>

					<br>

					<li>
						The <b>Export Text Wizard</b> would show up. Select the <b>Delimited</b> radio button for this setup. (That option is selected by default unless from a saved export setting)
						<br><br>
						<img src="uploads/2.jpg" class="img-thumbnail">
						<br><br>
						Click on <b>Advanced...</b> button on the left down corner of the wizard to modify the specifications for this export.
						<br><br>
					</li>

					<br>

					<li>
						Select the <u>comma(,)</u> as the <b>Field Delimiter</b> and <b>{none}</b> as the <b>Text Qualifier</b> and click on <b>OK</b>.
						<br><br>
						<img src="uploads/3.jpg" class="img-thumbnail">
						<br><br>
					</li>

					<br>

					<li>
						Click on <b>Next</b>.
						<br><br>
						<img src="uploads/4.jpg" class="img-thumbnail">
						<br><br>
						Proceed by clicking again on <b>Next</b>.
						<br>
						<img src="uploads/5.jpg" class="img-thumbnail">
						<br><br>
					</li>
					<br>
					<li>
						Click on <b>Finish</b> to complete the export wizard settings
					</li>
					<br>
					<p class="lead well">
						The text file would be now saved in the name that you specified (the table or query's name by default) in the location that you specify. You can now upload the voters' file into the system to get all their names and ID's here.
					</p>
			</ol>
		</div>
		<br><br>
		<div class="row">
			<div class="col-md-12">
				<p align="center"><a href="vote.settings.php" class="btn btn-primary btn-lg">Go Back</a></p>
			</div>
		</div>
		<br><br>
	</div>
</body>
</html>