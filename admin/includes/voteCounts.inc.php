<?php

	include 'database.inc.php';

	//Go to the table and fetch each position and the votes associated with it

	$viceSQL = "SELECT * FROM candidates WHERE position = 'Vice President'";
	$specSQL  = "SELECT * FROM candidates WHERE position = 'Special Appointees'";
	$proSQL = "SELECT * FROM candidates WHERE position = 'P.R.O'";
	$porterSQL = "SELECT * FROM candidates WHERE position = 'Porter'";
	$orgSQL = "SELECT * FROM candidates WHERE position = 'Organizer'";
	$gsSQL = "SELECT * FROM candidates WHERE position = 'General Secretary'";
	$fsSQL = "SELECT * FROM candidates WHERE position = 'Financial Secretary'";

	//the Queries for each position SQL above
	$viceQuery = mysqli_query($conn, $viceSQL);
	$specQuery = mysqli_query($conn, $specSQL);
	$proQuery = mysqli_query($conn, $proSQL);
	$porterQuery = mysqli_query($conn, $porterSQL);
	$orgQuery = mysqli_query($conn, $orgSQL);
	$gsQuery = mysqli_query($conn, $gsSQL);
	$fsQuery = mysqli_query($conn, $fsSQL);

	//Store the rows in variables to check if they are empty

	$viceRows = mysqli_num_rows($viceQuery);
	$specRows = mysqli_num_rows($specQuery);
	$proRows = mysqli_num_rows($proQuery);
	$porterRows = mysqli_num_rows($porterQuery);
	$orgRows = mysqli_num_rows($orgQuery);
	$gsRows = mysqli_num_rows($gsQuery);
	$fsRows = mysqli_num_rows($fsQuery);



	//Now.. fetch the counts!

	if ($viceRows < 1) {
		echo "<p>No candidates are for the Vice president position. You can add some</p><br>";
	}else{
		echo "<h4><u><b>Vice President</b></u></h4>";
		while ($eachViceCand = mysqli_fetch_assoc($viceQuery)) {
			# code...
			echo "<p>Candidate <b>".$eachViceCand['name']."</b> counts: ".$eachViceCand['counts']."</p>";
		}
	}


	if ($specRows < 1) {
		echo "<p>No candidates are for the Special Appointees. You can add some</p><br>";
	}else{
		echo "<h4><u><b>Special Appointees</b></u></h4>";
		while ($eachSpecCand = mysqli_fetch_assoc($specQuery)) {
			# code...
			echo "<p>Candidate <b>".$eachSpecCand['name']."</b> counts: ".$eachSpecCand['counts']."</p>";
		}
	}


	if ($proRows < 1) {
		echo "<p>No candidates are for the P.R.O position. You can add some</p><br>";
	}else{
		echo "<h4><u><b>P.R.O</b></u></h4>";
		while ($eachProCand = mysqli_fetch_assoc($proQuery)) {
			# code...
			echo "<p>Candidate <b>".$eachProCand['name']."</b> counts: ".$eachProCand['counts']."</p>";
		}
	}

	if ($porterRows < 1) {
		echo "<p>No candidates are for the Porter position. You can add some</p><br>";
	}else{
		echo "<h4><u><b>Porter</b></u></h4>";
		while ($eachPorterCand = mysqli_fetch_assoc($porterQuery)) {
			# code...
			echo "<p>Candidate <b>".$eachPorterCand['name']."</b> counts: ".$eachPorterCand['counts']."</p>";
		}
	}


	if ($orgRows < 1) {
		echo "<p>No candidates are for the Organizer position. You can add some</p><br>";
	}else{
		echo "<h4><u><b>Organizer</b></u></h4>";
		while ($eachOrgCand = mysqli_fetch_assoc($orgQuery)) {
			# code...
			echo "<p>Candidate <b>".$eachOrgCand['name']."</b> counts: ".$eachOrgCand['counts']."</p>";
		}
	}


	if ($gsRows < 1) {
		echo "<p>No candidates are for the General Secretary position. You can add some</p><br>";
	}else{
		echo "<h4><u><b>General Secretary</b></u></h4>";
		while ($eachGsCand = mysqli_fetch_assoc($gsQuery)) {
			# code...
			echo "<p>Candidate <b>".$eachGsCand['name']."</b> counts: ".$eachGsCand['counts']."</p>";
		}
	}


	if ($fsRows < 1) {
		echo "<p>No candidates are for the Financial Secretary position. You can add some</p><br>";
	}else{
		echo "<h4><u><b>Financial Secretary</b></u></h4>";
		while ($eachFsCand = mysqli_fetch_assoc($fsQuery)) {
			# code...
			echo "<p>Candidate <b>".$eachFsCand['name']."</b> counts: ".$eachFsCand['counts']."</p>";
		}
	}

