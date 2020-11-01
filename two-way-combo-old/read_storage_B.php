<?php
	header("Content-Type: application/json; charset=UTF-8");
	$obj = json_decode($_GET["x"], false);
	
	$storage = fopen("storage_B.txt", "r+");
	$JSON = fgets($storage);
	fclose($storage);

	echo "printout_B(".$JSON.");";
?>