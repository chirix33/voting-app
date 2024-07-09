<?php

	if(!isset($_POST['submit'])){
	header("Location: index.php");
	exit();
}else{
	$fileName = $_FILES['video']['name'];
	$fileTmp = $_FILES['video']['tmp_name'];
	$dstn = 'media/'.$FileName;
	$result = move_uploaded_file($fileTmp, $dstn);
	
	if(!$result){
	echo "<p>Error!</p>";

}else{
	echo "<p>Moved!</p>";
}
}
