<?php include_once 'includes/database.inc.php'; ?>
<!DOCTYPE HTML>
<html lang="en">
<head>
	<title>E-Voting Site</title>
	<meta charset="utf-8">
	<meta name="author" content="Ashraf Abdul-Muumin">
	<meta name="viewport" content="width=device-width,initial-scale=1.0">
	<link rel="stylesheet" type="text/css" href="styles/bootstrap.css">
	<link rel="icon" href="uploads/favicon.ico">
	<link rel="stylesheet" type="text/css" href="styles/styles.css">
	<script src="scripts/jquery.min.js"></script>
	<script>
		$(function() {
			$("#temporary").fadeOut(3000);

			$("#showBody").show(1100);

			$("#newVoters").hide();
			$("#delVoters").hide();
			$("#addBtn").on("click", function() {
				$("#theVoters").hide(1300);
				$("#addBtn").hide();
				$("#newVoters").show(1300);
			});

			$("#restoreVoters").click(function() {
				$("#newVoters").hide(1300);
				$("#addBtn").show();
				$("#theVoters").show(1300);
			});

			$("#form-num-voters").submit(function(event) {
				event.preventDefault();
				var numOfVoters = $("#numOfVoters").val();
				$("#newVoters").load("data5.php",
				{
					NumOfVoters : numOfVoters
				})

			});

			$("#delBtn").click(function() {
				$("#theVoters").hide(1300);
				$("#delVoters").show(1300);
				$("#delBtn").hide();
			});

			$("#cancelDel").click(function(event) {
				event.preventDefault();
				$("#delVoters").hide(1300);
				$("#theVoters").show(1300);
				$("#delBtn").show();
			});

			$("#cancelDelCollec").click(function(event) {
				event.preventDefault();
				$("#delVoters").hide(1300);
				$("#theVoters").show(1300);
				$("#delBtn").show();
			});

			var checked = false;
			$("#selectAll").click(function() {
				if (checked === false)
				{
					$("input").prop("checked", true);
					checked = true;
				}else if(checked === true) {
					$("input").prop("checked", false);
					checked = false;
				}

			});

		});
	</script>
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

				if (!isset($_GET['delete'])) {
					# code...
					echo "";
				}elseif ($_GET['delete'] == 'error') {
					# code...
					echo "<p id='temporary'>There was an error deleting the voters</p>";
				}elseif ($_GET['delete'] == 'success') {
					# code...
					echo "<p id='temporary'><b>Voters deleted successfully</b></p>";
				}

				if (!isset($_GET['upload'])) {
					# code...
					echo "";
				}elseif ($_GET['upload'] == 'notsupported') {
					# code...
					echo "<p id='temporary'>The file type is not supported. It must be a text file</p>";
				}elseif ($_GET['upload'] == 'error') {
					# code...
					echo "<p id='temporary'>There was an error uploading the file. Please try again</p>";
				}elseif ($_GET['upload'] == 'success') {
					# code...
					echo "<p id='temporary'><b>Voters uploaded successfully</b></p>";
				}

				echo '<script src="scripts/getTime.js"></script>';
				echo "<div class='row'>
						<div class='col-md-12'>
							<p id='theClock'></p><br>
						</div>
						</div>";

			?>
		</div>
	</div>
	<div class="container">
	<div class="row">
	<div class="col-md-12">
	<ul class="nav nav-pills">
		<li role="presentation">
			<a href="main.php">Main</a>
		</li>
		<li role="presentation">
			<a href="vote.elect.php">Add Elections</a>
		</li>
		<li role="presentation">
			<a href="vote.pose.php">Manage Positions & Elections</a>
		</li>
		<li role="presentation">
			<a href="vote.cand.php">Add Candidates</a>
		</li>
		<li role="presentation">
			<a href="vote.cand.setup.php">Manage Candidates</a>
		</li>
		<li role="presentation" class="active">
			<a href="vote.settings.php">Voters</a>
		</li>
		<li role="presentation">
			<a href="vote.account.php">Change Password</a>
		</li>
		<li role="presentation">
			<a href="vote.contact.php">Contact</a>
		</li>
	</ul>
