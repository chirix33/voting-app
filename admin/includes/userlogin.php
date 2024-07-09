<?php

include_once 'database.inc.php';
session_start();

if(!isset($_POST['submit'])){
	header("Location: ../userlogin.php");
	exit();
}else{
	$getPass = mysqli_real_escape_string($conn, $_POST['userpwd']);
	$alterPass = strtoupper($getPass);
	$sql = "SELECT * FROM students WHERE users = '$alterPass'";
	$result = mysqli_query($conn, $sql);
	if(mysqli_num_rows($result) < 1){
		header("Location: ../userlogin.php?userlogin=wrong");
		exit();
	}else{
		$_SESSION['id'] = $alterPass;
		header("Location: ../vote.php?user=$alterPass");
		exit();
	}


}