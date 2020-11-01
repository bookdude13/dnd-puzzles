<?php
	header("Content-Type: application/json; charset=UTF-8");
	$obj = json_decode($_GET["x"], false);
	
	$storage = fopen("storage_S.txt", "r+");
	$JSON = fgets($storage);
	fclose($storage);

	echo "printout_S(".$JSON.");";
?>