</div>
</div>
<div class="row">
	<div class="col-md-12">
	<div id='showBody' style="display: none;">
		<?php
			$sql = "SELECT * FROM students LIMIT 10";
			$result = mysqli_query($conn, $sql);
			if(mysqli_num_rows($result) < 1){
				echo "<br><br>";
				echo "<p class='p-sized'>No students are added yet.</p>";
				echo "<a id='addBtn' class='btn btn-default'>Add voters</a><br><br>";
			}else{
				echo "<div id='theVoters'>";
				echo "<h2>Current voters</h2>";
				echo "<table class='table table-hover'>";
				while ($row = mysqli_fetch_assoc($result)) {
					echo "<tr>";
					echo "<td>Name of voter: <b>" .$row['name']. "</b></td>";
					echo "<td>Student ID of voter: <b>" .strtoupper($row['users']). "</b></td>";
					echo "</tr>";
				}
				echo "<tr>";
				echo "<td>Total number of voters: <b>".mysqli_num_rows(mysqli_query($conn, "SELECT * FROM students"))."</b></td>";
				echo "</tr>";
				echo "</table>";
				echo "</div>";
				echo "<table class='table'>";
				echo "<tr>";
				echo "<th>";
				echo "<a id='addBtn' class='btn btn-default pull-left'>Add voters</a>";
				echo "</th>";
				echo "<th>";
				echo "<a id='delBtn' class='btn btn-danger pull-right'>Delete voters</a>";
				echo "</th>";
				echo "</tr>";
				echo "</table>";
			}

		?>
		<div id="newVoters">
		<h3>Add voters</h3>
		<form id="form-num-voters" action="includes/addVoters.php" method="POST">
		<input type="number" name="numOfVoters" id="numOfVoters" class="selectSpecial" value placeholder="Number of voters">
		<br><br>
		<button type='submit' name='settingsVote' class='btn'>Next</button>
		<button type='button' id='restoreVoters' class='btn'>Cancel</button>
		<br><br>
		</form>
		</div>

		<div id="delVoters">
			<h3>Delete voters individualy</h3>
			<?php
				$searchSQL = "SELECT * FROM students";
				$searchQuery = mysqli_query($conn, $searchSQL);
				if (mysqli_num_rows($searchQuery) < 1) {
					echo "<p align='center'>There are no students to delete</p>";
				}else{
					echo "<form action='includes/deleteVoter.inc.php' method='POST'>";
					echo "<select name='deleteVoter' class='selectStyled' align='center'>";
					echo "<option value='default'>Choose a student</option>";
					while ($student = mysqli_fetch_assoc($searchQuery)) {
						echo "<option value='".$student['users']."'>".$student['name']."</option>";
					}
					echo "</select><br><br>";
					echo "<table class='table'>";
					echo "<tr>";
					echo "<th>";
					echo "<button type='submit' name='really-del' class='btn btn-danger pull-left'>Delete Student</button>";
					echo "</th>";
					echo "<th>";
					echo "<button id='cancelDelCollec' class='btn btn-default pull-right'>Cancel</button>";
					echo "</th>";
					echo "</tr>";
					echo "</table>";
					echo "</form>";
				}

			?>
			<br><br>
			<h3>Delete voters collectively</h3>
			<p class="pull-right">Select all: <input type="checkbox" id="selectAll"></p>
			<?php
				$i=0;
				$getVoters = mysqli_query($conn, "SELECT * FROM students");
				if (mysqli_num_rows($getVoters) < 1) {
					# code...
					echo "<p>There are students to delete</p>";
				}else{
					echo "<form action='includes/deleteVoterCollec.inc.php' method='POST'>";
					echo "<table class='table table-striped'>";
					while ($voter = mysqli_fetch_assoc($getVoters)) {
						# code...
						echo "<tr>";
						echo "<td><b>".$voter['name']."</b></td>";
						echo "<td><b>".$voter['users']."</b></td>";
						echo "<td><input type='checkbox' id='stdCheckBox' name='voter";
							for (; $i < mysqli_num_rows($getVoters); $i++) {
								# code...
								echo $i;
								if (++$i) {
									# code...
									break;
								}
							}
						echo "' value='".$voter['users']."'>";
						echo "</tr>";
					}
					echo "<tr>";
					echo "<th>";
					echo "<button type='submit' name='really-del-collec' class='btn btn-danger pull-left'>Delete Students</button>";
					echo "</th>";
					echo "<th>";
					echo "<button id='cancelDel' class='btn btn-default pull-right'>Cancel</button>";
					echo "</th>";
					echo "</tr>";
					echo "</table>";
					echo "</form>";

				}
			?>
		</div>
		<br><br>
		<div id="helpImport">
			<h2>Importing bulk voters</h2>
			<hr>
			<p>To add voters to this system's database. The voters' information must be stored on a <u>text file</u> and uploaded here.</p>
			<p class="p-sized well" align="center"><b>The voters' info must be in the form <u>[voter's ID],[voter's name]</u>. Each voter must be on a new line</b></p>
			<br>
			<h3>Importing from Ms Access</h3>
			<blockquote>
				<p>Please <a href="help.settings.php">click here</a> to know how to export an accepted file type from Micrososft Access Database Software</p>
			</blockquote>
			<br>
			<h3>Import file</h3>
				<p class="p-sized">Import the voters' file here. If you are not sure which format of file to upload. Please get the instructions <a href="help.settings.php">here</a></p>
				<br>
				<form action='includes/saveVotersCollec.inc.php' method="POST" enctype="multipart/form-data">
					<label>
						<input type="file" name="votersFile" style="width: 100%;">
					</label>
					<br>
					<button type="submit" name="submitVotersFile" class="btn btn-success btn-lg pull-right">Upload</button>
				</form>
		</div>
	</div>
	</div>
</div>
</div>
<div class="container">
	<div class="row">
		<div class="col-md-12">
			<?php include 'includes/footer.inc.php'; ?>
		</div>
	</div>
</div>
</body>
</html>
