<?php
	header("Content-Type: application/json; charset=UTF-8");
	$obj = json_decode($_GET["x"], false);
	
	$storage = fopen("storage_A.txt", "r+");
	$JSON = fgets($storage);
	fclose($storage);

	echo "printout_A(".$JSON.");";
?>